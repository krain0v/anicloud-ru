<?php


namespace Animelib\lib;

use Config\Database;
use JetBrains\PhpStorm\Language;
use PDO;
use PDOStatement;
use Symfony\Component\String\Inflector\EnglishInflector;

abstract class ModelsBase
{
    private string $classname_single;
    private string $classname_plural;
    private PDO $database;

    public function __construct()
    {
        $this->database = (new Database())->getQuery();
        $this->setClassname(get_called_class());
    }

    public function all(int $limit = 0) : array
    {
        $classname = $this->modelName();
        $scope = array();
        $query = $this->database->prepare('SELECT * FROM '.$this->classname_plural.' LIMIT '.$limit);
        $query->execute();
        return $this->scoping($query, $classname, $scope);
    }

    public function where(#[Language("SQL")] string $query = null) : array
    {
        {
            $classname = $this->modelName();
            $scope = array();
            $query = $this->database->prepare('SELECT * FROM '.$this->classname_plural.' WHERE '.$query);
            $query->execute();
            return $this->scoping($query, $classname, $scope);
        }
    }

    public function find(string $id) : Model|null
    {
        $classname = $this->modelName();
        $query = $this->database->prepare('SELECT * FROM '.$this->classname_plural);
        $query->execute();
        if ($query->rowCount() > 0)
        {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $scope = new $classname;
            foreach ($result as $item => $value)
            {
                $scope->$item = $value;
            }
        } else
            $scope = null;
        return $scope;
    }

    public function save(Model $class, string $name = '') : bool
    {
        $string = "";
        foreach ($class as $key => $value) {
            if (!preg_match('/classname|database/', $key)) {
                $value = str_replace("'", "\'", $value);
                $value = str_replace("\"", "\\\"", $value);
                $string .= "$key = '$value',";
            }
        }
        if ($name == '') {
            $query = $this->database->prepare('UPDATE ' . strtolower($this->classname_plural) . ' SET ' . substr_replace($string, "", -1) . ' WHERE id = :id');
            $query->bindValue(':id', $class->id);
        } else {
            $query = $this->database->prepare('UPDATE ' . strtolower($this->classname_plural) . ' SET ' . substr_replace($string, "", -1) . ' WHERE canonical = :name');
            $query->bindValue(':name', $name);
        }
        $query->execute();
        return true;
    }

    public function create(Model $class) : bool
    {
        $name = password_hash("null", algo: PASSWORD_DEFAULT);
        $query = $this->database->prepare('INSERT INTO '.strtolower($this->classname_plural).' (canonical) VALUES (:value)');
        $query->bindValue(":value", $name);
        $query->execute();
        $this->save($class, $name);
        return true;
    }

    public function setClassname(string $classname) : void
    {
        if ($pos = strrpos($classname, '\\'))
        {
            $this->classname_single = substr($classname, $pos + 1);
        }
        else
        {
            $this->classname_single = $pos;
        }
        $this->classname_plural = (new EnglishInflector)->pluralize($this->classname_single)[0];
    }

    private function modelName() : string
    {
        return '\Animelib\Models\\'.ucfirst($this->classname_single);
    }

    /**
     * @param bool|PDOStatement $query
     * @param string $classname
     * @param array $scope
     * @return array
     */
    private function scoping(bool|PDOStatement $query, string $classname, array $scope): array
    {
        if ($query->rowCount() > 0) {
            for ($i = 0; $i < $query->rowCount(); $i++) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $scope[$i] = new $classname;
                foreach ($result as $item => $value) {
                    $scope[$i]->$item = $value;
                }
            }
        }
        return $scope;
    }
}