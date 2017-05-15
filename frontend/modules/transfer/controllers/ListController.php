<?php

namespace frontend\modules\transfer\controllers;

use Yii;
use common\models\Transfer;
use common\models\Product;
use common\models\search\Transfer as TransferSearch;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
/**
 * TransferController implements the CRUD actions for Transfer model.
 */
class ListController extends BaseController
{
    /**
     * Lists all Transfer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
