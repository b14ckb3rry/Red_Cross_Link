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
    <style>
      body {
         background-image: url('image/bg/redcell.jpg');
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
      }
    </style>
    <title>Welcome Home</title>
</head>
<body>
    <div id="fulll">
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
            </div></h2>
            </div>
            <div id="body">
                <form action="" method="post">
                    <table align="center">
                        <tr>
                            <td width="200px" height="50px"><b>Enter Blood Group</b></td>
                            <td width="200px" height="50px">
                                <select name="blood_group" style="width: 170px; height: 30px; border-radius: 10px;">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="200px" height="50px"><b>Enter Location</b></td>
                            <td width="200px" height="50px">
                                <input type="text" name="city" placeholder="Enter Location" style="width: 170px; height: 30px; border-radius: 10px;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" name="search" value="Search" style="width: 80px; height: 30px; border-radius: 5px;"></td>
                        </tr>
                    </table>
                </form>

                <?php
                if (isset($_POST['search'])) {
                    $blood_group = $_POST['blood_group'];
                    $city = $_POST['city'];
                    $query = "SELECT * FROM doner_reg WHERE 1=1";
                    if (!empty($blood_group)) {
                        $query .= " AND blood_group = :blood_group";
                    }
                    if (!empty($city)) {
                        $query .= " AND city LIKE :city";
                    }
                    $stmt = $db->prepare($query);
                    if (!empty($blood_group)) {
                        $stmt->bindParam(':blood_group', $blood_group);
                    }
                    if (!empty($city)) {
                        $city = "%$city%";
                        $stmt->bindParam(':city', $city);
                    }
                    $chk= true;
                    if (empty($city) && empty($blood_group))
                    {
                        $chk=false;
                    }
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if($chk){
                        if ($results) {
                            echo "<table border='1' align='center' cellpadding='10'>";
                            echo "<tr><th>Name</th><th>Blood Group</th><th>Location</th><th>Phone Number</th><th>Email</th></tr>";
                            foreach ($results as $row) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['blood_group']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['city']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    }
                    else{
                        echo "<p align='center'>No donors found matching your criteria.</p>";
                    }
                }
                ?>
            </div>
            <div id="footer"><h4 align="center">Copyright@(Sirajul, Sadia, Lobna, Tithy)</h4>
        </div>
    </div>
</body>
</html>
