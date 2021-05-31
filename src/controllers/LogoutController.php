<?php

namespace hyii\controllers;

use Hyii;
use hyii\base\WebController;
use hyii\helpers\HyiiHelper;
use hyii\models\LoginForm;

class LogoutController extends WebController {

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        /**
         * Before we show a login screen, we need to make sure user management is actually installed
         */
        if (HyiiHelper::isUserFunctionalityInstalled() === false) {
            exit("User Functionality not installed! Install it through the console.");
        }

        Hyii::$app->user->enableSession = true;
    }


    public function actionIndex()
    {
        Hyii::$app->user->logout();
        $this->redirect("/login");
    }

}