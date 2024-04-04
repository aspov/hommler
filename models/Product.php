<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $sku
 * @property string|null $name
 * @property string|null $count
 * @property string|null $type
 */
class Product extends \yii\db\ActiveRecord
{
    public $search;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'sku', 'name', 'count', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'sku' => 'Sku',
            'name' => 'Name',
            'count' => 'Count',
            'type' => 'Type',
        ];
    }
}
