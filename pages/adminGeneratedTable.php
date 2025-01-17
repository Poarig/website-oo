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
    #   получаем имена столбцов таблици
    $columns_names_sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table_name'";
    if ($columns_names_result = mysqli_query($conn, $columns_names_sql)){
        $columns_names = [];
        $other_table_colums = [];

        #   перебираем имена столбцов
        foreach($columns_names_result as $row) {
            $column_name = $row['COLUMN_NAME'];
            $column_name_len = strlen($column_name);

            #   проверяем является ли столбец ссылкой на другую таблицу
            if ((count($columns_names) == 0) or ($column_name_len <= 3)){
                array_push($columns_names, $column_name);
            }else if (substr($column_name, $column_name_len -3, 3) != "_id") {
                array_push($columns_names, $column_name);
            }else if (substr($column_name, 0, $column_name_len -4) != strtolower($table_name)){
                array_push($other_table_colums, [$table_name, $column_name, $matches[$column_name][0], $matches[$column_name][1]]);

                # перебираем нужные имена столбцов из сылаемой таблици
                foreach ($matches[$column_name][2] as $name){
                    $other_table_cloumns_names = [];
                    if (strlen($name) > 3){

                        if (substr($name, strlen($name) -3, 3) == "_id") {
                            $other_table_cloumns_names = $other_table_cloumns_names + $matches[$name][2];
                            array_push($other_table_colums, [$matches[$column_name][0], $name, $matches[$name][0], $matches[$name][1]]);
                        }
                    }
                    array_push($other_table_cloumns_names, $column_name."-".explode("-", $name)[0]);
                }
                $columns_names = $columns_names + $other_table_cloumns_names;
            }
            

        }

        $new_other_table_colums=[];
        foreach($other_table_colums as $column){
            $condition = "{$column[0]}.{$column[1]} = {$column[2]}.{$column[3]}";
            if (!(array_key_exists($column[2], $new_other_table_colums))){
                $new_other_table_colums[$column[2]] = [$condition];
            } else {
                array_push($new_other_table_colums[$column[2]], $condition);
            }
        }
        return [$columns_names, $new_other_table_colums];
    }
}
?>
<div class="main admin-panel">
    <div class="main-content m-w-n">
        <?php

        $columns = MatchTableAndID($conn, $MATCHES_TABLE_AND_ID, $_GET['table']);
        $columns_names = implode(", ", $columns[0]);
        $sql="SELECT {$columns_names} FROM {$_GET['table']}";
        foreach ($columns[1] as $key => $other_table_column) {
            $condition = implode(" AND ", $other_table_column);
            $sql = "$sql INNER JOIN {$key} ON {$condition}";
        }
        print($sql);
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