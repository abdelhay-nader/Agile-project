<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>

<body>
    <h1>User Management</h1>

    <!-- Create Form -->
    <h2>Create User</h2>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <label for="usertype">User Type:</label>
        <select name="usertype">
            <?php
            require_once ('../controller/UserController.php');
            $userController = new UserController();
            $userTypes = $userController->getUserTypes();
            if ($userTypes) {
                foreach ($userTypes as $type) {
                    echo "<option value='" . $type['Id'] . "'>" . $type['Name'] . "</option>";
                }
            }
            ?>
        </select>
        <button type="submit" name="create">Create</button>
    </form>

    <!-- Users Table -->
    <h2>Users</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>User Type</th>
            <th>Action</th>
        </tr>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['create'])) {
                $name = $_POST['name'];
                $usertypeId = $_POST['usertype'];
                $userController->createUser($name, $usertypeId);
            } elseif (isset($_POST['update'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $usertypeId = $_POST['usertype'];
                $userController->updateUser($id, $name, $usertypeId);
            } elseif (isset($_POST['delete'])) {
                $id = $_POST['delete'];
                $userController->deleteUser($id);
            }
        }

        $users = $userController->readUsers();
        if ($users) {
            while ($row = $users->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Id'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['usertype'] . "</td>";
                echo "<td>
                        <form method='post' action=''>
                            <input type='hidden' name='id' value='" . $row['Id'] . "'>
                            <input type='text' name='name' value='" . $row['Name'] . "'>
                            <select name='usertype'>";
                foreach ($userTypes as $type) {
                    $selected = ($type['Id'] == $row['UsertypeId']) ? 'selected' : '';
                    echo "<option value='" . $type['Id'] . "' $selected>" . $type['Name'] . "</option>";
                }
                echo "</select>
                        <button type='submit' name='update'>Update</button>
                        <button type='submit' name='delete' value='" . $row['Id'] . "'>Delete</button>
                      </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found.</td></tr>";
        }
        ?>
    </table>
</body>

</html>