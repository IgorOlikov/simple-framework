<?php

namespace app\core;
use app\migrations;
use app\migrations\m0001_initial;
use PDO;



class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new PDO($dsn,$user,$password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $files = scandir(Application::$ROOT_DIR.'/migrations');

        $toApplyMigrations = array_diff($files, $appliedMigrations);


        foreach ($toApplyMigrations as $migration){
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR.'/migrations/'.$migration;  //require once m0001_initial.php
            $className = pathinfo($migration, PATHINFO_FILENAME);

            //docker bug !!!
            if ($className === "m0001_initial"){
              $instance = new m0001_initial();
            }
            if ($className === "m0002_add_password_column"){
                $instance = new migrations\m0002_add_password_column();
            }

            $this->log( "Applying migration $migration");
            $instance->up();
            $this->log( "Applied migration $migration");
            $newMigrations[] = $migration;
        }
        if (!empty($newMigrations)){
         $this->saveMigrations($newMigrations);
        }else{
              $this->log("all migrations are applied");
        }
    }

    public function  createMigrationsTable()
    {
        $this->pdo->exec(
            "create table if not exists migrations (
            id serial primary key ,
            migration varchar(255),
            created_at timestamp default current_timestamp)
          ");
    }

    public function getAppliedMigrations()
    {
       $statement = $this->pdo->prepare("select migration FROM migrations");
       $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode( ",",array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare( "insert into migrations (migration) VALUES 
            $str                              
        ");
        $statement->execute();
    }

    protected function log($message)
    {
        echo '['.date('Y-m-d H:i:s').'] - '.$message.PHP_EOL;
    }
}