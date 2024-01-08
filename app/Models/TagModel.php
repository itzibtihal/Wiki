<?php

namespace MyApp\Model;

use App\Dao\DaoImpl\DaoImplementation;
use App\Entities\Tag;
use PDO;

class TagModel extends DaoImplementation
{
    public function __construct()
    {
        parent::__construct("tags");
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
                return new Tag(
                    $result['label']
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
            $tags = [];

            foreach ($results as $result) {
                $tag = new Tag(
                    $result['label']
                );

                $tag->setId($result['id']);
                $tags[] = $tag;
            }

            return $tags;
        } else {
            return [];
        }
    }



    public function save($tag): void
    {
        try {
            $query = "INSERT INTO $this->tableName (label) VALUES (:label)";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':label', $tag->getLabel(), PDO::PARAM_STR);

            $result = $statement->execute();

            if ($result) {
                $tag->setId($this->getConnection()->lastInsertId());
            } else {
                throw new \RuntimeException("Failed to save the entity to the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }




    public function update($tag): void
    {
        try {
            $query = "UPDATE $this->tableName SET label = :label WHERE id = :id";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':id', $tag->getId(), PDO::PARAM_INT);
            $statement->bindParam(':label', $tag->getLabel(), PDO::PARAM_STR);

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to update the entity in the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }




    public function delete($tag): void
    {
        try {
            $query = "DELETE FROM $this->tableName WHERE id = :id";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':id', $tag->getId(), PDO::PARAM_INT);

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to delete the entity from the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }


    public function countTags(): int
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
