<?php

namespace app\migrations;

use app\core\Application;

class m0002_add_password_column
{
        public function up()
        {
            $db = Application::$app->db;
            $db->pdo->exec("alter table users add column password varchar(512)");
        }

        public function down()
        {
            $db = Application::$app->db;
            $db->pdo->exec("alter table users drop column password");
        }


}