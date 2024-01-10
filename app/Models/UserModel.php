<?php

namespace App\Models;

use App\Dao\DaoImpl\DaoImplementation;
use App\Entities\User;
use PDO;
use PDOException;

class UserModel extends DaoImplementation
{
    public function __construct()
    {
        parent::__construct("users");
    }

    public function getById($id)
    {
        $query = "SELECT * FROM $this->tableName WHERE id = :id";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return new User(
                    $result['id'],
                    $result['name'],
                    $result['email'],
                    $result['profile'],
                    $result['password'],
                    $result['linkedinProfile'],
                    $result['instagramProfile'],
                    $result['xProfile'],
                    $result['description'],
                    $result['role_id']
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
            $users = [];

            foreach ($results as $result) {
                $user = new User(
                    $result['id'],
                    $result['name'],
                    $result['email'],
                    $result['profile'],
                    $result['password'],
                    $result['linkedinProfile'],
                    $result['instagramProfile'],
                    $result['xProfile'],
                    $result['description'],
                    $result['role_id']
                );

                $users[] = $user;
            }

            return $users;
        } else {
            return [];
        }
    }

    public function save($user): void
    {
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        try {
            $query = "INSERT INTO $this->tableName (name, email, profile, password, linkedinProfile, instagramProfile, xProfile, description, role_id) 
                      VALUES (:name, :email, :profile, :password, :linkedinProfile, :instagramProfile, :xProfile, :description, :role_id)";
            $statement = $this->getConnection()->prepare($query);

            $statement->bindValue(':name', $user->getName());
            $statement->bindValue(':email', $user->getEmail());
            $statement->bindValue(':profile', $user->getProfile());
            $statement->bindValue(':password', $hashedPassword);
            $statement->bindValue(':linkedinProfile', $user->getLinkedinProfile());
            $statement->bindValue(':instagramProfile', $user->getInstagramProfile());
            $statement->bindValue(':xProfile', $user->getXProfile());
            $statement->bindValue(':description', $user->getDescription());
            $statement->bindValue(':role_id', $user->getRoleId());

            $result = $statement->execute();

            if (!$result) {
                throw new \RuntimeException("Failed to save the entity to the database.");
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM $this->tableName WHERE email = :email";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindValue(':email', $email);

        try {
            $statement->execute();
            $userData = $statement->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                return new User(
                    $userData['id'],
                    $userData['name'],
                    $userData['email'],
                    $userData['profile'],
                    $userData['password'],
                    $userData['linkedinProfile'],
                    $userData['instagramProfile'],
                    $userData['xProfile'],
                    $userData['description'],
                    $userData['role_id']
                );
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return null;
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM $this->tableName WHERE id = :id";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindValue(':id', $id);

        try {
            $statement->execute();
            $userData = $statement->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                return new User(
                    $userData['id'],
                    $userData['name'],
                    $userData['email'],
                    $userData['profile'],
                    $userData['password'],
                    $userData['linkedinProfile'],
                    $userData['instagramProfile'],
                    $userData['xProfile'],
                    $userData['description'],
                    $userData['role_id']
                );
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return null;
    }


    public function getUsersByRoleId($roleId)
    {
        $query = "SELECT * FROM $this->tableName WHERE role_id = :role_id";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindValue(':role_id', $roleId);

        try {
            $statement->execute();
            $usersData = $statement->fetchAll(PDO::FETCH_ASSOC);
            $users = [];

            foreach ($usersData as $userData) {
                $user = new User(
                    $userData['id'],
                    $userData['name'],
                    $userData['email'],
                    $userData['profile'],
                    $userData['password'],
                    $userData['linkedinProfile'],
                    $userData['instagramProfile'],
                    $userData['xProfile'],
                    $userData['description'],
                    $userData['role_id']
                );

                $users[] = $user;
            }

            return $users;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return [];
    }


    public function countUsersByRoleId($roleId)
    {
        $query = "SELECT COUNT(*) FROM $this->tableName WHERE role_id = :role_id";
        $statement = $this->getConnection()->prepare($query);
        $statement->bindValue(':role_id', $roleId);

        try {
            $statement->execute();
            return (int)$statement->fetchColumn();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return 0;
    }



}
