<?php

namespace frontend\modules\transfer\controllers;

use common\models\search\Transfer as TransferSearch;
use Yii;

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
