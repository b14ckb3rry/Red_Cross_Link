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
    <title>User Login</title>
    <style>
      body {
         background-image: url('image/bg/loginbg.jpg');
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
      }
    </style>
</head>
<body>
    <div id="full">
        <div id="inner_full">
        <div id="header"><h2><a href="index.php" style="text-decoration: none; color: whitesmoke">Red Cross Link</a></h2></div>
            <div id="body" style="width: auto; height: 400px;">
                <br><br><br><br><br>
                <form action="" method="POST">
                    <table align="center">
                        <tr>
                            <td width="200px" height="70px"><b>Enter Email</b></td>
                            <td width="200px" height="70px"><input type="email" name="un" placeholder="Enter Email"
                            style="width: 170px; height: 30px; border-radius: 10px;"></td>
                        </tr>
                        <tr>
                            <td width="200px" height="70px"><b>Enter Password</b></td>
                            <td width="200px" height="70px"><input type="password" name="ps" placeholder="Enter Password"
                            style="width: 170px; height: 30px; border-radius: 10px;"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="sub" value="Login" style="width: 70px; height: 30px; border-radius: 5px;"></td>
                        </tr>
                    </table>
                </form>
                <?php
                if (isset($_POST['sub'])) {
                    $un = $_POST['un'];
                    $ps = $_POST['ps'];
                    $q = $db->prepare("SELECT * FROM doner_reg WHERE email = :un AND pass = :ps");
                    $q->bindParam(':un', $un);
                    $q->bindParam(':ps', $ps);
                    $q->execute();
                    $res = $q->fetchAll(PDO::FETCH_OBJ);
                    if($res)
                    {
                        $_SESSION['un']=$un;
                        header("location:index.php");
                    }
                    else{
                        echo "<script>alert('Wrong user')</script>";
                    }
                }
                ?>
            </div>
            <div id="footer"><h4 align="center">Copyright@(Sirajul, Sadia, Lobna, Tithy)</h4>
        </div>
    </div>
</body>
</html>
