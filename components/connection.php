<?php
$conn = mysqli_connect("MySQL-8.0", "root", "", "website_OO_BD");
if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
}
?>