<?php
include('db_connect.php');
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the user data from the database
    $query = $db->prepare("SELECT * FROM doner_reg WHERE id = :id");
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_OBJ);

    // Check if the user exists
    if ($user) {
        // If form is submitted, update the user information
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $blood_group = $_POST['blood_group'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $birth_date = $_POST['birth_date'];
            $gender = $_POST['gender'];
            $city = $_POST['city'];
            $address = $_POST['address'];

            // Update the database with the new information
            $updateQuery = $db->prepare("UPDATE doner_reg SET name = :name, blood_group = :blood_group, phone = :phone, email = :email, birth_date = :birth_date, gender = :gender, city = :city, address = :address WHERE id = :id");
            $updateQuery->bindParam(":name", $name);
            $updateQuery->bindParam(":blood_group", $blood_group);
            $updateQuery->bindParam(":phone", $phone);
            $updateQuery->bindParam(":email", $email);
            $updateQuery->bindParam(":birth_date", $birth_date);
            $updateQuery->bindParam(":gender", $gender);
            $updateQuery->bindParam(":city", $city);
            $updateQuery->bindParam(":address", $address);
            $updateQuery->bindParam(":id", $id, PDO::PARAM_INT);

            if ($updateQuery->execute()) {
                if ($_SESSION['un'] === 'admin'){
                header("Location: doner-list.php");
                }else{
                header("Location: user-profile.php");
                }
                exit();
            } else {
                echo "Error updating user information.";
            }
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "No user ID provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/s1.css">
    <title>Edit Information</title>
</head>
<body>
    <div id="full">
        <div id="inner_full">
            <div id="header"><h2><a href="index.php" style="text-decoration: none; color: whitesmoke">Red Cross Link</a>
            <div style="text-decoration: none; color: whitesmoke; float: right; font-size: 20px;">
                <?php if (isset($_SESSION['un'])): ?>
                    <a href="<?php echo ($_SESSION['un'] === 'admin') ? 'admin-home.php' : 'user-profile.php'; ?>">
                        Welcome, <?php echo htmlspecialchars($_SESSION['un']); ?>
                    </a>
                    <form action="logout.php" method="post" style="display:inline;">
                        <input type="submit" name="logout" value="Logout">
                    </form>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="doner-reg.php">Register</a>
                <?php endif; ?>
        </h2></div>
            <div id="body" style="width: auto; height: 625px;">
                <h1 align="center">Edit Information</h1>
                <center><form method="post"><div id="form">
                    <table>
                        <tr>
                            <td width="200px" height="50px">Full Name</td>
                            <td><input type="text" name="name" value="<?= $user->name ?>"><br></td>
                        </tr>
                        <tr>
                            <td width="200px" height="50px">Blood Group</td>
                            <td><input type="text" name="blood_group" value="<?= $user->blood_group ?>"><br></td>
                        </tr>
                        <tr>
                            <td width="200px" height="50px">Phone</td>
                            <td><input type="text" name="phone" value="<?= $user->phone ?>"><br></td>
                        </tr>
                        <tr>
                            <td width="200px" height="50px">Email</td>
                            <td><input type="email" name="email" value="<?= $user->email ?>"><br></td>
                        </tr>
                            <td width="200px" height="50px">Birth Date</td>
                            <td><input type="date" name="birth_date" value="<?= $user->birth_date ?>"><br></td>
                        </tr>
                            <td width="200px" height="50px">Gender</td>
                            <td><input type="text" name="gender" value="<?= $user->gender ?>"><br></td>
                        </tr>
                            <td width="200px" height="50px">City</td>
                            <td><input type="text" name="city" value="<?= $user->city ?>"><br></td>
                        </tr>
                            <td width="200px" height="50px">Address</td>
                            <td><textarea name="address"><?= $user->address ?></textarea><br></td>
                        </tr>
                    </table>
                <input type="submit" value="Update">
                </div></center></form>
            </div>
            <div id="footer"><h4 align="center">Copyright@(Sirajul, Sadia, Lobna, Tithy)</h4>
        </div>
        </div>
    </div>
</body>
</html>