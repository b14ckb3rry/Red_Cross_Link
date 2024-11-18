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
    <title>Admin Home</title>
    <style>
      body {
         background-image: url('image/bg/adh.jpg');
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
      }
    </style>
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
            <div id="body" style="width: auto; height: 400px;">
                <br>
                <?php
                $un=$_SESSION['un'];
                if(!$un)
                {
                    header("location:index.php");
                }
                ?>
                <br><br>
                <ul>
                    <li><a href="doner-reg.php">Doner Registrasion</a></li>
                    <li><a href="doner-list.php">Doner List</a></li>
                    <li><a href="stok-blood-list.php">Stock Blood</a></li>
                </ul>
                <br><br><br><br><br>
            </div>
            <div id="footer"><h4 align="center">Copyright@(Sirajul, Sadia, Lobna, Tithy)</h4>
        </div>
        </div>
    </div>
</body>
</html>