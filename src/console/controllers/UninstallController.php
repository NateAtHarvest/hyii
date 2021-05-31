<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace hyii\console\controllers;

use Hyii;
use hyii\console\Controller;
use hyii\helpers\HyiiHelper;
use hyii\migrations\Install;
use hyii\migrations\InstallBlog;
use hyii\migrations\InstallUserManagement;
use yii\db\config;



class UninstallController extends Controller
{
    // public $defaultAction = 'index';

    /**
     * This is only available in dev mode
     */
    public function actionIndex()
    {

        $userManagementResult = false;
        if (HyiiHelper::isUserFunctionalityInstalled() === true) {
            $userManagementUninstallMigration = new InstallUserManagement();
            $userManagementResult = $userManagementUninstallMigration->safeDown();
        }

        $blogResult = false;
        if (HyiiHelper::isBlogFunctionalityInstalled() === true) {
            $blogMigration = new InstallBlog();
            $blogResult = $blogMigration->safeDown();
        }

        $uninstallMigration = new Install();
        $result = $uninstallMigration->safeDown();


        if ($result && $userManagementResult && $blogResult) {
            Hyii::_console("Removal Done! ");
        } else {
            Hyii::_console("Removal Failed!");
        }
    }

}
