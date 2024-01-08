<?php

namespace App\Model;

use App\Dao\DaoImpl\DaoImplementation;
use App\Entities\Wiki;
use PDO;

class WikiModel extends DaoImplementation
{
    public function __construct()
    {
        parent::__construct("wikis"); 
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
                return new Wiki(
                    $result['picture'],
                    $result['title'],
                    $result['content'],
                    $result['read_min'],
                    $result['creation_date'],
                    $result['date_deleted'],
                    $result['status'],
                    $result['user_id'],
                    $result['category_id']
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
        $query = "SELECT * FROM $this->tableName WHERE status = 'verified' AND date_deleted IS NULL";
        $statement = $this->getConnection()->query($query);

        if ($statement) {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $wikis = [];

            foreach ($results as $result) {
                $wiki = new Wiki(
                    $result['picture'],
                    $result['title'],
                    $result['content'],
                    $result['read_min'],
                    $result['creation_date'],
                    $result['date_deleted'],
                    $result['status'],
                    $result['user_id'],
                    $result['category_id']
                );

                $wiki->setId($result['id']);
                $wikis[] = $wiki;
            }

            return $wikis;
        } else {
            return [];
        }
    }

    public function getAllArchived(): array
    {
        $query = "SELECT * FROM $this->tableName WHERE status = 'archived' OR date_deleted IS NOT NULL";
        $statement = $this->getConnection()->query($query);

        if ($statement) {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $archivedWikis = [];

            foreach ($results as $result) {
                $archivedWiki = new Wiki(
                    $result['picture'],
                    $result['title'],
                    $result['content'],
                    $result['read_min'],
                    $result['creation_date'],
                    $result['date_deleted'],
                    $result['status'],
                    $result['user_id'],
                    $result['category_id']
                );

                $archivedWiki->setId($result['id']);
                $archivedWikis[] = $archivedWiki;
            }

            return $archivedWikis;
        } else {
            return [];
        }
    }


    public function save( $wiki): void
    {
        try {
            $query = "INSERT INTO $this->tableName 
                      (picture, title, content, read_min, creation_date, date_deleted, status, user_id, category_id) 
                      VALUES 
                      (:picture, :title, :content, :read_min, :creation_date, :date_deleted, :status, :user_id, :category_id)";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':picture', $wiki->getPicture(), PDO::PARAM_STR);
            $statement->bindParam(':title', $wiki->getTitle(), PDO::PARAM_STR);
            $statement->bindParam(':content', $wiki->getContent(), PDO::PARAM_STR);
            $statement->bindParam(':read_min', $wiki->getReadMin(), PDO::PARAM_INT);
            $statement->bindParam(':creation_date', $wiki->getCreationDate(), PDO::PARAM_STR);
            $statement->bindParam(':date_deleted', $wiki->getDateDeleted(), PDO::PARAM_STR);
            $statement->bindParam(':status', $wiki->getStatus(), PDO::PARAM_STR);
            $statement->bindParam(':user_id', $wiki->getUserId(), PDO::PARAM_INT);
            $statement->bindParam(':category_id', $wiki->getCategoryId(), PDO::PARAM_INT);

            $result = $statement->execute();

            if ($result) {
                $wiki->setId($this->getConnection()->lastInsertId());
            } else {
                throw new \RuntimeException("Failed to save the entity to the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function update( $wiki): void
    {
        try {
            $query = "UPDATE $this->tableName 
                      SET 
                      picture = :picture,
                      title = :title,
                      content = :content,
                      read_min = :read_min,
                      creation_date = :creation_date,
                      date_deleted = :date_deleted,
                      status = :status,
                      user_id = :user_id,
                      category_id = :category_id
                      WHERE id = :id";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':id', $wiki->getId(), PDO::PARAM_INT);
            $statement->bindParam(':picture', $wiki->getPicture(), PDO::PARAM_STR);
            $statement->bindParam(':title', $wiki->getTitle(), PDO::PARAM_STR);
            $statement->bindParam(':content', $wiki->getContent(), PDO::PARAM_STR);
            $statement->bindParam(':read_min', $wiki->getReadMin(), PDO::PARAM_INT);
            $statement->bindParam(':creation_date', $wiki->getCreationDate(), PDO::PARAM_STR);
            $statement->bindParam(':date_deleted', $wiki->getDateDeleted(), PDO::PARAM_STR);
            $statement->bindParam(':status', $wiki->getStatus(), PDO::PARAM_STR);
            $statement->bindParam(':user_id', $wiki->getUserId(), PDO::PARAM_INT);
            $statement->bindParam(':category_id', $wiki->getCategoryId(), PDO::PARAM_INT);

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to update the entity in the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }



    public function delete($wiki): void
    {
        try {
            $query = "UPDATE $this->tableName 
                      SET 
                      status = 'archived',
                      date_deleted = CURRENT_TIMESTAMP
                      WHERE id = :id";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':id', $wiki->getId(), PDO::PARAM_INT);

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to archive the entity in the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function countVerifiedWikis(): int
    {
        $query = "SELECT COUNT(*) FROM $this->tableName WHERE status = 'verified' AND date_deleted IS NULL";
        $statement = $this->getConnection()->query($query);

        if ($statement) {
            return (int)$statement->fetchColumn();
        } else {
            return 0;
        }
    }

    public function countArchivedWikis(): int
    {
        $query = "SELECT COUNT(*) FROM $this->tableName WHERE status = 'archived' OR date_deleted IS NOT NULL";
        $statement = $this->getConnection()->query($query);

        if ($statement) {
            return (int)$statement->fetchColumn();
        } else {
            return 0;
        }
    }

    public function countAllWikis(): int
    {
        $query = "SELECT COUNT(*) FROM $this->tableName";
        $statement = $this->getConnection()->query($query);

        if ($statement) {
            return (int)$statement->fetchColumn();
        } else {
            return 0;
        }
    }


    // public function delete( $wiki): void
    // {
    //     try {
    //         $query = "DELETE FROM $this->tableName WHERE id = :id";
    //         $statement = $this->getConnection()->prepare($query);

    //         $statement->bindParam(':id', $wiki->getId(), PDO::PARAM_INT);

    //         $result = $statement->execute();

    //         if (!$result) {
    //             throw new \RuntimeException("Failed to delete the entity from the database.");
    //         }
    //     } catch (\Exception $exception) {
    //         throw $exception;
    //     }
    // }

    // public function countWikis(): int
    // {
    //     $query = "SELECT COUNT(*) FROM $this->tableName";
    // }
}