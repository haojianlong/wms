<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Company */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Company'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'idType',
                'value' => function($model){
                    return $model->type->name;
                },
            ],
            'name',
            'contact',
            'phone',
            // 'fax',
            // 'email:email',
            // 'bank',
            // 'bankAccount',
            // 'tariff',
            // 'zone',
            // 'address',
            // 'zipcode',
            // 'remark',
            // 'createdAt',
            // 'updatedAt',
            // 'deletedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
