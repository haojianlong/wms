<?php
/**
 * Created by PhpStorm.
 * User: hjl
 * Date: 2018/1/12
 * Time: 下午5:50
 */

namespace console\demo;

use console\helpers\Stdout;
use yii\base\BaseObject;

/**
 * Class Process
 * 多个子进程分别获取一个数组的一个值，再使用Shared Memory开启一个内存段，将数据写入，由母进程获取输出。
 * 但是很操蛋，使用一个共享内存段，子进程先读再写，就可能覆盖掉其它进程的写入，相当于数据库无事物，这很蠢。
 * 可以用多个内存段解决，很简单，我就不写代码了。
 * @package console\demo
 */
final class Process extends BaseObject
{
    public $data;

    public $size = 64;

    public function init()
    {
        $this->data['shmId'] = shmop_open('456', 'c', 0644, $this->size);
    }

    public function run($n = 3)
    {
        $pids = $this->fork($n);
        if (is_array($pids)) {
            Stdout::printf('parent');
            $this->wait($pids);
            $this->parent();
        } else {
            $this->child($pids);
            Stdout::printf('child' . $pids . ':' . posix_getpid());
            die();
        }
        Stdout::printf('exit');
    }

    public function wait($pids)
    {
        foreach ($pids as $pid) {
            pcntl_waitpid($pid, $status);
        }
    }

    public function fork($n)
    {
        if (!is_numeric($n)) {
            $this->error('fork $n error');
        }
        for ($i = 0; $i < $n; $i++) {
            $pid = pcntl_fork();
            if ($pid === 0) {
                return $i;
            } elseif ($pid === -1) {
                $this->error('fork error');
            }
            $pids[] = $pid;
        }
        return $pids;
    }

    public function parent()
    {
        $string = shmop_read($this->data['shmId'], 0, $this->size);
        shmop_delete($this->data['shmId']);
        $data = explode('-|-', $string);
        array_pop($data);
        Stdout::printf($data);
    }

    public function child($i)
    {
        $data = [
            'hahaha',
            'hehehe',
            'ert',
            'rdtert'
        ];
        if (isset($data[$i])) {
            $string = shmop_read($this->data['shmId'], 0, $this->size);
            $offset = strrpos($string, '-|-');
            if ($offset){
                $string = substr_replace($string, $data[$i] . $i . '-|-', $offset + 3);
            } else {
                $string = $data[$i] . $i . '-|-';
            }
            shmop_write($this->data['shmId'], $string,0);
        } else {
            $this->error('child error:' . $i);
        }
    }

    public function error($data)
    {
        Stdout::error($data);
        exit();
    }
}