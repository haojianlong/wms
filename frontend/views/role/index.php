<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\Role */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Role'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'role',
                'value' => function($model){
                    $roles = Json::decode($model->role);
                    $allRole = $model::$roles;
                    $data = '';
                    foreach ($roles as $role) {
                        if (isset($allRole[$role])) {
                            $data .= $allRole[$role].'; ';
                        }
                    }
                    return substr($data, 0, -2);
                },
            ],
            'createdAt',
            'updatedAt',
            // 'deletedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
