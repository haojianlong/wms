<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AR */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Ars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ar'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idUser',
            'idCompany',
            'idProduct',
            'idWarehouse',
            // 'date',
            // 'type',
            // 'quantity',
            // 'price',
            // 'note',
            // 'createdAt',
            // 'updatedAt',
            // 'deletedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
