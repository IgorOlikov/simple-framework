<?php

namespace app\core;

abstract class DbModel extends Model
{

    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("insert into $tableName (".implode(',', $attributes).") 
        VALUES(".implode(',', $params).")");

        foreach ($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
          $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr",$attributes));
         $statement = self::prepare("select * from $tableName where $sql");
         foreach ($where as $key => $item){
            $statement->bindValue(":$key", $item);
         }
         $statement->execute();
         return $statement->fetchObject(static::class);


    }


    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

}