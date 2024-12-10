<?php
include("../components/head.php");
include("../components/header.php");
include("../components/connection.php");
?>

<div class="main-content">

<?php
$sql='SELECT * FROM Pages WHERE `page_name` = "' . $_GET["page"] . '"';
if ($result = mysqli_query($conn, $sql)) {
    foreach($result as $row) {
        echo "<h2>" . $row["page_name"] . "</h2>";
        echo "<p>" . $row["page_text"] . "</p>";
    }
    
    mysqli_free_result($result);
} else {
    echo "Ошибка: " . mysqli_error($conn);
}
mysqli_close($conn);
?>

</div>

<?php
include("../components/footer.php");
?>