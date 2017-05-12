<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\date\DatePicker;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\Transfer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transfer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'idArOut')->widget(Select2::classname(), ['data' => Product::getNames()]);?>

    <?= $form->field($model, 'idArInto')->textInput() ?>

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
