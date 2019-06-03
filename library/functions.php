<?php

/*
	Check if a session user id exist or not. If not set redirect
	to login page. If the user session id exist and there's found
	$_GET['logout'] in the query string logout the user
*/
function checkUser()
{
	// if the session id is not set, redirect to login page
	if (!isset($_SESSION['user_id'])) {
		header('Location: ' . WEB_ROOT . 'login.php');
		exit;
	}
	
	// the user want to logout
	if (isset($_GET['logOut'])) {
		doLogout();
	}
}

/*
	
*/
function doLogin()
{
	// if we found an error save the error message in this variable
	$errorMessage = '';
	
	$userName = $_POST['txtUserName'];
	$password = $_POST['txtPassword'];
	$uType    = $_POST['utype'];
	// first, make sure the username & password are not empty
	if ($userName == '') {
		$errorMessage = 'You must enter your username';
	} else if ($password == '') {
		$errorMessage = 'You must enter the password';
	} else {
		
		//check if user is customer
		if($uType == 'customer')
		{
			$sql = "SELECT  cid, cname
					FROM tbl_customer
					WHERE cname = '$userName' AND cpass = '$password'";
			$result = dbQuery($sql);
			if (dbNumRows($result) == 1) {
				$row = dbFetchAssoc($result);
				$_SESSION['user_id'] = $row['cid'];
				$_SESSION['user_name'] = $row['cname'];
				$_SESSION['user_type'] = $uType;
			}//if
			header('Location: '.WEB_ROOT.'index.php');
			exit;		
		}//if
		
		elseif($uType == 'employee')
		{
			$sql = "SELECT  eid, ename
					FROM tbl_engineer
					WHERE ename = '$userName' AND epass = '$password'";
			$result = dbQuery($sql);
			if (dbNumRows($result) == 1) {
				$row = dbFetchAssoc($result);
				$_SESSION['user_id'] = $row['eid'];
				$_SESSION['user_name'] = $row['ename'];
				$_SESSION['user_type'] = $uType;
			}//if
			header('Location: '.WEB_ROOT.'index.php');
			exit;		
		}
		elseif($uType == 'admin'){
			//$_SESSION['user_id'] = $row['sid'];
			if($userName == 'admin' && $password == 'admin123'){
				$_SESSION['user_id'] = 0;
				$_SESSION['user_name'] = 'Administrator';
				$_SESSION['user_type'] = 'admin';
				header('Location: '.WEB_ROOT.'index.php');
				exit;
			}
			else {
				$errorMessage = 'You are Not an Admin. Please Login using another Role.';
			}//else
		}//if Admin
		else {
			$errorMessage = 'Username or Password is not Valid. Please try again.';
		}//else		
			
	}//else
	return $errorMessage;
}
/*
	Register
*/

function doRegister()
{
	// if we found an error save the error message in this variable
	$errorMessage = '';
	
	$userName = $_POST['txtUserName'];
	$password = $_POST['txtPassword'];
	$utype = $_POST['utype'];
	$txtAdd = $_POST['txtAdd'];
	$txtMob = $_POST['txtMob'];
	$txtEmail = $_POST['Email'];
	
	
	// first, make sure the username & password are not empty
	if ($userName == '') {
		$errorMessage = 'You must enter your username';
	} else if ($password == '') {
		$errorMessage = 'You must enter the password';
	}else if ($txtAdd == '') {
		$errorMessage = 'You must enter the Address';
	}else if ($txtMob == '') {
		$errorMessage = 'You must enter the Mobile No.';
	}else if (strlen($txtMob) < 10) { 
		$errorMessage = 'Mobile No. must contain 10 digits';
	}else if ($txtEmail == '') {
		$errorMessage = 'You must enter the E-mail.';
	}else {
		// check the database and see if the username and password combo do match
		if($utype == 'customer'){
			
			$sql = "SELECT cname
					FROM tbl_customer
					WHERE cname = '$userName'";
			$result = dbQuery($sql);
			if (dbNumRows($result) == 1) {
				$errorMessage = 'Username already taken. Choose another one';	
			} else {			
				$sql   = "INSERT INTO tbl_customer (cname, cpass, address, email, c_mobile, date_time)
						  VALUES ('$userName', '$password', '$txtAdd','$txtEmail','$txtMob',NOW())";
				dbQuery($sql);
				$errorMessage = 'Registration is Successful. You can Login Now.';
				header('Location: login.php');	
			}
		}//if 		
			
	}//else
	return $errorMessage;
}

/*
	Logout a user
*/
function doLogout()
{
	unset($_SESSION);
	session_destroy();
	session_write_close();
	header('Location:/login.php');
	exit;
}




/*
	Create the paging links
*/
function getPagingNav($sql, $pageNum, $rowsPerPage, $queryString = '')
{
	$result  = mysql_query($sql) or die('Error, query failed. ' . mysql_error());
	$row     = mysql_fetch_array($result, MYSQL_ASSOC);
	$numrows = $row['numrows'];
	
	// how many pages we have when using paging?
	$maxPage = ceil($numrows/$rowsPerPage);
	
	$self = $_SERVER['PHP_SELF'];
	
	// creating 'previous' and 'next' link
	// plus 'first page' and 'last page' link
	
	// print 'previous' link only if we're not
	// on page one
	if ($pageNum > 1)
	{
		$page = $pageNum - 1;
		$prev = " <a href=\"$self?page=$page{$queryString}\">[Prev]</a> ";
	
		$first = " <a href=\"$self?page=1{$queryString}\">[First Page]</a> ";
	}
	else
	{
		$prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
		$first = ' [First Page] '; // nor 'first page' link
	}
	
	// print 'next' link only if we're not
	// on the last page
	if ($pageNum < $maxPage)
	{
		$page = $pageNum + 1;
		$next = " <a href=\"$self?page=$page{$queryString}\">[Next]</a> ";
	
		$last = " <a href=\"$self?page=$maxPage{$queryString}{$queryString}\">[Last Page]</a> ";
	}
	else
	{
		$next = ' [Next] ';      // we're on the last page, don't enable 'next' link
		$last = ' [Last Page] '; // nor 'last page' link
	}
	
	// return the page navigation link
	return $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 
}

function doChangePassword()
{
	// if we found an error save the error message in this variable
	$errorMessage = '';
	
	$userName = $_POST['txtUserName'];
	$email = $_POST['txtEmail'];
	$uType    = $_POST['utype'];
	// first, make sure the username & password are not empty
	if ($userName == '') {
		$errorMessage = 'You must enter your username';
	} else if ($email == '') {
		$errorMessage = 'You must enter the Email';
	} else {
		
		//check if user is customer
		if($uType == 'customer')
		{
			$sql = "SELECT  cname, cpass
					FROM tbl_customer
					WHERE cname = '$userName' AND email = '$email'";
			$result = dbQuery($sql);
			if (dbNumRows($result) == 1) {
				$row = dbFetchAssoc($result);
				$npass = $row['cpass'];
				$errorMessage = "Your password is $npass. You can <a href='login.php'>Login Now</a>.";	
			}else {
				$errorMessage = "You are not a Valid Customer.";
			}
					
		}//if
		elseif($uType == 'employee')
		{
			$sql = "SELECT  eid, ename, epass
					FROM tbl_engineer
					WHERE ename = '$userName' AND email = '$email'";
			$result = dbQuery($sql);
			if (dbNumRows($result) == 1) {
				$row = dbFetchAssoc($result);
				$npass = $row['epass'];
				$errorMessage = "Your password is $npass. You can <a href='login.php'>Login Now</a>.";
			}else {
				$errorMessage = "You are not a Valid Engineer.";
			}		
		}
				
			
	}//else
	return $errorMessage;
}


?>