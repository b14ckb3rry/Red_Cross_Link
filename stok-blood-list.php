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
        td{
            width: 200px;
            height: auto;
        }
    </style>
    <title>Stocks</title>
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
            </div>
        </h2></div>
            <div id="body" style="width: auto; height: 625px;">
                <h1 align="center">Blood Available</h1>
                <center><div><h2><a href="doner-list.php">Doner Information</a></h2></div></center>
                <center><div id="form">
                    <table>
                        <tr>
                            <td><center><b>Name</b></center></td>
                            <td><center><b>Qty</b></center></td>
                        </tr>
                        <?php
                            $blood_groups = ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'];
                            $total_blood = 0;
                            foreach ($blood_groups as $blood_group) {
                                $q = $db->query("SELECT * FROM doner_reg WHERE blood_group='$blood_group'");
                                $row_count = $q->rowcount();
                                $total_blood += $row_count;
                                echo "<tr>
                                        <td><center>$blood_group</center></td>
                                        <td><center>$row_count</center></td>
                                      </tr>";
                            }
                        ?>
                        <tr>
                            <td><center><b>Total Blood Available :</b></center></td>
                            <td><center><b><?php echo $total_blood; ?></b></center></td>
                        </tr>
                    </table>
                </div></center>
            </div>
            <div id="footer"><h4 align="center">Copyright@(Sirajul, Sadia, Lobna, Tithy)</h4>
        </div>
        </div>
    </div>
</body>
</html>
