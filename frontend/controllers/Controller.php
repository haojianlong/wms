<?php

namespace frontend\controllers;

use Yii;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Role;

/**
 * ARController implements the CRUD actions for AR model.
 */
class Controller extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['logout', 'signup'],
                // 'only' => ['login'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $role = json_decode(Yii::$app->user->identity->role->role);
        if (!in_array(array_search($this->role, Role::$roles), $role)) {
            throw new ForbiddenHttpException("Error Processing Request", 403);
        }
        return parent::beforeAction($action);
    }


}
