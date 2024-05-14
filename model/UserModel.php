<?php
require_once ('../db.php');

class UserModel
{
    public function readUsers()
    {
        global $conn;
        $sql = "SELECT user.Id, user.Name, usertype.Name AS usertype 
                FROM user 
                INNER JOIN usertype ON user.UsertypeId = usertype.Id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function createUser($name, $usertypeId)
    {
        global $conn;
        $sql = "INSERT INTO user (Name, UsertypeId) VALUES ('$name', '$usertypeId')";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($id, $name, $usertypeId)
    {
        global $conn;
        $sql = "UPDATE user SET Name='$name', UsertypeId='$usertypeId' WHERE Id='$id'";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($id)
    {
        global $conn;
        $sql = "DELETE FROM user WHERE Id='$id'";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserTypes()
    {
        global $conn;
        $sql = "SELECT * FROM usertype";
        $result = $conn->query($sql);
        $userTypes = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userTypes[] = $row;
            }
        }

        return $userTypes;
    }
}
?>