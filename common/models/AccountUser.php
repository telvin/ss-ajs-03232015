<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_account_user}}".
 *
 * @property string $account_id
 * @property string $company
 * @property string $email
 * @property integer $address_type
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $phone_number
 * @property string $fax_number
 * @property string $avatar
 * @property string $registered_date
 * @property string $last_loggedin_date
 * @property string $upload_folder
 * @property string $member_id
 * @property integer $is_deleted
 * @property integer $is_admin
 * @property string $diskspace_cap
 * @property integer $is_frozen
 * @property integer $priv_administer
 * @property integer $priv_new_forms
 * @property integer $priv_new_themes
 * @property string $cookie_hash
 * @property integer $is_public
 * @property string $public_description
 *
 * @property AccountAddition[] $accountAdditions
 * @property AccountStorage[] $accountStorages
 * @property AccountUserMember[] $accountUserMembers
 * @property Member[] $members
 * @property CvSharedAccount[] $cvSharedAccounts
 * @property CollectionVariant[] $cvs
 * @property GvSharedAccount[] $gvSharedAccounts
 * @property GroupVariant[] $gvs
 * @property InviteAddmember[] $inviteAddmembers
 * @property IvSharedAccount[] $ivSharedAccounts
 * @property ItemVariant[] $ivs
 * @property SettingAccount[] $settingAccounts
 * @property Setting[] $settings
 */
class AccountUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_account_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_type', 'member_id', 'is_deleted', 'is_admin', 'is_frozen', 'priv_administer', 'priv_new_forms', 'priv_new_themes', 'is_public'], 'integer'],
            [['registered_date', 'last_loggedin_date'], 'safe'],
            [['company', 'email', 'address', 'address2', 'city', 'phone_number', 'fax_number', 'avatar', 'upload_folder', 'cookie_hash', 'public_description'], 'string', 'max' => 255],
            [['state'], 'string', 'max' => 10],
            [['zip'], 'string', 'max' => 50],
            [['diskspace_cap'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_id' => Yii::t('app', 'Account ID'),
            'company' => Yii::t('app', 'Company'),
            'email' => Yii::t('app', 'Email'),
            'address_type' => Yii::t('app', 'Address Type'),
            'address' => Yii::t('app', 'Address'),
            'address2' => Yii::t('app', 'Address2'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'zip' => Yii::t('app', 'Zip'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'fax_number' => Yii::t('app', 'Fax Number'),
            'avatar' => Yii::t('app', 'Avatar'),
            'registered_date' => Yii::t('app', 'Registered Date'),
            'last_loggedin_date' => Yii::t('app', 'Last Loggedin Date'),
            'upload_folder' => Yii::t('app', 'Upload Folder'),
            'member_id' => Yii::t('app', 'Member ID'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'is_admin' => Yii::t('app', 'Is Admin'),
            'diskspace_cap' => Yii::t('app', 'Diskspace Cap'),
            'is_frozen' => Yii::t('app', 'Is Frozen'),
            'priv_administer' => Yii::t('app', 'Priv Administer'),
            'priv_new_forms' => Yii::t('app', 'Priv New Forms'),
            'priv_new_themes' => Yii::t('app', 'Priv New Themes'),
            'cookie_hash' => Yii::t('app', 'Cookie Hash'),
            'is_public' => Yii::t('app', 'Is Public'),
            'public_description' => Yii::t('app', 'Public Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAdditions()
    {
        return $this->hasMany(AccountAddition::className(), ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountStorages()
    {
        return $this->hasMany(AccountStorage::className(), ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountUserMembers()
    {
        return $this->hasMany(AccountUserMember::className(), ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['member_id' => 'member_id'])->viaTable('{{%_account_user_member}}', ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCvSharedAccounts()
    {
        return $this->hasMany(CvSharedAccount::className(), ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCvs()
    {
        return $this->hasMany(CollectionVariant::className(), ['cv_id' => 'cv_id'])->viaTable('{{%_cv_shared_account}}', ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGvSharedAccounts()
    {
        return $this->hasMany(GvSharedAccount::className(), ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGvs()
    {
        return $this->hasMany(GroupVariant::className(), ['gv_id' => 'gv_id'])->viaTable('{{%_gv_shared_account}}', ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteAddmembers()
    {
        return $this->hasMany(InviteAddmember::className(), ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvSharedAccounts()
    {
        return $this->hasMany(IvSharedAccount::className(), ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvs()
    {
        return $this->hasMany(ItemVariant::className(), ['iv_id' => 'iv_id'])->viaTable('{{%_iv_shared_account}}', ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettingAccounts()
    {
        return $this->hasMany(SettingAccount::className(), ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Setting::className(), ['id' => 'setting_id'])->viaTable('{{%_setting_account}}', ['account_id' => 'account_id']);
    }
}
