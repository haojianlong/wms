<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AR */

$this->title = Yii::t('app', 'Create Ar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
