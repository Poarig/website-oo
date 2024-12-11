<?php
session_start();
if (!isset($_SESSION["auth"])){
    header("Location: authorization.php");
};
include("../components/head.php");
include("../components/adminPanel/adminHeader.php");
include("../components/adminPanel/adminNav.php");
?>
<div class="main admin-panel">
    <div class="main-content m-w-n">
        <?php
        include("../components/connection.php");
        $sql='SELECT * FROM `' . $_GET['table'] . "`";
        if ($result = mysqli_query($conn, $sql)) {
            $columns_names_sql = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "' . $_GET['table'] . '"';
            $columns_names_result = mysqli_query($conn, $columns_names_sql);
            $columns_names=[];
            foreach($columns_names_result as $row) {
                array_push($columns_names, $row['COLUMN_NAME']);
            }

            $td = [];
            foreach($result as $row) {
                array_push($td, $row);
            }
            mysqli_free_result($result);

            $data = array(
                'caption' => $_GET['table'],
                'th' => $columns_names,
                'td' => $td,
            );

            include("../components/adminPanel/adminTable.php");
            make_table($data);

        } else {
            echo "Ошибка: " . mysqli_error($conn);
        }
        mysqli_close($conn);
        ?>
    </div>
</div>

</body>
</html>