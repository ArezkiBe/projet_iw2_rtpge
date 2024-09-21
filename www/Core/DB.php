<?php

namespace App\Core;

class DB
{
    private $pdo;
    private $prefix = PREFIX.'_';
    private $table;

    public function __construct()
    {
        //Connexion à la bdd
        try{
            $this->pdo = new \PDO("pgsql:host=".DB_HOST.";port=5432;dbname=".DB_NAME, DB_USERNAME, DB_PWD);
        }catch (\PDOException $exception){
            echo "Erreur de connexion à la base de données : ".$exception->getMessage();
        }
    
        $table = get_called_class();
        
        $table = explode("\\", $table);
        $table = array_pop($table);
        $this->table = $this->prefix.strtolower($table);
    }

    public function getChlidVars(): array
    {
        $vars = array_diff_key(get_object_vars($this), get_class_vars(get_class()));
        return $vars;
    }

    public function save(): void
    {   
        // Création et execution d'une requête insert SQL
        $childVars = $this->getChlidVars();
        if (empty($this->getId())) {
            $sql = "INSERT INTO ".$this->table." (".implode(", ", array_keys($childVars)).") VALUES (:".implode(", :", array_keys($childVars)).")";
        } else {
            $sql = "UPDATE ".$this->table." SET ";
            foreach ($childVars as $key => $value){
                $sql .= $key."=:".$key.", ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= " WHERE id=:id";
            $childVars["id"] = $this->getId();
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($childVars);
    }
    
    public static function populate($id): object|int
    {
        return (new static())->getOneBy(["id" => $id], "object");
    }

    public function getOneBy(array $data, $return = "array"): object|array|int
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE ";
        foreach ($data as $key => $value) {
            $sql .= $key . "=:" . $key . " AND ";
        }
        $sql = substr($sql, 0, -5);
        $query = $this->pdo->prepare($sql);
        //var_dump($data);
        $query->execute($data);

        if($return == "object")
            $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        return $query->fetch();
    }

    public function getAll($return = 'array'): array 
    {
        $sql = "SELECT * FROM " . $this->table;
        
        $query = $this->pdo->prepare($sql);
        $query->execute();
        if ($return === 'object') {
            return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        } else {
            return $query->fetchAll();
        }
        
    }

    public function getAllBy(array $data, $return = 'array'): array
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE ";
        $params = [];
        foreach ($data as $key => $value) {
            $sql .= $key . "=:" . $key . " AND ";
            $params[':' . $key] = $value;
        }
        $sql = substr($sql, 0, -5);
        $query = $this->pdo->prepare($sql);
        $query->execute($params);

        if ($return === 'object') {
            return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        } else {
            return $query->fetchAll();
        }
    }

    public function select(string $sql, array $parameters)
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function deleteBy(array $data, $return = "array") :  object|array|int 
    {
        $sql = "DELETE FROM " . $this->table . " WHERE ";
        foreach ($data as $key => $value) {
            $sql .= $key . "=:" . $key . " AND ";
        }
        $sql = substr($sql, 0, -5);
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        if($return == "object")
            $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        return $query->fetch();

    }
    

    public function checkUnique(string $bddKey,$value) : bool
    {
        $request = $this->getOneBy([$bddKey => $value]);
        if ($request == 0) 
        {
                return true;
        }else {
                return false;
        }
    }

    public function deleteById(int $id): bool
    {
        // Préparer la requête SQL pour supprimer l'entrée avec l'ID spécifié
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $params = [':id' => $id];

        // Préparer et exécuter la requête
        $query = $this->pdo->prepare($sql);
        $success = $query->execute($params);

        // Retourner vrai si la suppression a réussi, sinon faux
        return $success;
    }

    public static function count(): int
    {
        $db = new self();
        $sql = "SELECT COUNT(*) FROM " . $db->table;
        $query = $db->pdo->query($sql);
        return (int) $query->fetchColumn();
    }
}