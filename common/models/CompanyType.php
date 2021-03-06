<?php

namespace common\models;

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
    use base\traits\ArrayNameTrait;

    protected $touches = [
    	'companies'
    ];

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['idType' => 'id']);
    }

}
