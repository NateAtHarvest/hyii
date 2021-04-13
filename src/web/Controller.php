<?php

namespace hyii\web;

use Hyii;
use yii\rest\Controller as RestController;

abstract class Controller extends RestController
{

    public function runAction($id, $params = [])
    {

        if (! Hyii::$app->getIsInstalled())  {

            /**
             * TODO: JSON response that the API has not been installed
             */
        }

        return parent::runAction($id, $params);
    }

}