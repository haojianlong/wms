<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Warehouse;
use kartik\widgets\Select2;

//$this->registerJsFile('/yii/web/js/receive-payment.js', ['depends' => ['app\assets\AppAsset'], 'position' => $this::POS_END]);

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idType')->textInput() ?>

    <?=$form->field($model, 'idWarehouse')->widget(Select2::classname(), ['data' => Warehouse::getNames()]);?>

    <?= $form->field($model, 'max')->textInput() ?>

    <?= $form->field($model, 'min')->textInput() ?>

    <?= $form->field($model, 'barcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
