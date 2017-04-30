<?php

namespace common\libraries\db;

class ActiveQuery extends \yii\db\ActiveQuery
{
    public function where($condition)
    {
        return $this->andWhere($condition);
    }
}
