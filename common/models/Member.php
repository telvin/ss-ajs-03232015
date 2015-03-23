<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_member}}".
 *
 * @property string $member_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $email
 * @property string $facetime_id
 * @property string $login_name
 * @property string $password
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $phone_number
 * @property string $registered_date
 * @property string $last_loggedin_date
 * @property string $address2
 * @property string $keywords
 * @property string $avatar
 * @property integer $member_type
 * @property integer $disable
 * @property string $upload_folder
 * @property string $full_name
 * @property string $description
 * @property string $beta
 * @property integer $is_admin
 * @property integer $is_superadmin
 * @property string $disabled_date
 * @property integer $priv_administer
 * @property integer $priv_new_forms
 * @property integer $priv_new_themes
 * @property string $cookie_hash
 *
 * @property AccountUserMember[] $accountUserMembers
 * @property AccountUser[] $accounts
 * @property CvSharedMember[] $cvSharedMembers
 * @property CollectionVariant[] $cvs
 * @property GvSharedMember[] $gvSharedMembers
 * @property GroupVariant[] $gvs
 * @property InviteAddmember[] $inviteAddmembers
 * @property IvSharedMember[] $ivSharedMembers
 * @property ItemVariant[] $ivs
 * @property MemberAddition[] $memberAdditions
 * @property MemberAllocterm $memberAllocterm
 * @property SettingMember[] $settingMembers
 * @property Setting[] $settings
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registered_date', 'last_loggedin_date', 'disabled_date'], 'safe'],
            [['member_type', 'disable', 'beta', 'is_admin', 'is_superadmin', 'priv_administer', 'priv_new_forms', 'priv_new_themes'], 'integer'],
            [['description'], 'string'],
            [['is_admin', 'is_superadmin'], 'required'],
            [['first_name', 'middle_name', 'last_name', 'email', 'facetime_id', 'login_name', 'password', 'address', 'city', 'phone_number', 'address2', 'keywords', 'avatar', 'upload_folder', 'cookie_hash'], 'string', 'max' => 255],
            [['state'], 'string', 'max' => 10],
            [['zip'], 'string', 'max' => 50],
            [['full_name'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_id' => Yii::t('app', 'Member ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'facetime_id' => Yii::t('app', 'Facetime ID'),
            'login_name' => Yii::t('app', 'Login Name'),
            'password' => Yii::t('app', 'Password'),
            'address' => Yii::t('app', 'Address'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'zip' => Yii::t('app', 'Zip'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'registered_date' => Yii::t('app', 'Registered Date'),
            'last_loggedin_date' => Yii::t('app', 'Last Loggedin Date'),
            'address2' => Yii::t('app', 'Address2'),
            'keywords' => Yii::t('app', 'Keywords'),
            'avatar' => Yii::t('app', 'Avatar'),
            'member_type' => Yii::t('app', 'Member Type'),
            'disable' => Yii::t('app', 'Disable'),
            'upload_folder' => Yii::t('app', 'Upload Folder'),
            'full_name' => Yii::t('app', 'Full Name'),
            'description' => Yii::t('app', 'Description'),
            'beta' => Yii::t('app', 'Beta'),
            'is_admin' => Yii::t('app', 'Is Admin'),
            'is_superadmin' => Yii::t('app', 'Is Superadmin'),
            'disabled_date' => Yii::t('app', 'Disabled Date'),
            'priv_administer' => Yii::t('app', 'Priv Administer'),
            'priv_new_forms' => Yii::t('app', 'Priv New Forms'),
            'priv_new_themes' => Yii::t('app', 'Priv New Themes'),
            'cookie_hash' => Yii::t('app', 'Cookie Hash'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUserMembers()
    {
        return $this->hasMany(AccountUserMember::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(AccountUser::className(), ['account_id' => 'account_id'])->viaTable('{{%_account_user_member}}', ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCvSharedMembers()
    {
        return $this->hasMany(CvSharedMember::className(), ['shared_to_member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCvs()
    {
        return $this->hasMany(CollectionVariant::className(), ['cv_id' => 'cv_id'])->viaTable('{{%_cv_shared_member}}', ['shared_to_member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGvSharedMembers()
    {
        return $this->hasMany(GvSharedMember::className(), ['shared_to_member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGvs()
    {
        return $this->hasMany(GroupVariant::className(), ['gv_id' => 'gv_id'])->viaTable('{{%_gv_shared_member}}', ['shared_to_member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteAddmembers()
    {
        return $this->hasMany(InviteAddmember::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvSharedMembers()
    {
        return $this->hasMany(IvSharedMember::className(), ['shared_to_member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvs()
    {
        return $this->hasMany(ItemVariant::className(), ['iv_id' => 'iv_id'])->viaTable('{{%_iv_shared_member}}', ['shared_to_member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberAdditions()
    {
        return $this->hasMany(MemberAddition::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberAllocterm()
    {
        return $this->hasOne(MemberAllocterm::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettingMembers()
    {
        return $this->hasMany(SettingMember::className(), ['member_id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Setting::className(), ['id' => 'setting_id'])->viaTable('{{%_setting_member}}', ['member_id' => 'member_id']);
    }
}
