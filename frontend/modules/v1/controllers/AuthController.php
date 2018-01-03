<?php
/**
 * Created by PhpStorm.
 * User: hjl
 * Date: 2017/12/21
 * Time: 下午5:51
 */

namespace frontend\modules\v1\controllers;

use common\libraries\jwt\JWT;
use frontend\models\User;
use Yii;
use yii\base\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'basicAuth' => [
                'class' => \yii\filters\auth\HttpBasicAuth::className(),
                'auth' => function ($username, $password) {
                    $user = User::findByUsername($username);
                    if ($user->validatePassword($password)) {
                        return $user;
                    }
                    return null;
                },
            ],
        ];
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return JWT::generate(Yii::$app->user->identity);
    }
}
