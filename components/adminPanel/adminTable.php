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
        $table = $table."<th class='blue-button t-btn' colspan='2'><div><a href='adminGeneratedForm.php?table={$data['caption']}'>Добавить</a></div></th>";
    }
    
    for ($i = 0; $i < count($data["td"]); $i++) {
        $table = $table."<tr class='black-a'>";
        foreach($data['td'][$i] as $td){
            $table = $table."<td><div>".$td."</div></td>";
        }
        $id = array_shift($data['td'][$i]);
        $table = $table."<td class='t-btn'><a href='#?table={$data['caption']}&id={$id}'>Изменить</a></td>";
        $table = $table."<td class='t-btn'><a href='#?table={$data['caption']}&id={$id}'>Удалить</a></td>";
        $table = $table."</tr>";
    }

    $table = $table."</tbody></table>";
    echo $table;
}
?>