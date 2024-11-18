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
    <title>Registration</title>
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
                <h1 align="center">Registration Form</h1>
                <center><div id="form">
                    <form action="" method="POST">
                        <table>
                            <tr>
                                <td width="200px" height="50px">Full Name</td>
                                <td width="200px" height="50px"><input type="text" name="name" placeholder="Enter Name" required></td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px">Email</td>
                                <td width="200px" height="50px"><input type="email" name="email" placeholder="Enter Email" required></td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px">Phone</td>
                                <td width="200px" height="50px"><input type="number" name="phone" placeholder="Enter Phone Number" required></td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px">Password</td>
                                <td width="200px" height="50px"><input type="password" name="pass" placeholder="Enter Password" required></td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px">Date of birth</td>
                                <td width="200px" height="50px"><input type="date" name="birth_date" required></td>
                            </tr>
                            <tr>
                            <td width="200px" height="50px">Blood Group</td>
                                <td width="200px" height="50px">
                                    <select name="blood_group">
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width="200px" height="50px">Gender</td>
                                <td width="200px" height="50px">
                                    <select name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <td width="200px" height="50px">Home Address</td>
                                <td width="200px" height="50px"><input type="text" name="address" placeholder="Enter Address" required></td>
                            </tr>
                            <td width="200px" height="50px">Current City</td>
                                <td width="200px" height="50px"><input type="text" name="city" placeholder="Enter City" required></td>
                            </tr>
                            <td width="200px" height="50px">Country</td>
                                <td width="200px" height="50px">
                                    <select name="country">
                                        <option hidden>Country</option>
                                        <option>Andorra</option>
                                        <option>Angola</option>
                                        <option>Antigua and Barbuda</option>
                                        <option>Argentina</option>
                                        <option>Armenia</option>
                                        <option>Australia</option>
                                        <option>Austria</option>
                                        <option>Azerbaijan</option>
                                        <option>Bahamas</option>
                                        <option>Bahrain</option>
                                        <option>Bangladesh</option>
                                        <option>Barbados</option>
                                        <option>Belarus</option>
                                        <option>Belgium</option>
                                        <option>Belize</option>
                                        <option>Benin</option>
                                        <option>Bhutan</option>
                                        <option>Bolivia</option>
                                        <option>Canada</option>
                                        <option>Central African Republic</option>
                                        <option>Chad</option>
                                        <option>Chile</option>
                                        <option>China</option>
                                        <option>Colombia</option>
                                        <option>Comoros</option>
                                        <option>Congo (Congo-Brazzaville)</option>
                                        <option>United States of America</option>
                                        <option>Uruguay</option>
                                        <option>Uzbekistan</option>
                                        <option>Vanuatu</option>
                                        <option>Vatican City</option>
                                        <option>Venezuela</option>
                                        <option>Vietnam</option>
                                        <option>Yemen</option>
                                        <option>Zambia</option>
                                        <option>Zimbabwe</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="sub" value="Save"></td>
                            </tr>
                        </table>
                    </form>
                    <?php
                    if (isset($_POST['sub'])) {
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $pass = $_POST['pass'];
                        $birth_date = $_POST['birth_date'];
                        $blood_group = $_POST['blood_group'];
                        $gender = $_POST['gender'];
                        $address = $_POST['address'];
                        $city = $_POST['city'];
                        $country = $_POST['country'];
                        
                        $q = $db->prepare("INSERT INTO doner_reg (name, email, phone, pass, birth_date, blood_group, gender, address, city, country)
                                VALUES (:name, :email, :phone, :pass, :birth_date, :blood_group, :gender, :address, :city, :country)");
                        
                        $q->bindParam(':name', $name);
                        $q->bindParam(':email', $email);
                        $q->bindParam(':phone', $phone);
                        $q->bindParam(':pass', $pass);
                        $q->bindParam(':birth_date', $birth_date);
                        $q->bindParam(':blood_group', $blood_group);
                        $q->bindParam(':gender', $gender);
                        $q->bindParam(':address', $address);
                        $q->bindParam(':city', $city);
                        $q->bindParam(':country', $country);
                        $q->execute();
                        $res = $q->fetchAll(PDO::FETCH_OBJ);
                        if (!$res) {
                            echo "<script>alert('Registration Successful!')</script>";
                        } 
                        else
                        {
                            echo "<script>alert('Registration Unsuccessful!')</script>";
                        }
                    }
                    ?>
                </div></center>
            </div>
            <div id="footer"><h4 align="center">Copyright@(Sirajul, Sadia, Lobna, Tithy)</h4>
        </div>
        </div>
    </div>
</body>
</html>