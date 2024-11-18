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
            background-repeat: no-repeat;
        }
        td {
            width: 200px;
            height: auto;
        }
    </style>
    <title>Profile</title>
</head>
<body>
    <div id="full">
        <div id="inner_full">
            <div id="header">
                <h2><a href="index.php" style="text-decoration: none; color: whitesmoke">Red Cross Link</a>
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
                </h2>
            </div>

            <div id="body" style="width: auto; height: 625px;">
                <h1 align="center">Profile</h1>
                <center>
                    <div id="form">
                        <table>
                            <tr>
                                <td><center><b>Name</b></center></td>
                                <td><center><b>Blood</b></center></td>
                                <td><center><b>Phone</b></center></td>
                                <td><center><b>Email</b></center></td>
                                <td><center><b>Birth Date</b></center></td>
                                <td><center><b>Gender</b></center></td>
                                <td><center><b>City</b></center></td>
                                <td><center><b>Address</b></center></td>
                                <td><center><b>Action</b></center></td>
                            </tr>
                            <?php
                            if (isset($_SESSION['un'])) {
                                $email = $_SESSION['un'];
                                $stmt = $db->prepare("SELECT * FROM doner_reg WHERE email = :email");
                                $stmt->bindParam(':email', $email);
                                $stmt->execute();
                                if ($r1 = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                    <tr>
                                        <td><center><?= htmlspecialchars($r1->name); ?></center></td>
                                        <td><center><?= htmlspecialchars($r1->blood_group); ?></center></td>
                                        <td><center><?= htmlspecialchars($r1->phone); ?></center></td>
                                        <td><center><?= htmlspecialchars($r1->email); ?></center></td>
                                        <td><center><?= htmlspecialchars($r1->birth_date); ?></center></td>
                                        <td><center><?= htmlspecialchars($r1->gender); ?></center></td>
                                        <td><center><?= htmlspecialchars($r1->city); ?></center></td>
                                        <td><center><?= htmlspecialchars($r1->address); ?></center></td>
                                        <td><center><a href="edit.php?id=<?= $r1->id; ?>">Edit</a></center></td>
                                    </tr>
                                    <?php
                                } else {
                                    echo "<tr><td colspan='9' align='center'>No data found for this email.</td></tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </center>
            </div>
            <div id="footer"><h4 align="center">Copyright@(Sirajul, Sadia, Lobna, Tithy)</h4></div>
        </div>
    </div>
</body>
</html>
