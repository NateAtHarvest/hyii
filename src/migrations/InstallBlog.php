<?php

namespace hyii\migrations;

use hyii\helpers\HyiiHelper;
use hyii\models\api\Section;
use hyii\models\api\AssetFolderModel;
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
        $this->createAssetFoldersTable();
        $this->createAssetsTable();
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
            $this->dropTable("{{%asset_folders}}");
            $this->dropTable("{{%assets}}");
            return true;
        } else {
            echo PHP_EOL . PHP_EOL . PHP_EOL . "*** Uninstalling is only available in the dev environment." . PHP_EOL . PHP_EOL . PHP_EOL;
            return false;
        }
    }


    /**
     * Create the Posts Table
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
     * Create the Post Elements Table
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


    /**
     * Create the Asset Folders Table
     */
    private function createAssetFoldersTable()
    {
        $this->createTable("{{%asset_folders}}", [
            'id' => $this->primaryKey(),
            'section' => $this->integer(),
            'folderName' => $this->string(225),
            'type' => "ENUM('Local_Private','Local_Public','Object_Storage_Public') DEFAULT 'Local_Private'",
            'trashed' => "ENUM('Y','N','S') DEFAULT 'N'",
        ]);

        $firstSection = HyiiHelper::query()
            ->select("*")
            ->from("{{%sections}}")
            ->one();

        $assetFolder = new AssetFolderModel([
            'section' => $firstSection['id'],
            'folderName' => 'General Assets',
        ]);
        $assetFolder->save();
    }

    /**
     * Create the Asset Folders Table
     */
    private function createAssetsTable()
    {
        $this->createTable("{{%assets}}", [
            'id' => $this->primaryKey(),
            'section' => $this->integer(),
            'folder' => $this->integer(),
            'label' => $this->string(225),
            'description' => $this->text(),
            'type' => "ENUM('jpg','png','pdf') DEFAULT 'jpg'",
            'trashed' => "ENUM('Y','N','S') DEFAULT 'N'",
        ]);
    }


}