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
    default:
    include('joborderlist.php');
    break;
}
?>
