<?php
/**
 * Created by PhpStorm.
 * User: hjl
 * Date: 2018/1/15
 * Time: 下午2:35
 */

namespace console\helpers;

use yii\helpers\Console;
use yii\helpers\VarDumper;

class Stdout
{
    public static function printf($data)
    {
        Console::stdout(Console::ansiFormat(VarDumper::export($data) . PHP_EOL, [Console::FG_GREEN]));
    }

    public static function error($data)
    {
        Console::stdout(Console::ansiFormat(VarDumper::export($data) . PHP_EOL, [Console::FG_RED]));
    }
}
