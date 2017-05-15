<?php

namespace common\libraries\services;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\helpers\VarDumper;
use yii\widgets\ActiveForm;

class ARServer  extends BaseServer
{
    public function operate()
    {
        $model = $this->_model;
        if ($model->id) {
            return false;
        }
        if (!$model->validate()) {
            throw new BadRequestHttpException(VarDumper::export(ActiveForm::validate($model)));
        }

        if ($model->type == $model::ENTRY) {
            $model->product->quantity += $model->quantity;
        } elseif ($model->type == $model::DISCHARGE) {
            $model->product->quantity -= $model->quantity;
        }

        $trans = \Yii::$app->db->beginTransaction();
        try{
            if (!$model->save(false) || !$model->product->save()) {
                throw new \yii\db\Exception(VarDumper::export(array_merge($model->errors,$model->product->errors)));
            }
            $trans->commit();
        } catch (\yii\db\Exception $e) {
                $trans->rollBack();
                if ($e->errorInfo) {
                    throw new ServerErrorHttpException($e->errorInfo);
                } elseif ($e->getMessage()) {
                    throw new BadRequestHttpException($e->getMessage());
                }
                // print_r($e->errorInfo);      //db错误
                // print_r($e->getMessage());   //yii报错
        }
        return true;
    }
}
