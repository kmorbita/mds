<?php 


if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = '';
}

switch($page){
    case 'joborderlist':
    include('joborderlist.php');
    break;
    case 'createform':
    include('insert.php');
    break;
    case 'editform':
    include('edit.php');
    break;
    case 'changepass':
    include('changepass.php');
    break;
    case 'edit_equipment':
    include('edit-equipment.php');
    break;
    default:
    include('equipment.php');
    break;
}
?>
