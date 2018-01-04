<?php

namespace common\libraries\services;

use common\models\AR;
use common\models\Product;
use common\models\Transfer;
use yii\db\Exception;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class TransferServer
 *
 * @property Transfer $_model
 *
 * @package common\libraries\services
 */
class TransferServer extends BaseServer
{

    /**
     * 调拨操作
     * @return bool
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     */
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
        try {
            $intoProduct = $this->getIntoProduct();

            if (!$intoProduct->save()) {
                throw new Exception(VarDumper::export($intoProduct->errors));
            }

            $from = ARServer::getServer(new AR($data));

            $data['idProduct'] = $intoProduct->id;
            $data['type'] = AR::ENTRY;
            $into = ARServer::getServer(new AR($data));

            if (!$into->operate() || !$from->operate()) {
                throw new Exception('unknown error');
            }

            $this->_model->idArOut = $from->_model->id;
            $this->_model->idArInto = $into->_model->id;
            if (!$this->_model->save()) {
                throw new Exception(VarDumper::export($this->_model->errors));
            }

            $trans->commit();
        } catch (Exception $e) {
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

    /**
     * @param Transfer $model
     * @return null|self
     */
    public static function getServer($model)
    {
        if (!($model instanceof Transfer)) {
            return null;
        }
        return new static($model);
    }
}
