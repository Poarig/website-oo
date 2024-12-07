<?php
function make_table($data){
    $table = "<table>";
    if (isset($data["caption"])){
        $table = $table."<caption>".$data["caption"]."</caption>";
    }

    if (isset($data["th"])){
        $table = $table."<tr>";
        for ($i = 0; $i < count($data["th"]); $i++) {
            $table = $table."<th".$data["th"][$i]."</th>";
        }
        $table = $table."</tr>";
    }
    
    for ($i = 0; $i < count($data["td"]); $i++) {
        $table = $table."<tr>";
        for ($j = 0; $j < count($data["td"][$i]); $j++){
            $table = $table."<td>".$data["td"][$i][$j]."</td>";
        }
        $table = $table."</tr>";
    }

    $table = $table."</table>";
    echo $table;
}
?>