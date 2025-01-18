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
    $columns_names_sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table_name' AND table_schema ='website_OO_BD'";
    if ($columns_names_result = mysqli_query($conn, $columns_names_sql)){
        $columns_names = [];
        $columns_names_for_table = [];
        $other_table_colums = [];

        #   перебираем имена столбцов
        foreach($columns_names_result as $row) {
            $column_name = $row['COLUMN_NAME'];
            $column_name_len = strlen($column_name);

            #   проверяем является ли столбец ссылкой на другую таблицу
            if ($column_name_len <= 3){
                array_push($columns_names, $column_name);
                array_push($columns_names_for_table, $column_name);
            }else if (substr($column_name, $column_name_len -3, 3) != "_id") {
                array_push($columns_names, $column_name);
                array_push($columns_names_for_table, $column_name);
            }else if (substr($column_name, 0, $column_name_len -3) != strtolower(substr($table_name, 0, strlen($table_name) -1))){
                
                array_push($other_table_colums, [$table_name, $column_name, $matches[$column_name][0], $matches[$column_name][1]]);

                # перебираем нужные имена столбцов из сылаемой таблици
                $other_table_cloumns_names = [];
                $other_table_cloumns_names_for_table = [];
                foreach ($matches[$column_name][2] as $name){
                    
                    if (strlen($name) <= 3){
                        array_push($other_table_cloumns_names, $name);
                        array_push($other_table_cloumns_names_for_table, generate_column_name_for_table($column_name, $name));
                    } else if (substr($name, strlen($name) -3, 3) == "_id") {
                        array_merge($other_table_cloumns_names, $matches[$name][2]);
                        array_push($other_table_colums, [$matches[$column_name][0], $matches[$column_name][1], $matches[$name][0], $matches[$name][1]]);
                        foreach($matches[$name][2] as $name){
                            array_push($other_table_cloumns_names_for_table, generate_column_name_for_table($column_name, $name));
                        }
                        
                    } else {
                        array_push($other_table_cloumns_names, $name);
                        array_push($other_table_cloumns_names_for_table, generate_column_name_for_table($column_name, $name));
                    }
                }
                print(implode(" ", $other_table_cloumns_names));
                $columns_names = array_merge($columns_names, $other_table_cloumns_names);
                $columns_names_for_table = array_merge($columns_names_for_table, $other_table_cloumns_names_for_table);    
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
        return [$columns_names, $new_other_table_colums, $columns_names_for_table];
    }
}


function generate_column_name_for_table($column_name, $name){
    $first_part_array = explode("_", $column_name);
    $first_part = implode("_", array_slice($first_part_array, 0, count($first_part_array) - 1));
    $second_part_array = explode("_", $name);
    $second_part = implode("_", array_slice($second_part_array, 1, count($second_part_array)));

    return implode("_", [$first_part, $second_part]);
}
?>
<div class="main admin-panel">
    <div class="main-content m-w-n">
        <?php

        $columns = MatchTableAndID($conn, $MATCHES_TABLE_AND_ID, $_GET['table']);
        $columns_names = implode(", ", $columns[0]);
        $sql="SELECT {$columns_names} FROM `{$_GET['table']}`";
        foreach ($columns[1] as $key => $other_table_column) {
            $condition = implode(" AND ", $other_table_column);
            $sql = "$sql INNER JOIN `{$key}` ON {$condition}";
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
                'th' => $columns[2],
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