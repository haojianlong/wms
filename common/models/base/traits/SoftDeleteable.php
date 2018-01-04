<?php

namespace common\models\base\traits;

trait SoftDeleteable
{
    protected $touches = [

    ];

    /**
     * @return bool
     */
    public function delete()
    {
        if (!$this->canDelete()) {
            return false;
        }
        $this->deletedAt = date('Y-m-d H:i:s');
        $this->save();
        return true;
    }

    public function validateDelete()
    {
        //$this->deletedAt = time();
    }

    public function canDelete()
    {
        foreach ($this->touches as $value) {
            if (count($this->$value)) {
                return false;
            }
        }
        return true;
    }
}
