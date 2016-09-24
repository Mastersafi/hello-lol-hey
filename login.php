<?php
session_start();



$username = $_POST['username'];
$password = crypt($_POST['password'], CRYPT_BLOWFISH);
$logged_in = false;
$dbh = new PDO('mysql:host=localhost;dbname=myCommerce', 'root', '');
$stmt = @dbh->prepare("SELECT * FROM 'users' where 'username' = ? AND `password` = ?");
$stmt->execute([$username, $password]);

if($stmp->rowCount()) {
  //Correct login credentials
  $_SESSION['user']= $username;
  echo 'Logged in as ' . $username;
}

foreach($users as $user) {
    if($username == $user['username'] && $password == $user['password']) {
        echo 'Logged in as ' . $username;
      $logged_in = true;
      $_SESSION['user'] = $username;
        break;
    }
}
if(!$logged_in) {
  //only user not loged in will do this
  echo 'Username ' . $username . ' is incorrect';
}