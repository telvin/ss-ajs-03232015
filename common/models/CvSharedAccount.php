<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_cv_shared_account}}".
 *
 * @property string $cv_id
 * @property string $account_id
 * @property integer $is_owner
 *
 * @property AccountUser $account
 * @property CollectionVariant $cv
 */
class CvSharedAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_cv_shared_account}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cv_id', 'account_id'], 'required'],
            [['cv_id', 'account_id', 'is_owner'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cv_id' => Yii::t('app', 'Cv ID'),
            'account_id' => Yii::t('app', 'Account ID'),
            'is_owner' => Yii::t('app', 'Is Owner'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(AccountUser::className(), ['account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCv()
    {
        return $this->hasOne(CollectionVariant::className(), ['cv_id' => 'cv_id']);
    }
}
