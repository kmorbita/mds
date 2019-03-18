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
    case 'manpower':
    include('manpower.php');
    break;
    case 'users':
    include('users.php');
    break;
    case 'edituser':
    include('edit_user.php');
    break;
    case 'timekeeper':
    include('attendance.php');
    break; 
    case 'equipment':
    include('equipment.php');
    break;
    case 'personnel_activity':
    include('personnel_activity.php');
    break; 
    case 'task':
    include('task.php');
    break; 
    case 'activity':
    include('activity.php');
    break;  
    case 'fillin':
    include('fillin.php');
    break;  
    case 'createform':
    include('insert.php');
    break; 
    case 'editform':
    include('edit.php');
    break;
    case 'employee_list':
    include('employee_list.php');
    break;
    case 'editemp':
    include('editemp.php');
    break;
    case 'user_log':
    include('user_logs.php');
    break;
    case 'personnel_work_time':
    include('personnel_work_time.php');
    break;
    case 'operator_work_time':
    include('operator_work_time.php');
    break;
    case 'personnel_task':
    include('personnel_task_time.php');
    break;
    case 'operator_task':
    include('operator_task_time.php');
    break;
    case 'dispatched_manpower':
    include('dispatched_mp.php');
    break;
    case 'dispatched_operator':
    include('dispatched_optr.php');
    break;
    case 'equipment_work_time':
    include('equipment_work_time.php');
    break;
    case 'edit_equipment':
    include('edit-equipment.php');
    break;
    case 'box_type':
    include('box_type.php');
    break;
    case 'weight_per_box':
    include('weight_per_box.php');
    break;
    case 'attendance':
    include('attendance.php');
    break;
    case 'editattendance':
    include('editattendance.php');
    break;
    case 'check_attendance':
    include('check_attendance.php');
    break;
    case 'view_attendance':
    include('view_attendance.php');
    break;
    case 'equipment_type':
    include('equipment_type.php');
    break;
    case 'personnel_timestamp':
    include('personnel_timestamp.php');
    break;
    case 'operator_timestamp':
    include('operator_timestamp.php');
    break;
    case 'equipment_timestamp':
    include('equipment_timestamp.php');
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
