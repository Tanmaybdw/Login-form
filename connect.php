<?php
$username = filter_input(INPUT_POST, 'username');
$usermail = filter_input(INPUT_POST, 'emailuser'); 
$password = filter_input(INPUT_POST, 'password');
$cpass = filter_input(INPUT_POST, 'cpass');
if (!empty($username)){
if (!empty($usermail)){
if (!empty($password)){
if ((!empty($cpass)) && ($password == $cpass) ){
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "login_data";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname, 3307);

 
if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}
else{
$sql = "INSERT INTO users (username, emailuser, password)
values ('$username','$usermail','$password')";
if ($conn->query($sql)){
echo "New record is inserted sucessfully";
}
else{
echo "Error: ". $sql ."
". $conn->error;
}
$conn->close();
}
}
else if ((!empty($cpass)) && ($password != $cpass)){
    echo "password and confirm Password should be same";
    die();  
}
else{
    echo "confirm Password should not be empty";
    die();  
}
}
else{
echo "Password should not be empty";
die();
}
}
else{
    echo "Email should not be empty";
    die();
}
}
else{
echo "Username should not be empty";
die();
}
?>