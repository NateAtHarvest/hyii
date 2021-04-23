<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace hyii\console\controllers;

use Hyii;
use hyii\console\Controller;
use hyii\migrations\Install;
use Seld\CliPrompt\CliPrompt;
use yii\console\ExitCode;
use yii\db\config;
use yii\helpers\Console;


class InstallController extends Controller
{
    public $isWorkingDbConnection;
    // public $defaultAction = 'index';

    /**
     * Installs Hyii
     *
     * @param bool $bUseBaseInstallMigration
     *
     * @return int Exit code
     */
    public function actionIndex($bUseBaseInstallMigration=true)
    {
        // check to see if the database connection is working.
        $this->getIsDbConnectionValid();

        // proceed or exit depending on whether the API has been installed yet.
        if (Hyii::$app->getIsInstalled()) {
            Hyii::_console("App is already installed.");
            return ExitCode::OK;
        }

        Hyii::_console("Installing...");

        /**
         * Most projects will not use the base install migration
         */
        if ($bUseBaseInstallMigration) {
            $installMigration = new Install();
            $result = $installMigration->safeUp();

            if ($result) {
                Hyii::_console("Installation Done! ");
            } else {
                Hyii::_console("Installation Failed!");
            }
            return ExitCode::OK;
        }
    }

    /**
     * This is only available in dev mode
     */
    public function actionUninstall() {
        $uninstallMigration = new Install();

        $result = $uninstallMigration->safeDown();

        if ($result) {
            Hyii::_console("Removal Done! ");
        } else {
            Hyii::_console("Removal Failed!");
        }
    }

    /**
     * Returns whether the DB connection settings are valid
     */
    public function getIsDbConnectionValid()
    {
        try {
            Hyii::$app->db->open();
            $this->isWorkingDbConnection = true;
        } catch (yii\db\Exception $e) {
            Hyii::_console("There was a problem connecting to the database.");
            $this->isWorkingDbConnection = true;
        }
    }

}
