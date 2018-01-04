<?php

namespace common\libraries\services;

use common\models\AR;
use yii\db\Exception;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\widgets\ActiveForm;

/**
 * Class ARServer
 *
 * @property AR $_model
 *
 * @package common\libraries\services
 */
class ARServer extends BaseServer
{
    /**
     * 调拨记录
     * @return bool
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     */
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
        try {
            if (!$model->save(false) || !$model->product->save()) {
                throw new Exception(VarDumper::export(array_merge($model->errors, $model->product->errors)));
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

    /**
     * @param AR $model
     * @return null|self
     */
    public static function getServer($model)
    {
        if (!($model instanceof AR)) {
            return null;
        }
        return new static($model);
    }
}
