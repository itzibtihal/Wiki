<?php

namespace App\Entities;

class User
{

    private $id;
    private $name;
    private $email;
    private $profile;
    private $password;
    private $linkedinProfile;
    private $instagramProfile;
    private $xProfile;
    private $description;
    private $roleId;

    public function __construct($id,$name, $email, $profile, $password, $linkedinProfile, $instagramProfile, $xProfile, $description, $roleId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->profile = $profile;
        $this->password = $password;
        $this->linkedinProfile = $linkedinProfile;
        $this->instagramProfile = $instagramProfile;
        $this->xProfile = $xProfile;
        $this->description = $description;
        $this->roleId = $roleId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getLinkedinProfile()
    {
        return $this->linkedinProfile;
    }

    public function setLinkedinProfile($linkedinProfile)
    {
        $this->linkedinProfile = $linkedinProfile;
    }

    public function getInstagramProfile()
    {
        return $this->instagramProfile;
    }

    public function setInstagramProfile($instagramProfile)
    {
        $this->instagramProfile = $instagramProfile;
    }

    public function getXProfile()
    {
        return $this->xProfile;
    }

    public function setXProfile($xProfile)
    {
        $this->xProfile = $xProfile;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    }
}


?>
