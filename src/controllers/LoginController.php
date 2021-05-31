<?php

namespace hyii\controllers;

use Hyii;
use hyii\base\WebController;
use hyii\helpers\HyiiHelper;
use hyii\models\LoginForm;

class LoginController extends WebController {

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

    /**
     * Show a login form and handle its post
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function actionIndex()
    {
        $model = new LoginForm();

        if (empty($_POST)) {
            return $this->renderTemplate("login/login_form.twig");
        }

        // The $model->load method second parameter is blank because we are not passing in a form name
        if ($model->load(Hyii::$app->request->post(),'') && $model->login()) {

            $user = Hyii::$app->user->identity;

            $this->redirect("/dashboard/");

        } else {
            return $this->renderTemplate("login/login_form.twig", ["error" => "Login Failed"]);
        }
    }

}