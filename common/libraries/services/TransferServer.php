<?php

namespace common\libraries\services;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\helpers\VarDumper;
use common\models\AR;
use common\models\Product;

class TransferServer  extends BaseServer
{
    public function operate()
    {
        $data = [
            'idCompany' => 0,
            'idProduct' => $this->_model->idArOut,
            'date' => $this->_model->date,
            'type' => AR::DISCHARGE,
            'quantity' => $this->_model->quantity,
            'note' => 'Transfer',
            'isTransfer' => true,
        ];

        $trans = \Yii::$app->db->beginTransaction();
        try{
            $intoProduct = $this->getIntoProduct();

            if (!$intoProduct->save()) {
                throw new \yii\db\Exception(VarDumper::export($intoProduct->errors));
            }

            $from = ARServer::getServer(new AR($data));

            $data['idProduct'] = $intoProduct->id;
            $data['type'] = AR::ENTRY;
            $into = ARServer::getServer(new AR($data));

            if (!$into->operate() || !$from->operate()) {
                throw new \yii\db\Exception('unknown error');
            }

            $this->_model->idArOut = $from->_model->id;
            $this->_model->idArInto = $into->_model->id;
            if (!$this->_model->save()) {
                throw new \yii\db\Exception(VarDumper::export($this->_model->errors));
            }

            $trans->commit();
        } catch (\yii\db\Exception $e) {
                $trans->rollBack();
                if ($e->errorInfo) {
                    throw new ServerErrorHttpException($e->errorInfo);
                } elseif ($e->getMessage()) {
                    throw new BadRequestHttpException($e->getMessage());
                }
        }

        return true;
    }

    protected function getIntoProduct()
    {
        $product = Product::findOne($this->_model->idArOut);
        if (empty($product)) {
            throw new BadRequestHttpException('product not found');
        }

        $data = [
            'name' => $product->name,
            'sku' => $product->sku,
            'idType' => $product->idType,
            'barcode' => $product->barcode,
            'idWarehouse' => $this->_model->idArInto,
        ];
        $intoProduct = Product::findOne($data);
        if (empty($intoProduct)) {
            $intoProduct = new Product($data);
            $intoProduct->min = $product->min;
            $intoProduct->max = $product->max;
        }

        return $intoProduct;
    }
}
