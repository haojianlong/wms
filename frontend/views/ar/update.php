<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AR */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ar',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
