<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%_group_variant}}".
 *
 * @property string $gv_id
 * @property string $name
 * @property string $group_id
 * @property string $member_id
 * @property string $account_id
 * @property integer $shared
 * @property string $icon_image
 * @property string $description
 * @property string $rc_help_comment
 * @property integer $defined_as
 * @property integer $is_kiosk_program
 * @property string $created_date
 * @property string $updated_date
 * @property string $publish_bookmark_iv_id
 * @property boolean $is_temp
 *
 * @property AccountStorage[] $accountStorages
 * @property CvGv[] $cvGvs
 * @property CollectionVariant[] $cvs
 * @property FlightSetting[] $flightSettings
 * @property ItemVariant[] $ivs
 * @property GroupDeviceItemVariant[] $groupDeviceItemVariants
 * @property Group $group
 * @property GroupVariantMachform[] $groupVariantMachforms
 * @property ItemVariant[] $machforms
 * @property GvIv[] $gvIvs
 * @property GvSharedAccount[] $gvSharedAccounts
 * @property AccountUser[] $accounts
 * @property GvSharedMember[] $gvSharedMembers
 * @property Member[] $sharedToMembers
 * @property MemberStorage[] $memberStorages
 * @property MembershipGroupVariant[] $membershipGroupVariants
 * @property Subscription[] $subscriptionTypes
 * @property Monitor[] $monitors
 * @property SearchQuery[] $searchQueries
 * @property Slideshow[] $slideshows
 * @property UserClass[] $userClasses
 */
class GroupVariant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_group_variant}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id'], 'required'],
            [['group_id', 'member_id', 'account_id', 'shared', 'defined_as', 'is_kiosk_program', 'publish_bookmark_iv_id'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['is_temp'], 'boolean'],
            [['name', 'rc_help_comment'], 'string', 'max' => 200],
            [['icon_image'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gv_id' => Yii::t('app', 'Gv ID'),
            'name' => Yii::t('app', 'Name'),
            'group_id' => Yii::t('app', 'Group ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'account_id' => Yii::t('app', 'Account ID'),
            'shared' => Yii::t('app', 'Shared'),
            'icon_image' => Yii::t('app', 'Icon Image'),
            'description' => Yii::t('app', 'Description'),
            'rc_help_comment' => Yii::t('app', 'Rc Help Comment'),
            'defined_as' => Yii::t('app', 'Defined As'),
            'is_kiosk_program' => Yii::t('app', 'Is Kiosk Program'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'publish_bookmark_iv_id' => Yii::t('app', 'Publish Bookmark Iv ID'),
            'is_temp' => Yii::t('app', 'Is Temp'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountStorages()
    {
        return $this->hasMany(AccountStorage::className(), ['assoc_gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCvGvs()
    {
        return $this->hasMany(CvGv::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCvs()
    {
        return $this->hasMany(CollectionVariant::className(), ['cv_id' => 'cv_id'])->viaTable('{{%_cv_gv}}', ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlightSettings()
    {
        return $this->hasMany(FlightSetting::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvs()
    {
        return $this->hasMany(ItemVariant::className(), ['iv_id' => 'iv_id'])->viaTable('{{%_gv_iv}}', ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupDeviceItemVariants()
    {
        return $this->hasMany(GroupDeviceItemVariant::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['group_id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupVariantMachforms()
    {
        return $this->hasMany(GroupVariantMachform::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachforms()
    {
        return $this->hasMany(ItemVariant::className(), ['iv_id' => 'machform_id'])->viaTable('{{%_group_variant_machform}}', ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGvIvs()
    {
        return $this->hasMany(GvIv::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGvSharedAccounts()
    {
        return $this->hasMany(GvSharedAccount::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(AccountUser::className(), ['account_id' => 'account_id'])->viaTable('{{%_gv_shared_account}}', ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGvSharedMembers()
    {
        return $this->hasMany(GvSharedMember::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSharedToMembers()
    {
        return $this->hasMany(Member::className(), ['member_id' => 'shared_to_member_id'])->viaTable('{{%_gv_shared_member}}', ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberStorages()
    {
        return $this->hasMany(MemberStorage::className(), ['assoc_gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipGroupVariants()
    {
        return $this->hasMany(MembershipGroupVariant::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionTypes()
    {
        return $this->hasMany(Subscription::className(), ['id' => 'subscription_type_id'])->viaTable('{{%_membership_group_variant}}', ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonitors()
    {
        return $this->hasMany(Monitor::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSearchQueries()
    {
        return $this->hasMany(SearchQuery::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlideshows()
    {
        return $this->hasMany(Slideshow::className(), ['gv_id' => 'gv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserClasses()
    {
        return $this->hasMany(UserClass::className(), ['gv_id' => 'gv_id']);
    }
}
