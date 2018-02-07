<?php

namespace common\models\base\traits;

trait DbDefaultTrait
{
    /**
     * @return void
     */
    public function setTime($column,$time = null)
    {
        $this->$column = date('Y-m-d H:i:s', is_int($time) ? $time : time());
    }

}
