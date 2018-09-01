<?php

namespace app\models;

use Yii;
use paulzi\nestedsets\NestedSetsBehavior;
//use paulzi\autotree\AutoTreeTrait;
/**
 * This is the model class for table "menutest".
 *
 * @property int $id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $name
 * @property string $title
 * @property int $parent_id
 * @property int $order
 */
class Menutest extends \yii\db\ActiveRecord
{
   // use AutoTreeTrait;
    
    public function behaviors() {
        return [
            ['class' => NestedSetsBehavior::class],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menutest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lft', 'rgt', 'depth', 'name', 'title'], 'required'],
            [['lft', 'rgt', 'depth', 'parent_id', 'order'], 'integer'],
            [['name', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'depth' => Yii::t('app', 'Depth'),
            'name' => Yii::t('app', 'Name'),
            'title' => Yii::t('app', 'Title'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'order' => Yii::t('app', 'Order'),
        ];
    }
}
