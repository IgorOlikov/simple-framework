<?php

namespace app\migrations;

use app\core\Application;

class m0001_initial
{
    public function up()
    {
       $db = Application::$app->db;
       $SQL = "create table users (
        id serial primary key ,
        email varchar(255) NOT NULL ,
        firstname varchar(255) NOT NULL ,
        lastname varchar(255) NOT NULL ,
        status int default NULL,
        created_at timestamp default current_timestamp
        )";
       $db->pdo->exec($SQL);
    }
    public function down()
    {
        $db = Application::$app->db;
        $SQL = "drop table users";
        $db->pdo->exec($SQL);
    }

}