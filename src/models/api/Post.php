<?php

namespace hyii\models\api;

use Hyii;
use yii\db\ActiveRecord;
use hyii\helpers\HyiiHelper;
use hyii\helpers\UserHelper;

class Post extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%posts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            ['section','default', 'value' => HyiiHelper::getGeneralSectionId()],
            ['author','default', 'value' => UserHelper::userId()],
        ];
    }

    public function add()
    {
        if ($this->validate()) {
            $this->save();
            return true;
        } else {
            return false;
        }
    }


    public static function getPosts()
    {
        return HyiiHelper::query()
            ->select("*")
            ->from("{{%posts}}")
            ->where("trashed='N'")
            ->all();
    }

}