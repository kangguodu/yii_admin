<?php

namespace app\models;
use Yii;
use yii\base\Model;

class OptionsForm extends Options
{
    public $imagesign_carriage;

    public function attributeLabels()
    {
        return [
            'imagesign_carriage' => Yii::t('app', 'imagesign Carriage'),
        ];
    }

    /**
     * 填充网站配置
     *
     */
    public function getOptionsSetting()
    {
        $names = $this->getNames();
        foreach ($names as $name) {
            $model = self::findOne(['option_name' => $name]);
            if ($model != null) {
                $this->$name = $model->option_value;
            } else {
                $this->option_name = '';
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imagesign_carriage'], 'string'],
            //[['imagesign_carriage'], 'required'],
        ];
    }

    /**
     * 写入网站配置到数据库
     *
     * @return bool
     */
    public function setOptionsConfig()
    {
        $names = $this->getNames();
        foreach ($names as $name) {
            $model = self::findOne(['option_name' => $name]);
            if ($model != null) {
                $value = $this->$name;
                $value === null && $value = '';
                $model->option_value = $value;
                $result = $model->save();
            } else {
                $model = new Options();
                $model->option_name = $name;
                $model->option_value = '';
                $result = $model->save();
            }
            if ($result == false) {
                return $result;
            }
        }
        return true;
    }
}