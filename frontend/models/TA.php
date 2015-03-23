<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_a".
 *
 * @property integer $id
 * @property string $name
 *
 * @property TB[] $tBs
 */
class TA extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_a';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBs()
    {
        return $this->hasMany(TB::className(), ['t_a_id' => 'id']);
    }
}
