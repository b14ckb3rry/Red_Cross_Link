<?php
include('db_connect.php');
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteQuery = $db->prepare("DELETE FROM doner_reg WHERE id = :id");
    $deleteQuery->bindParam(":id", $id, PDO::PARAM_INT);

    if ($deleteQuery->execute()) {
        header("Location: doner-list.php");
        exit();
    } else {
        echo "Error deleting donor.";
    }
} else {
    echo "No donor ID provided.";
}
?>