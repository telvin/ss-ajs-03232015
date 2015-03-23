<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property integer $sku
 * @property string $name
 * @property double $price
 * @property double $mrp
 * @property string $description
 * @property string $packing
 * @property string $image
 * @property integer $category
 * @property integer $stock
 * @property string $status
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sku', 'name', 'price', 'mrp', 'description', 'packing', 'image', 'category', 'stock', 'status'], 'required'],
            [['sku', 'category', 'stock'], 'integer'],
            [['price', 'mrp'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 500],
            [['packing'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sku' => Yii::t('app', 'Sku'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'mrp' => Yii::t('app', 'Mrp'),
            'description' => Yii::t('app', 'Description'),
            'packing' => Yii::t('app', 'Packing'),
            'image' => Yii::t('app', 'Image'),
            'category' => Yii::t('app', 'Category'),
            'stock' => Yii::t('app', 'Stock'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
