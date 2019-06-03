<?php
require_once './library/config.php';
require_once './library/functions.php';

//$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$mod = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

if($mod == 'customer'){
	switch ($view) {
	
		case 'makeComplain' :
			$content 	= 'makeComplain.php';		
			$pageTitle 	= 'Grievance Management System - Make Complains';
		break;
		
		
		case 'compDetails' :
			$content 	= 'compDetails.php';		
			$pageTitle 	= 'Grievance Management System - View Complains Detail';
		break;
		
		case 'feedback' :
			$content 	= 'feedback.php';		
			$pageTitle 	= 'Grievance Management System - Give Your Complains';
		break;
		
	
	}//switch
}//if
elseif($mod == 'admin'){
	switch ($view) {
	
		case 'compDetails' :
			$content 	= 'adminCompDetails.php';		
			$pageTitle 	= 'Grievance Management System - View Complains Detail';
		break;
		
		case 'repo' :
			$content 	= 'repo.php';		
			$pageTitle 	= 'Grievance Management System - View Complains Detail';
		break;
		
		case 'repod' :
			$content 	= 'repo-detail.php';		
			$pageTitle 	= 'Grievance Management System - Detail Reports';
		break;
		
		case 'reports' :
			$content 	= 'reports.php';		
			$pageTitle 	= 'Grievance Management System - Reports';
		break;
		
		case 'compCloseDetails' :
			$content 	= 'adminCompCloseDetails.php';		
			$pageTitle 	= 'Grievance Management System - View Close Complains';
		break;
		
		case 'vDetails' :
			$content 	= 'viewEnggDetails.php';		
			$pageTitle 	= 'Grievance Management System - View Engineer Details';
		break;
		
		case 'enggDetails' :
			$content 	= 'enggDetails.php';		
			$pageTitle 	= 'Grievance Management System - View Engineer Details';
		break;
		
		case 'custDetails' :
			$content 	= 'custDetails.php';		
			$pageTitle 	= 'Grievance Management System - View Engineer Details';
		break;
		
		
		case 'viewByCompID' :
			$content 	= 'viewByCompID.php';		
			$pageTitle 	= 'Grievance Management System - Give Your Complains';
		break;
		
		case 'doEdit' :
			$content 	= 'editEngg.php';		
			$pageTitle 	= 'Grievance Management System - Edit Engineer';
		break;
		
		case 'doEditCust' :
			$content 	= 'editCust.php';		
			$pageTitle 	= 'Grievance Management System - Edit Customer';
		break;
		
		case 'addEngg' :
			$content 	= 'addEngg.php';		
			$pageTitle 	= 'Grievance Management System - Edit Engineer';
		break;
		
		case 'addCust' :
			$content 	= 'addCust.php';		
			$pageTitle 	= ' Grievance Management System - Add Customer';
		break;
	
	}//switch
}//if
elseif($mod == 'employee'){
	switch ($view) {
	
		case 'viewComplain' :
			$content 	= 'employeeCompDetails.php';		
			$pageTitle 	= 'Grievance Management System - View Complains Detail';
		break;
		
		case 'viewComplainClose' :
			$content 	= 'employeeCompClose.php';		
			$pageTitle 	= 'Grievance Management System - View Complains Detail';
		break;
		
		case 'viewByCompID' :
			$content 	= 'empViewByCompID.php';		
			$pageTitle 	= 'Grievance Management System - View Complains / Add Comment';
		break;
		
		case 'closeComplain' :
			$content 	= 'closeComplain.php';		
			$pageTitle 	= 'Grievance Management System - Close complain';
		break;

	}//switch
}//if

require_once './include/template.php';

?>
