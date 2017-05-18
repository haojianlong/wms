<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--         <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-primary']) ?> -->
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'idRole',
                'value' => function($model){
                    return $model->role->name;
                },
            ],
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'status',
            'createdAt',
            'updatedAt',
            // 'deletedAt',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'header' => 'Action',
            ],
        ],
    ]); ?>
</div>
