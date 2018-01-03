<?php

namespace console\controllers;

use common\libraries\openssl\RSA;
use yii\console\Controller;
use yii\helpers\Console;


/**
 * ARController implements the CRUD actions for AR model.
 */
class PkeyController extends Controller
{
    public function actionRsa()
    {
        $pkey = RSA::generate();
        foreach ($pkey as $name => $key) {
            $this->stdout($name.':' . PHP_EOL, Console::FG_GREEN);
            $this->stdout($key);
        }
        $this->stdout('End' . PHP_EOL, Console::FG_GREEN);
    }
}
