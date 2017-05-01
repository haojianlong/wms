<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company_type".
 *
 * @property int $id
 * @property string $name
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property Company[] $companies
 * @array name[] $names
 */
class CompanyType extends \common\models\base\CompanyType
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['idType' => 'id']);
    }

    /**
     * @return array $names
     */
    public static function getNames()
    {
        return ArrayHelper::map(self::find()->asArray()->all(),'id', 'name');
    }
}
