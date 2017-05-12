<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AR */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'idUser',
                'value' => function($model){
                    return $model->user->username;
                },
            ],
            [
                'attribute' => 'idCompany',
                'value' => function($model){
                    return $model->company->name;
                },
            ],
            [
                'attribute' => 'idProduct',
                'value' => function($model){
                    return $model->product->name;
                },
            ],
            [
                'attribute' => 'idWarehouse',
                'value' => function($model){
                    return $model->warehouse->name;
                },
            ],
            'date',
            [
                'attribute' => 'type',
                'value' => function($model){
                    return Yii::t('app', $model::$type[$model->type]);
                },
            ],
            'quantity',
            'price',
            'note',
            'createdAt',
            'updatedAt',
        ],
    ]) ?>

</div>
