<?php
require_once ('../model/UserModel.php');

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function readUsers()
    {
        return $this->userModel->readUsers();
    }

    public function createUser($name, $usertypeId)
    {
        return $this->userModel->createUser($name, $usertypeId);
    }

    public function updateUser($id, $name, $usertypeId)
    {
        return $this->userModel->updateUser($id, $name, $usertypeId);
    }

    public function deleteUser($id)
    {
        return $this->userModel->deleteUser($id);
    }

    public function getUserTypes()
    {
        return $this->userModel->getUserTypes();
    }
}
?>