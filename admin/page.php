<?php
//manage pages 
$do='';
if(isset($_GET['do'])){
    $do=$_GET['do'];
}else{
    $do='Manage';
}


if($do=='Manage'){
    echo 'welcome to manage page ';
}elseif($do=='Add'){
    echo 'welcom to add page';
}elseif($do == 'Insert') {
    echo ' welcom to Insert categr page';
}else{
    echo 'there is no such page ';
}
?>