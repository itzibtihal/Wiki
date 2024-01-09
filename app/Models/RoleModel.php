<?php

namespace App\Models;

use App\Dao\DaoImpl\DaoImplementation;
use App\Entities\Role;
use PDO;

class RoleModel extends DaoImplementation
{
    public function __construct()
    {
        parent::__construct("roles"); 
    }

    public function getById($id)
    {
        $query = "SELECT * FROM $this->tableName WHERE id = :id";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        if ($statement) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new Role(
                    $result['name']
                );
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM $this->tableName";
        $statement = $this->getConnection()->query($query);

        if ($statement) {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $roles = [];

            foreach ($results as $result) {
                $role = new Role(
                    $result['name']
                );

                $role->setId($result['id']);
                $roles[] = $role;
            }

            return $roles;
        } else {
            return [];
        }
    }

    public function save($role): void
    {
        try {
            $query = "INSERT INTO $this->tableName (name) VALUES (:name)";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':name', $role->getName(), PDO::PARAM_STR);

            $result = $statement->execute();

            if ($result) {
                $role->setId($this->getConnection()->lastInsertId());
            } else {
                throw new \RuntimeException("Failed to save the entity to the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function update($role): void
    {
        try {
            $query = "UPDATE $this->tableName SET name = :name WHERE id = :id";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':id', $role->getId(), PDO::PARAM_INT);
            $statement->bindParam(':name', $role->getName(), PDO::PARAM_STR);

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to update the entity in the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function delete($role): void
    {
        try {
            $query = "DELETE FROM $this->tableName WHERE id = :id";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':id', $role->getId(), PDO::PARAM_INT);

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to delete the entity from the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function countRoles(): int
    {
        $query = "SELECT COUNT(*) FROM $this->tableName";
        $statement = $this->getConnection()->query($query);

        if ($statement) {
            return (int)$statement->fetchColumn();
        } else {
            return 0;
        }
    }
}
