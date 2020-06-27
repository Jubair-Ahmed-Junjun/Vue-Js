<?php
$conn = new mysqli('localhost','root','','vue_crud_php'); 
if ($conn == FALSE) {
	die('Error'.mysql_error());
}
$result = array('error'=>false);
$id = '';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
//View User
if ($id == 'read') {
	$sql = $conn->query("SELECT * FROM users");
	$users = array();
	while ($row = $sql->fetch_assoc()) {
		array_push($users,$row);
	}
	$result['users'] = $users;
}
//Add user
if ($id == 'create') {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$sql = $conn->query("INSERT INTO users(name,email,phone)VALUES('$name','$email','$phone')");
	if ($sql) {
		$result['message'] = "User Added Successfully!";

	}else{
		$result['error'] = true;
		$result['message'] = "Faild to Added user";
	}
}

//update user

if ($id == 'update') {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$sql = $conn->query("UPDATE users SET name = '$name',email='$email',phone='$phone' WHERE id ='$id'");
	if ($sql) {
		$result['message'] = "User update successfully!";
	}else{
		$result['error'] = true;
		$result['message'] = "Not updated";
	}
}

//delete user

if ($id == 'delete') {
	$id = $_POST['id'];
	$sql = $conn->query("DELETE FROM users WHERE id ='$id'");
	if ($sql) {
		$result['message'] = "User delete successfully!";
	}else{
		$result['error'] = true;
		$result['message'] = "Not deleted";
	}

}

echo json_encode($result);
?>