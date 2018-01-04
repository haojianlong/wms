<?php

use common\models\Warehouse;
use kartik\date\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Transfer */
/* @var $product common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idArOut')->textInput([
        'value' => $product->name.'('.$product->quantity.')',
        'readonly' => 'readonly',
    ]) ?>

    <?=$form->field($model, 'idArInto')->widget(Select2::classname(), ['data' => Warehouse::getNames(['<>', 'id', $product->idWarehouse])]);?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?=$form->field($model, 'date')->widget(DatePicker::classname(), [
        'options' => [
            'value' => date('Y-m-d')
        ],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]);?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
