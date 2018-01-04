<?php

namespace frontend\modules\transfer\controllers;

use common\libraries\services\TransferServer;
use common\models\Product;
use frontend\modules\transfer\models\Transfer;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * TransferController implements the CRUD actions for Transfer model.
 */
class DetailController extends BaseController
{
    public $idProduct;

    public $product;

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (!in_array($action->id, ['index'])) {
            $idProduct = (int)Yii::$app->request->get('idProduct');
            if (!$idProduct) {
                throw new BadRequestHttpException("Missing required parameters: idProduct.");
            }
            $this->product = Product::findOne($idProduct);
            if (!($this->product instanceof Product)) {
                throw new BadRequestHttpException("Server internal error.");
            }
        }
        return parent::beforeAction($action);
    }

    /**
     * Displays a single Transfer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transfer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transfer();

        if ($model->load(Yii::$app->request->post())) {
            $model->idArOut = $this->product->id;
            $server = TransferServer::getServer($model);
            $server->operate();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'product' => $this->product,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Transfer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Transfer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transfer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transfer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transfer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
