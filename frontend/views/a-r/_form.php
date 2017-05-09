<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\date\DatePicker;
use common\models\Company;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\AR */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'idCompany')->widget(Select2::classname(), ['data' => Company::getNames()]);?>

    <?=$form->field($model, 'idProduct')->widget(Select2::classname(), ['data' => Product::getNames()]);?>

    <?=$form->field($model, 'type')->widget(Select2::classname(), ['data' => $model::$type]);?>

    <?=$form->field($model, 'date')->widget(DatePicker::classname(), [
        'options' => [
            'value' => date('Y-m-d')
        ],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]);?>

    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>

  <!--   <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
