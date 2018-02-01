<?php

namespace console\controllers;

use console\demo\Process;
use console\helpers\Stdout;
use yii\console\Controller;


class ProcessController extends Controller
{
    public function actionIndex()
    {
        (new Process())->run();
    }
}
