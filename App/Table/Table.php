<?php

namespace App\Table;

use PDO;
use Exception;


class Table {

    protected $pdo;
    protected $table = null;
    protected $class = null;

    public function __construct(PDO $pdo)
    {
        if($this->table === null) {
            throw new Exception("La class ". get_class($this) ."  n'a pas de propriete \$table");
        }
        if($this->class === null) {
            throw new Exception("La class ". get_class($this) ."  n'a pas de propriete \$class");
        }
        $this->pdo = $pdo;
    }
    
    /**
     * find
     * this function find the data in the DB using the ID
     *
     * @param  mixed $id
     * @return object
     */
    public function find(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE id = :id');
        $query->execute([
            'id' => $id
        ]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if($result === false) {
            return false;
        }
        return $result;
    }

    /**
     * create
     * This function create insert new data into the DB
     *
     * @param  mixed $data
     * @return int
     */
    public function create(array $data): int
    {
        $sqlFields = [];
        foreach($data as $key => $value){
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET " . implode(', ', $sqlFields));
        $create = $query->execute($data);
        if($create === false){
            throw new Exception("Impossible de creer l'enregistrement dans la table {$this->table}");
        }
        return (int)$this->pdo->lastInsertId();
    }
    
    /**
     * exists
     * this function check if a value already exists in the DB
     * 
     * @param  mixed $field
     * @param  mixed $value
     * @param  mixed $except
     * @return bool
     */
    public function exists(string $field, $value, ?int $except = null): bool 
    {
        $sql = "SELECT COUNT(id) FROM {$this->table} WHERE $field = ?";
        $params = [$value];
        if($except !== null) {
            $sql .= " AND id != ?";
            $params[] = $except;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0;
    }

    
    /**
     * update
     * This function updates a table in the DB
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public function update(array $data, int $id)
    {

        $sqlFields = [];
        foreach($data as $key => $value){
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("UPDATE {$this->table} SET " . implode(', ', $sqlFields) . " WHERE id = :id");
        $create = $query->execute(array_merge($data, ['id' => $id]));
        if($create === false){
            throw new Exception("Impossible de modifier l'enregistrement dans la table {$this->table}");
        }

    }
    

}

?>

        
            
                
            
            