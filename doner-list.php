<?php
include('db_connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/s1.css">
    <style type="text/css">
        body {
            background-image: url('image/bg/adh.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: auto;
        }
        td{
            width: 200px;
            height: auto;
        }
    </style>
    <title>Doner List</title>
</head>
<body>
    <div id="full">
        <div>
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
            </div>
        </h2></div>
            <div id="body" style="width: auto; height: 625px;">
                <h1 align="center">Doner List</h1>
                <center><div id="form">
                    <table>
                        <tr>
                            <td><center><b>Name</b></center></td>
                            <td><center><b>Bloog</b></center></td>
                            <td><center><b>Phone</b></center></td>
                            <td><center><b>Email</b></center></td>
                            <td><center><b>Birth Date</b></center></td>
                            <td><center><b>Gender</b></center></td>
                            <td><center><b>City</b></center></td>
                            <td><center><b>Address</b></center></td>
                            <td><center><b>Action</b></center></td>
                        </tr>
                        <?php
                        $q=$db->query("SELECT * FROM doner_reg");
                        while($r1=$q->fetch(PDO::FETCH_OBJ))
                        {
                            ?>
                                <tr>
                                    <td><center><?= $r1->name; ?></center></td>
                                    <td><center><?= $r1->blood_group; ?></center></td>
                                    <td><center><?= $r1->phone; ?></center></td>
                                    <td><center><?= $r1->email; ?></center></td>
                                    <td><center><?= $r1->birth_date; ?></center></td>
                                    <td><center><?= $r1->gender; ?></center></td>
                                    <td><center><?= $r1->city; ?></center></td>
                                    <td><center><?= $r1->address; ?></center></td>
                                    <td><center><a href="edit.php?id=<?= $r1->id; ?>">Edit</a></center></td>
                                    <td><a href="delete.php?id=<?= $r1->id; ?>" onclick="return confirm('Are you sure you want to delete this donor?');">Delete</a></td>
                                </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div></center>
            </div>
        </div>
    </div>
</body>
</html>