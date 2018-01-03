<?php

namespace frontend\modules\v1\controllers;

use frontend\modules\v1\libraries\Controller;
use frontend\modules\v1\models\User;

/**
 * Default controller for the `v1` module
 */
class UserController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return User::find()->all();
    }
}
