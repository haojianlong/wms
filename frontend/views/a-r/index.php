<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AR */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ar'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // [
            //     'attribute' => 'idUser',
            //     'value' => function($model){
            //         return $model->user->username;
            //     },
            // ],
            // [
            //     'attribute' => 'idCompany',
            //     'value' => function($model){
            //         return $model->company->name;
            //     },
            // ],
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
            // 'price',
            // 'note',
            // 'createdAt',
            // 'updatedAt',
            // 'deletedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
