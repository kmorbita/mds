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
    case 'changepass':
    include('changepass.php');
    break;
    case 'activity':
    include('activity.php');
    break;
    case 'messages':
    include('messages.php');
    break;
    case 'personnel_activity':
    include('personnel_activity.php');
    break;
    case 'view_activity':
    include('view_activity.php');
    break;
    case 'employee_assigned':
    include('employee_assigned.php');
    break;
    case 'fillin':
    include('fillin.php');
    break;
    case 'task':
    include('task.php');
    break;
    case 'edittask':
    include('edit_task.php');
    break;
    case 'working_jobs':
    include('working_jobs.php');
    break;
    case 'employee_list':
    include('employee_list.php');
    break;
    case 'editemp':
    include('editemp.php');
    break;
    case 'fillin_operator':
    include('fillin_operator.php');
    break;
    case 'fillin_manpower':
    include('fillin_manpower.php');
    break;
    default:
    include('joborderlist.php');
    break;
}
?>
