<?php

namespace app\models;
use paulzi\nestedsets\NestedSetsQueryTrait;

class MenuQuery extends \yii\db\ActiveQuery
{
    use NestedSetsQueryTrait;
}