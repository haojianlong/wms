<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Warehouse;
use common\models\ProductType;
use kartik\widgets\Select2;

$this->registerJsFile('@web/js/product.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_END]);

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label for="supertype">Supertype</label>
        <?= Select2::widget([
            'options' => [
                'class'=>'form-control',
                'id' =>'supertype',
            ],
            'name' => 'supertype',
            'value' => $model->idType ? $model->type->idParent : '',
            'data' => ProductType::getParents()
        ]);?>
    </div>

    <?=$form->field($model, 'idType')->label('Subtype')
        ->widget(Select2::classname(), [
            'data' => ProductType::getNames(0),
            'value' => $model->idType,
            'options' => [
                'placeholder' => 'Please select ...',
                'id'=>'subtype',
            ],
    ]);?>

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
