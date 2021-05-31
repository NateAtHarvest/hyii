<?php

namespace hyii\migrations;

use hyii\models\api\Section;
use yii\db\Migration;

class InstallBlog extends Migration
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
        $this->createPostsTable();
        $this->createSectionsTable();
        $this->createPostElementsTable();
        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        if (getenv('ENVIRONMENT') == "dev") {
            $this->dropTable("{{%posts}}");
            $this->dropTable("{{%sections}}");
            $this->dropTable("{{%post_elements}}");
            return true;
        } else {
            echo PHP_EOL . PHP_EOL . PHP_EOL . "*** Uninstalling is only available in the dev environment." . PHP_EOL . PHP_EOL . PHP_EOL;
            return false;
        }
    }


    /**
     * Create the Users Table and Populate it
     */
    private function createPostsTable()
    {
        $this->createTable("{{%posts}}", [
            'id' => $this->primaryKey(),
            'title' => $this->string(225),
            'author' => $this->integer(),
            'section' => $this->integer(),
            'date' => $this->dateTime()->defaultExpression("CURRENT_TIMESTAMP"),
            'trashed' => "ENUM('Y','N','S') DEFAULT 'N'",
        ]);
    }

    private function createSectionsTable()
    {
        $this->createTable("{{%sections}}", [
            'id' => $this->primaryKey(),
            'title' => $this->string(225),
            'slug' => $this->string(225),
            'trashed' => "ENUM('Y','N','S') DEFAULT 'N'",
        ]);

        $section = new Section([
            "title" => "General",
            "slug" => "general"
        ]);

        $section->save();

    }

    /**
     * Create the Users Table and Populate it
     */
    private function createPostElementsTable()
    {
        $this->createTable("{{%post_elements}}", [
            'id' => $this->primaryKey(),
            'post' => $this->integer(),
            'order' => $this->integer(),
            'data' => $this->text(),
            'type' => $this->string(225),
            'trashed' => "ENUM('Y','N','S') DEFAULT 'N'",
        ]);
    }


}