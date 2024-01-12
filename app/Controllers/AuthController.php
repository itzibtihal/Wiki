<?php

namespace App\controllers;

use App\Entities\User;
use App\Models\UserModel;

class AuthController
{
    public function redirectToSignup()
    {
        $userData = $this->getUserData();

        include '../../views/auth/Auth.php';
    }
    public function getAuthPage()
    {
        include '../../views/auth/Auth.php';
    }

    public function redirectToSignin()
    {
        $userData = $this->getUserData();

        include '../../views/auth/Auth.php';
    }

    public function signup()
    {
        try {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
            $role_id = 2;
    
            if (empty($name)) {
                throw new \Exception('Name cannot be empty');
            }
    
            $userModel = new UserModel();
            $exist = $userModel->getUserByEmail($email);
    
            if ($exist) {
                throw new \Exception('Username or email has already been taken');
            } else {
                $user = new User(null, $name, $email, null, $password, null, null, null, null, $role_id);
                $userModel->save($user);
                $this->redirect('Auth');
            }
        } catch (\Exception $e) {
            $this->redirectWithError('register', $e->getMessage());
        }
    }
    

    public function signin()
    {
        try {
            
            $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $userModel = new UserModel();
            $userData = $userModel->getUserByEmail($email);

            if ($userData && password_verify($password, $userData->getPassword())) {
                $this->handleSignInRole($userData->getRoleId(), $userData->getId());
            } else {
                throw new \Exception('Incorrect Email or Password');
            }
        } catch (\Exception $e) {
            $this->redirectWithError('login', $e->getMessage());
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirectWithMessage('Auth', 'You have been successfully logged out.');
    }

    // Helper function to get user data if logged in
    private function getUserData()
    {
        if (isset($_SESSION["userId"])) {
            $userSId = $_SESSION["userId"];
            $userModel = new UserModel();
            return $userModel->getUserById($userSId);
        } else {
            return null;
        }
    }

    
    private function redirectWithError($location, $error)
    {
        $this->redirect("$location?error=" . urlencode($error));
    }

    
    private function redirectWithMessage($location, $message)
    {
        $this->redirect("$location?message=" . urlencode($message));
    }

    
    private function redirect($location)
    {
        header("location: $location");
        exit();
    }

   
    private function handleSignInRole($roleId, $userId)
    {
        switch ($roleId) {
            case 1:
                $_SESSION['isAdmin'] = true;
                $_SESSION['userId'] = $userId;
                $this->redirect('Dashboard');
                break;
            case 2:
                $_SESSION['isAuthor'] = true;
                $_SESSION['userId'] = $userId;
                $this->redirect('MyDash');
                break;
            default:
                throw new \Exception('Invalid user role');
        }
    }
}

?>
