<?php

namespace hyii\migrations;

use hyii\models\User;
use yii\db\Migration;

class Install extends Migration
{

    /**
     * Install constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        // hide the database output from the screen.
        $this->compact = true;
    }

    /**
     * @return bool
     */
    public function safeUp()
    {
        $this->createInfo();
        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        if (getenv('ENVIRONMENT') == "dev") {
            $this->dropTable("{{%info}}");
            return true;
        } else {
            echo PHP_EOL . PHP_EOL . PHP_EOL . "*** Uninstalling is only available in the dev environment." . PHP_EOL . PHP_EOL . PHP_EOL;
            return false;
        }
    }

    /**
     * Create the Info Table and Populate it
     */
    private function createInfo()
    {
        $this->createTable("{{%info}}", [
            'id' => $this->primaryKey(),
            'version' => $this->string()->notNull(),
            'dateCreated' => $this->timestamp()->defaultExpression("CURRENT_TIMESTAMP"),
            'dateUpdated' => $this->timestamp()->defaultExpression("CURRENT_TIMESTAMP"),
            'currentDataState' => $this->bigInteger(),
            'pendingDataState' => $this->bigInteger(),
        ]);

        $info = [
            "version" => "1.0"
        ];

        $this->insert("{{%info}}", $info);
    }

}