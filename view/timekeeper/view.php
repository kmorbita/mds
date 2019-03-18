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
    case 'employee_list':
        include('employee_list.php');
        break;
    case 'editemp':
        include('edit.php');
        break;
    case 'changepassword':
        include('changepassword.php');
        break;
    case 'changepass':
        include('changepass.php');
        break;
    case 'equipment':
        include('equipment.php');
        break;
    case 'operator':
        include('operator.php');
        break;
    case 'equipment_optr':
        include('equipment_optr.php');
        break;
    case 'edit_equipment_optr':
        include('edit_equipment_optr.php');
        break;
    case 'fillin':
        include('fillin.php');
        break;
    case 'assigned_list':
        include('assigned_list.php');
        break;
    case 'messages':
        include('messages.php');
        break;
    case 'task':
        include('task.php');
        break;
    case 'edittask':
        include('edit_task.php');
        break;
    case 'present_employee':
        include('present_employee.php');
        break;
    case 'view_fillin':
        include('view_fillin.php');
        break;
    case 'view_task':
        include('view_task.php');
        break;
    case 'dispatched_manpower':
        include('dispatched_mp.php');
        break;
    case 'dispatched_operator':
        include('dispatched_optr.php');
        break;
    case 'activity':
        include('activity.php');
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
    case 'personnel_timestamp':
        include('personnel_timestamp.php');
        break;
    case 'operator_timestamp':
        include('operator_timestamp.php');
        break;
    case 'equipment_timestamp':
        include('equipment_timestamp.php');
        break;
	default:
		include('joborderlist.php');
	break;
}
?>
