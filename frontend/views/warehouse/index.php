<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Warehouse */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Warehouses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Warehouse'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idType',
            'idLocation',
            'status',
            'name',
            // 'code',
            // 'address',
            // 'remark',
            // 'createdAt',
            // 'updatedAt',
            // 'deletedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
