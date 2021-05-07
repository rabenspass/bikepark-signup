<!DOCTYPE html> 
<html> 
<head>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
   
  <title>Activate User</title>    
</head> 
<body>
<?php 
session_start(); //session & stuff, you know it
include 'db.inc.php'; //and a db connection, you know it...
 

 
$sessionuser = $_SESSION['username']; //get the usernamne from the session
$showForm = true; //print the "form" (in this case just a button)
 
if(isset($_GET['send']) ) { //you know the drill. if theres a "?=send=1" this little script comes to action
 if(!isset($sessionuser) || empty($sessionuser)) { //checks if you've got a valid session if not, it prints it out.
 $error = '<span class="badge badge-pill badge-danger"><b>No Valid User in Session. Please Login Again!</b></span>';
 } else { //if theres a valid session do this:
 $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username"); //sql statement username = $sessionuser
 $result = $statement->execute(array('username' => $sessionuser));
 $user = $statement->fetch(); 
 
 if($user === false) { //in some cases users have a valid session, but the account was deleted in the background, this has that case covered: 
    $error = '<span class="badge badge-pill badge-warning"><b>no user found</b></span>';
 }
 if($user['username'] == ""){ //if you've managed to create a user without username, print an error.
    $error = '<span class="badge badge-pill badge-warning"><b>no user found</b></span>';
 }
 if($user['profilepicture'] == 3){ //if your account is already activated:
     $error = '<span class="badge badge-pill badge-warning"><b>Bereits angefragt!</b></span>';
 }
 if ($user['profilepicture'] == 1){
     $error = '<span class="badge badge-pill badge-warning"><b>Bereits freigeschaltet!</b></span>';
 } 
 if ($user['profilepicture'] == 2){
    $error = '<span class="badge badge-pill badge-warning"><b>Profil gesperrt!</b></span>';
} else {
 $statement = $pdo->prepare("UPDATE users SET profilepicture = :profilepicture WHERE id = :userid"); //prepare the statement
 $result = $statement->execute(array('profilepicture' => "3", 'userid' => $user['id'])); //activationcode in db is sha1 of real activationcode
 //now lets compose a mail:
 $mailrcpt = "bikepark-mc@rabenspass.de";  //mail goes to user that should be validated.
 $mailsubject = "Activate the Account of ".$user['username']; //the subject
 $from = "From: Account Activation Service <activatemyaccount@".$_SERVER['HTTP_HOST'].">"; //send mail from "activatemyaccount@%urlyourusingtoaccessthisscript%"

 //thats the content of the mail:
 $text = 'Hi,
'.$user['username'].' moechte freigeschaltet werden! 
 
 
cheers
loginpagefoo script';
// mail($mailrcpt, $mailsubject, $text, $from); //sending the mail with the build-in mail function.
 
 echo 'Anfrage gestellt <meta http-equiv="refresh" content="0; URL=activatedarea.php">'; 
 //afterwards going back to profile, and dont render the form again.
 $showForm = false;
 }
 }
}
 
if($showForm): //you guessed it: html & the form:
?>
 
<h1>Freischalten Lassen</h1>
 
<?php
if(isset($error) && !empty($error)) {
 echo $error;
}
?>
 <script src="ressources/js/bootstrap.min.js"></script>
<form action="?send=1" method="post">
<button type="submit" class="btn btn-primary">Klicke hier um dich auf die Freischaltliste zu setzen</button>
</form>
 
<?php
endif; //thats all
?>