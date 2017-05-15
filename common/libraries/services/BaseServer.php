<?php

namespace common\libraries\services;

use Yii;

/**
 * @author Jianlong Hao <805449488@qq.com>
 */
class BaseServer
{
    /**
     * new static()
     * @var $_server
     */
    // private $_server;

    /**
     * \yii\db\ActiveRecord
     * @var $_model;
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
    public static function getServer($model){
        if (!($model instanceof \yii\db\ActiveRecord)) {
            return null;
        }

        // if (self::$_server) {
        //     return self::$_server;
        // }

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
