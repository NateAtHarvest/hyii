<?php

namespace hyii\models\api;

use Hyii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Section extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sections}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','slug'], 'required'],
        ];
    }

}