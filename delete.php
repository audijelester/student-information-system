<?php
include 'config.php';

$id = intval($_GET['id']);

$sql = "DELETE FROM students WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: index.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
