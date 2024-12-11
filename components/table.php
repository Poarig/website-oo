<?php
function make_table($data){
    $table = "<table class='mx-auto'>";
    if (isset($data["caption"])){
        $table = $table."<caption>".$data["caption"]."</caption><tbody>";
    }

    if (isset($data["th"])){
        $table = $table."<tr>";
        for ($i = 0; $i < count($data["th"]); $i++) {
            $table = $table."<th>".$data["th"][$i]."</th>";
        }
        $table = $table."</tr>";
    }
    
    for ($i = 0; $i < count($data["td"]); $i++) {
        $table = $table."<tr>";
        for ($j = 0; $j < count($data["td"][$i]); $j++){
            $table = $table."<td><div>".$data["td"][$i][$j]."</div></td>";
        }
        $table = $table."</tr>";
    }

    $table = $table."</tbody></table>";
    echo $table;
}
?>