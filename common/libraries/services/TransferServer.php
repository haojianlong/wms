<?php

namespace common\libraries\services;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\helpers\VarDumper;
use common\models\AR;
use common\models\AR;

class TransferServer  extends BaseServer
{
    public function operate()
    {
        $data = [
            'idCompany' => 0,
            'idProduct' => $this->_model->idArOut,
            'date' => $this->_model->date,
            'type' => AR::ENTRY,
            'quantity' => $this->_model->quantity,
            'note' => 'Transfer',
            'isTransfer' => true,
        ]
        $from = new AR($data);
        $into = getIntoProduct();
    }

    protected function getIntoProduct()
    {
        $product = Product::findOne($this->_model->idArOut);
        if (empty($product)) {
            throw new throw new BadRequestHttpException('product not found');
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
