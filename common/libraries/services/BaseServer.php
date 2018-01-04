<?php

namespace common\libraries\services;

use common\libraries\db\ActiveRecord;

/**
 * @author Jianlong Hao <805449488@qq.com>
 */
abstract class BaseServer
{
    /**
     * new static()
     * @var $_server
     */
    // private $_server;

    /**
     * @var ActiveRecord $_model ;
     */
    protected $_model;

    /**
     * @inheritdoc
     */
    private function __construct($model)
    {
        $this->_model = $model;
    }

    /**
     * @inheritdoc
     */
    public static function getServer($model)
    {
        if (!($model instanceof \yii\db\ActiveRecord)) {
            return null;
        }
        return new static($model);
    }

    /**
     * @inheritdoc
     */
    public function getModel()
    {
        return $this->_model;
    }

}
