<?php

namespace App\Models;

use App\Dao\DaoImpl\DaoImplementation;
use App\Entities\Category;
use PDO;

class CategoryModel extends DaoImplementation
{
    public function __construct()
    {
        parent::__construct("categories"); 
    }

    public function getById($id)
{
    $query = "SELECT * FROM $this->tableName WHERE id = :id";
    $statement = $this->getConnection()->prepare($query);
    $statement->bindParam(":id", $id, PDO::PARAM_INT);

    if ($statement->execute()) {
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Category(
                $result['id'],
                $result['name'],
                $result['picture']
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
            $categories = [];

            foreach ($results as $result) {
                $category = new Category(
                    $result['id'],
                    $result['name'],
                    $result['picture']
                );

                $category->setId($result['id']);
                $categories[] = $category;
            }

            return $categories;
        } else {
            return [];
        }
    }

    public function save( $category): void
    {
        try {
            $query = "INSERT INTO $this->tableName (name, picture) VALUES (:name, :picture)";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':name', $category->getName(), PDO::PARAM_STR);
            $statement->bindParam(':picture', $category->getPicture(), PDO::PARAM_STR);

            $result = $statement->execute();

            if ($result) {
                $category->setId($this->getConnection()->lastInsertId());
            } else {
                throw new \RuntimeException("Failed to save the entity to the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function update( $category): void
    {
        try {
            $query = "UPDATE $this->tableName SET name = :name, picture = :picture WHERE id = :id";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':id', $category->getId(), PDO::PARAM_INT);
            $statement->bindParam(':name', $category->getName(), PDO::PARAM_STR);
            $statement->bindParam(':picture', $category->getPicture(), PDO::PARAM_STR);

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to update the entity in the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function delete( $category): void
    {
        try {
            $query = "DELETE FROM $this->tableName WHERE id = :id";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':id', $category->getId(), PDO::PARAM_INT);

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to delete the entity from the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function countCategories(): int
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
