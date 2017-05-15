<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\AR;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Transfer */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transfers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'header' => 'Product',
                'value' => function($model){
                    $ar = AR::findOne($model->idArOut);
                    return $ar->product->name;
                },
            ],
            [
                'attribute' => 'idArOut',
                'format' => 'html',
                'value' => function($model){
                    $ar = AR::findOne($model->idArOut);
                    return Html::a($ar->warehouse->name, ['/a-r/view','id' =>$ar->id]);
                },
            ],
            [
                'attribute' => 'idArInto',
                'format' => 'html',
                'value' => function($model){
                    $ar = AR::findOne($model->idArInto);
                    return Html::a($ar->warehouse->name, ['/a-r/view','id' =>$ar->id]);
                },
            ],
            'quantity',
            'note',
            // 'createdAt',
            // 'updatedAt',
            // 'deletedAt',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
