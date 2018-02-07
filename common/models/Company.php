<?php

namespace common\models;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property int $idType
 * @property string $name
 * @property string $contact
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $bank
 * @property string $bankAccount
 * @property string $tariff
 * @property string $zone
 * @property string $address
 * @property string $zipcode
 * @property string $remark
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 *
 * @property CompanyType $type
 */
class Company extends \common\models\base\Company
{
	use base\traits\ArrayNameTrait;

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(CompanyType::className(), ['id' => 'idType']);
    }
}
