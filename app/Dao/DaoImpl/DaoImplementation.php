<?php

namespace App\Dao\DaoImpl;


use App\Database\DbConnection;
use App\Dao\DaoInterface;
use PDO;

class DaoImplementation implements DaoInterface
{
    protected $db;
    protected $tableName;




    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->db = DbConnection::getInstance()->getConnection();
    }




   



    public function getById($id)
    {
        
    }




    public function getAll(): array
    {
        $query = "SELECT * FROM $this->tableName";
        $statement = $this->db->query($query);

        
        if ($statement) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            
            return [];
        }
    }




    public function save($entity): void
    {
       
    }




    public function update($entity): void
    {
       
    }



    public function delete($entity): void
    {
        
    }

 

    public function getTableName()
    {
        return $this->tableName;
    }

    protected function getConnection()
    {
        return $this->db;
    }

}