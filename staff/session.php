<?php

// connect to database
include('connection.php');

//Start the session library
session_start();

// If there is no user session, redirect the user to the login page.
if(!isset($_SESSION['user']))
{
	header('location:index.php');
}else{
	//If there is a user session, get the user details and store them in variables
	$sql = $db->query("SELECT * FROM staff LEFT JOIN offices ON offices.officeid=users.Position WHERE staff.id='".$_SESSION['user']."'");
	$query = $sql->fetch_array();
	$firstname = $query['firstName'];
	$lastname = $query['lastName'];
	$username = $query['username'];
	$idNumber = $query['idNumber'];
	$email = $query['emailAddress'];
	$department = $query['department'];
	// $useroffice = $query['Position'];
}

// Users
$users = $db->query("SELECT * FROM users WHERE User_status='1'");

// Departments
$offices = $db->query("SELECT * FROM offices");

// Students
$students = $db->query("SELECT * FROM students");

// courses
$courses = $db->query("SELECT * FROM courses");

// staffs
$staff = $db->query("SELECT * FROM staff");