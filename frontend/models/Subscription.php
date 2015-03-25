<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%_subscription}}".
 *
 * @property string $id
 * @property string $desktops
 * @property string $bookmarks
 * @property string $kiosks
 * @property string $dsign
 * @property string $isign
 * @property string $stores
 * @property string $software
 * @property string $storage
 * @property integer $webapp
 * @property integer $osxapp
 * @property integer $winapp
 * @property integer $aosapp
 * @property string $monthly
 * @property string $annual
 * @property string $modify_date
 * @property string $desktops_unit_price
 * @property string $kiosks_unit_price
 * @property string $storage_unit_price
 * @property string $dsign_price
 * @property string $isign_price
 *
 * @property MembershipGroupVariant[] $membershipGroupVariants
 * @property GroupVariant[] $gvs
 * @property SubscriptionType $id0
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_subscription}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'webapp', 'osxapp', 'winapp', 'aosapp'], 'integer'],
            [['modify_date'], 'safe'],
            [['desktops_unit_price', 'kiosks_unit_price', 'storage_unit_price', 'dsign_price', 'isign_price'], 'number'],
            [['desktops', 'bookmarks', 'kiosks', 'dsign', 'isign', 'stores', 'software', 'monthly', 'annual'], 'string', 'max' => 20],
            [['storage'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'desktops' => Yii::t('app', 'Desktops'),
            'bookmarks' => Yii::t('app', 'Bookmarks'),
            'kiosks' => Yii::t('app', 'Kiosks'),
            'dsign' => Yii::t('app', 'Dsign'),
            'isign' => Yii::t('app', 'Isign'),
            'stores' => Yii::t('app', 'Stores'),
            'software' => Yii::t('app', 'Software'),
            'storage' => Yii::t('app', 'Storage'),
            'webapp' => Yii::t('app', 'Webapp'),
            'osxapp' => Yii::t('app', 'Osxapp'),
            'winapp' => Yii::t('app', 'Winapp'),
            'aosapp' => Yii::t('app', 'Aosapp'),
            'monthly' => Yii::t('app', 'Monthly'),
            'annual' => Yii::t('app', 'Annual'),
            'modify_date' => Yii::t('app', 'Modify Date'),
            'desktops_unit_price' => Yii::t('app', 'Desktops Unit Price'),
            'kiosks_unit_price' => Yii::t('app', 'Kiosks Unit Price'),
            'storage_unit_price' => Yii::t('app', 'Storage Unit Price'),
            'dsign_price' => Yii::t('app', 'Dsign Price'),
            'isign_price' => Yii::t('app', 'Isign Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipGroupVariants()
    {
        return $this->hasMany(MembershipGroupVariant::className(), ['subscription_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMsGvs()
    {
        return $this->hasMany(GroupVariant::className(), ['gv_id' => 'gv_id'])->viaTable('{{%_membership_group_variant}}', ['subscription_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(SubscriptionType::className(), ['id' => 'id']);
    }
}
