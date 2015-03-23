<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_collection}}".
 *
 * @property string $collection_id
 * @property string $collection_name
 * @property string $icon_image
 * @property string $collection_extension
 * @property string $collection_supported_type
 * @property string $description
 * @property integer $type
 * @property string $display_order
 * @property integer $allow_up_icon
 * @property string $rc_help_comment
 * @property integer $defined_as
 * @property string $created_date
 * @property string $updated_date
 *
 * @property CollectionAction[] $collectionActions
 * @property ObjectAction[] $actions
 * @property CollectionVariant[] $collectionVariants
 * @property IvRepresentC[] $ivRepresentCs
 * @property ItemVariant[] $ivs
 * @property SubscriptionCollection[] $subscriptionCollections
 * @property SubscriptionType[] $subscriptionTypes
 * @property UcCollection[] $ucCollections
 * @property UserClass[] $ucs
 */
class Collection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_collection}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['collection_extension'], 'string'],
            [['type', 'display_order', 'allow_up_icon', 'defined_as'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['collection_name', 'icon_image'], 'string', 'max' => 200],
            [['collection_supported_type', 'description'], 'string', 'max' => 1000],
            [['rc_help_comment'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'collection_id' => Yii::t('app', 'Collection ID'),
            'collection_name' => Yii::t('app', 'Collection Name'),
            'icon_image' => Yii::t('app', 'Icon Image'),
            'collection_extension' => Yii::t('app', 'Collection Extension'),
            'collection_supported_type' => Yii::t('app', 'Collection Supported Type'),
            'description' => Yii::t('app', 'Description'),
            'type' => Yii::t('app', 'Type'),
            'display_order' => Yii::t('app', 'Display Order'),
            'allow_up_icon' => Yii::t('app', 'Allow Up Icon'),
            'rc_help_comment' => Yii::t('app', 'Rc Help Comment'),
            'defined_as' => Yii::t('app', 'Defined As'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollectionActions()
    {
        return $this->hasMany(CollectionAction::className(), ['collection_id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(ObjectAction::className(), ['action_id' => 'action_id'])->viaTable('{{%_collection_action}}', ['collection_id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollectionVariants()
    {
        return $this->hasMany(CollectionVariant::className(), ['collection_id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvRepresentCs()
    {
        return $this->hasMany(IvRepresentC::className(), ['collection_id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvs()
    {
        return $this->hasMany(ItemVariant::className(), ['iv_id' => 'iv_id'])->viaTable('{{%_iv_represent_c}}', ['collection_id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionCollections()
    {
        return $this->hasMany(SubscriptionCollection::className(), ['collection_id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionTypes()
    {
        return $this->hasMany(SubscriptionType::className(), ['id' => 'subscription_type_id'])->viaTable('{{%_subscription_collection}}', ['collection_id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcCollections()
    {
        return $this->hasMany(UcCollection::className(), ['collection_id' => 'collection_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcs()
    {
        return $this->hasMany(UserClass::className(), ['uc_id' => 'uc_id'])->viaTable('{{%_uc_collection}}', ['collection_id' => 'collection_id']);
    }
}
