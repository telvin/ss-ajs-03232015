<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_collection_variant}}".
 *
 * @property string $cv_id
 * @property string $name
 * @property string $collection_id
 * @property integer $shared
 * @property string $icon_image
 * @property string $description
 * @property string $rc_help_comment
 * @property integer $defined_as
 * @property string $member_id
 * @property string $account_id
 * @property string $kiosk_bookmark_iv_id
 * @property string $created_date
 * @property string $updated_date
 *
 * @property AccountStorage[] $accountStorages
 * @property Collection $collection
 * @property CvGv[] $cvGvs
 * @property GroupVariant[] $gvs
 * @property CvIv[] $cvIvs
 * @property ItemVariant[] $ivs
 * @property CvSharedAccount[] $cvSharedAccounts
 * @property AccountUser[] $accounts
 * @property CvSharedMember[] $cvSharedMembers
 * @property Member[] $sharedToMembers
 * @property KioskButtonSetting[] $kioskButtonSettings
 * @property KioskInteracting[] $kioskInteractings
 * @property KioskMonitorSkin[] $kioskMonitorSkins
 * @property KioskPin $kioskPin
 * @property KioskRules[] $kioskRules
 * @property KioskSettings[] $kioskSettings
 * @property MemberStorage[] $memberStorages
 * @property PubSkin[] $pubSkins
 * @property ItemVariant[] $pskinIvs
 */
class CollectionVariant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_collection_variant}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['collection_id'], 'required'],
            [['collection_id', 'shared', 'defined_as', 'member_id', 'account_id', 'kiosk_bookmark_iv_id'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name', 'description', 'rc_help_comment'], 'string', 'max' => 200],
            [['icon_image'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cv_id' => Yii::t('app', 'Cv ID'),
            'name' => Yii::t('app', 'Name'),
            'collection_id' => Yii::t('app', 'Collection ID'),
            'shared' => Yii::t('app', 'Shared'),
            'icon_image' => Yii::t('app', 'Icon Image'),
            'description' => Yii::t('app', 'Description'),
            'rc_help_comment' => Yii::t('app', 'Rc Help Comment'),
            'defined_as' => Yii::t('app', 'Defined As'),
            'member_id' => Yii::t('app', 'Member ID'),
            'account_id' => Yii::t('app', 'Account ID'),
            'kiosk_bookmark_iv_id' => Yii::t('app', 'Kiosk Bookmark Iv ID'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountStorages()
    {
        return $this->hasMany(AccountStorage::className(), ['assoc_cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollection()
    {
        return $this->hasOne(Collection::className(), ['collection_id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCvGvs()
    {
        return $this->hasMany(CvGv::className(), ['cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGvs()
    {
        return $this->hasMany(GroupVariant::className(), ['gv_id' => 'gv_id'])->viaTable('{{%_cv_gv}}', ['cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCvIvs()
    {
        return $this->hasMany(CvIv::className(), ['cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvs()
    {
        return $this->hasMany(ItemVariant::className(), ['iv_id' => 'iv_id'])->viaTable('{{%_kiosk_settings}}', ['kiosk_cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCvSharedAccounts()
    {
        return $this->hasMany(CvSharedAccount::className(), ['cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(AccountUser::className(), ['account_id' => 'account_id'])->viaTable('{{%_cv_shared_account}}', ['cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCvSharedMembers()
    {
        return $this->hasMany(CvSharedMember::className(), ['cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSharedToMembers()
    {
        return $this->hasMany(Member::className(), ['member_id' => 'shared_to_member_id'])->viaTable('{{%_cv_shared_member}}', ['cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKioskButtonSettings()
    {
        return $this->hasMany(KioskButtonSetting::className(), ['cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKioskInteractings()
    {
        return $this->hasMany(KioskInteracting::className(), ['kiosk_cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKioskMonitorSkins()
    {
        return $this->hasMany(KioskMonitorSkin::className(), ['kiosk_cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKioskPin()
    {
        return $this->hasOne(KioskPin::className(), ['kiosk_cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKioskRules()
    {
        return $this->hasMany(KioskRules::className(), ['skin_to_cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKioskSettings()
    {
        return $this->hasMany(KioskSettings::className(), ['kiosk_cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberStorages()
    {
        return $this->hasMany(MemberStorage::className(), ['assoc_cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPubSkins()
    {
        return $this->hasMany(PubSkin::className(), ['skin_cv_id' => 'cv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPskinIvs()
    {
        return $this->hasMany(ItemVariant::className(), ['iv_id' => 'pskin_iv_id'])->viaTable('{{%_pub_skin}}', ['skin_cv_id' => 'cv_id']);
    }
}
