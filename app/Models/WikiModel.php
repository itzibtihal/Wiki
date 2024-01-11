<?php

namespace App\Models;

use App\Dao\DaoImpl\DaoImplementation;
use App\Entities\Wiki;
use PDO;
use PDOException;

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
                    $result['id'],
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
        $query = "SELECT * FROM $this->tableName WHERE status = 'verified' /* AND date_deleted IS NULL */";
        $statement = $this->getConnection()->query($query);

        if ($statement) {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $wikis = [];

            foreach ($results as $result) {
                $wiki = new Wiki(
                    $result['id'],
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
                    $result['id'],
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


    public function save($wiki): void
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

    public function update($wiki): void
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

    public function getLastWikiByCategoryId($category_id)
    {
        $query = "SELECT * FROM wikis WHERE  status = 'verified' AND category_id = :category_id ORDER BY creation_date DESC LIMIT 1";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindParam(':category_id', $category_id, PDO::PARAM_INT);

        try {
            $statement->execute();
            $wikiData = $statement->fetch(PDO::FETCH_ASSOC);

            if ($wikiData) {
                return new Wiki(
                    $wikiData['id'],
                    $wikiData['picture'],
                    $wikiData['title'],
                    $wikiData['content'],
                    $wikiData['read_min'],
                    $wikiData['creation_date'],
                    $wikiData['date_deleted'],
                    $wikiData['status'],
                    $wikiData['user_id'],
                    $wikiData['category_id']
                );
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return null;
    }


    public function getLastInsertedWikiTitle()
{
    try {
        $query = "SELECT title FROM wikis WHERE status = 'verified' ORDER BY creation_date DESC LIMIT 1";
        $statement = $this->getConnection()->query($query);
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['title'] ?? null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}


public function getLastFiveVerifiedWikis()
{
    try {
        $query = "SELECT * FROM wikis WHERE status = 'verified' ORDER BY creation_date DESC LIMIT 5";
        $statement = $this->getConnection()->query($query);

        if ($statement) {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $wikis = [];

            foreach ($results as $result) {
                $wiki = new Wiki(
                    $result['id'],
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

                $wikis[] = $wiki;
            }

            return $wikis;
        } else {
            return [];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}



    public function saveWikiWithTags($wiki): void
    {
        try {
            $this->getConnection()->beginTransaction();

            $this->save($wiki);


            $wikiId = $this->getConnection()->lastInsertId();

            foreach ($wiki->getTags() as $tagId) {
                $this->saveWikiTag($wikiId, $tagId);
            }

            $this->getConnection()->commit();
        } catch (\Exception $exception) {
            $this->getConnection()->rollBack();
            throw $exception;
        }
    }

    private function saveWikiTag($wikiId, $tagId): void
    {
        try {
            $query = "INSERT INTO wikis_tags (id_wiki, id_tag) VALUES (:wikiId, :tagId)";
            $statement = $this->getConnection()->prepare($query);
            $statement->bindParam(':wikiId', $wikiId, PDO::PARAM_INT);
            $statement->bindParam(':tagId', $tagId, PDO::PARAM_INT);

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to save Wiki-Tag relationship in the database.");
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

            $statement->bindParam(':id', $wiki->getId());

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to archive the entity in the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function archiveWiki($wiki): void
    {
        $this->delete($wiki);
    }

    public function verify($wiki): void
    {
        try {
            $query = "UPDATE $this->tableName 
                  SET 
                  status = 'verified',
                  date_deleted = NULL
                  WHERE id = :id";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindParam(':id', $wiki->getId(), PDO::PARAM_INT);

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to update the entity in the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function verifyWiki($wiki): void
    {
        $this->verify($wiki);
    }


    public function getAllWikisByUserId($userId): array
    {
        $query = "SELECT * FROM $this->tableName WHERE user_id = :userId AND status = 'verified' ";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);

        if ($statement->execute()) {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $wikis = [];

            foreach ($results as $result) {
                $wiki = new Wiki(
                    $result['id'],
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




    public function countVerifiedWikis(): int
    {
        $query = "SELECT COUNT(*) FROM $this->tableName WHERE status = 'verified' /* OR date_deleted IS NULL */";
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

    public function countWikisCreatedToday()
    {

        $currentDate = date('Y-m-d');

        $query = "SELECT COUNT(*) FROM $this->tableName WHERE DATE(creation_date) = :currentDate";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindParam(':currentDate', $currentDate);

        if ($statement->execute()) {
            return (int)$statement->fetchColumn();
        } else {
            return 0;
        }
    }

    public function listLast6Wikis(): array
    {
        $query = "SELECT id, title, creation_date, category_id, status
              FROM wikis
              ORDER BY creation_date DESC
              LIMIT 6";

        $statement = $this->getConnection()->query($query);

        if ($statement) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }



    public function getCategoryNameById($categoryId)
    {
        $query = "SELECT name FROM categories WHERE id = :categoryId";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['name'];
        } else {
            return null;
        }
    }

    public function getTagsForWiki($wikiId)
    {
        $query = "SELECT t.id, t.label
                  FROM tags t
                  INNER JOIN wikis_tags wt ON t.id = wt.id_tag
                  WHERE wt.id_wiki = :wikiId";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindParam(":wikiId", $wikiId, PDO::PARAM_INT);
        $statement->execute();

        $tags = [];

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $tags[] = [
                'id' => $row['id'],
                'label' => $row['label'],
            ];
        }

        return $tags;
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
