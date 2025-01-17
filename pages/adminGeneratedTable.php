<?php
session_start();
if (!isset($_SESSION["auth"])){
    header("Location: authorization.php");
};
include("../components/head.php");
include("../components/adminPanel/adminHeader.php");
include("../components/adminPanel/adminNav.php");
include("../components/connection.php");
include("../components/adminPanel/adminTable.php");
include("../components/adminPanel/constants.php");

function MatchTableAndID($conn, $matches, $table_name) {
    $columns_names_sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table_name'";
    if ($columns_names_result = mysqli_query($conn, $columns_names_sql)){
        $columns_names = [];
        $other_table_colums = [];

        foreach($columns_names_result as $row) {
            $column_name = $row['COLUMN_NAME'];
            $column_name_len = strlen($column_name);

            if ((count($columns_names) == 0) or ($column_name_len <= 3)){
                array_push($columns_names, $column_name);
            }else if (substr($column_name, $column_name_len -3, 3) != "_id") {
                array_push($columns_names, $column_name);
            }else{
                array_push($other_table_colums, [$table_name, $column_name, $matches[$column_name][0], $matches[$column_name][1]]);
                $other_table_cloumns_names = [];
                foreach ($matches[$column_name][2] as $name){
                    if (strlen($name) > 3){
                        if (substr($column_name, $column_name_len -3, 3) == "_id") {
                            $other_table_cloumns_names = $other_table_cloumns_names + $matches[$name][2];
                            array_push($other_table_colums, [$matches[$column_name][0], $name, $matches[$name][0], $matches[$name][1]]);
                        }
                    }
                    array_push($other_table_cloumns_names, $column_name."-".explode("-", $name)[0]);
                }
                $columns_names = $columns_names + $other_table_cloumns_names;
            }
            

        }

        return [$columns_names, $other_table_colums];
    }
}
?>
<div class="main admin-panel">
    <div class="main-content m-w-n">
        <?php

        $columns = MatchTableAndID($conn, $MATCHES_TABLE_AND_ID, $_GET['table']);
        $columns_names = implode(", ", $columns[0]);
        $sql="SELECT {$columns_names} FROM {$_GET['table']}";
        foreach ($columns[1] as $other_table_column) {
            $sql = "$sql INNER JOIN {$other_table_column[0]} ON {$other_table_column[0]}.{$other_table_column[2]} = {$other_table_column[1]}.{$other_table_column[3]}";
        }
        if ($result = mysqli_query($conn, $sql)) {
            $td = [];
            foreach($result as $row) {
                array_push($td, $row);
                }

            mysqli_free_result($result);

            $data = array(
                'caption' => $_GET['table'],
                'th' => $columns[0],
                'td' => $td,
            );

            
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