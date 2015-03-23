<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_b".
 *
 * @property integer $id
 * @property integer $t_a_id
 *
 * @property TA $tA
 */
class TB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_b';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['t_a_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            't_a_id' => Yii::t('app', 'T A ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTA()
    {
        return $this->hasOne(TA::className(), ['id' => 't_a_id']);
    }
}
