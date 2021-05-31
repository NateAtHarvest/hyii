<?php

namespace hyii\base;

use Hyii;
use hyii\helpers\HyiiHelper;
use hyii\base\WebController;

class PrivateWebController extends WebController {

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        if (HyiiHelper::isUserFunctionalityInstalled() === false) {
            exit("User Functionality not installed! Install it through the console.");
        }

        Hyii::$app->user->enableSession = true;

        if (HyiiHelper::getUser() == "") {
            $this->redirect("/login");
        }
    }

}