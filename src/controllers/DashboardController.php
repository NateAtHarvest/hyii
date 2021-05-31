<?php

namespace hyii\controllers;

use Hyii;
use hyii\base\PrivateWebController;
use hyii\helpers\HyiiHelper;

class DashboardController extends PrivateWebController {

    public function actionIndex() {
        //BaseApi::dd(Helper::getUser());
        return $this->renderTemplate("dashboard/dashboard.twig");
    }

}