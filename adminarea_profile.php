<?php 
session_start();
?>
<html>
<head>
<title>Admin Area</title>
<link rel="stylesheet" href="ressources/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body>
<script src="ressources/js/bootstrap.min.js"></script>

<?php
//just a page to list all admin functions:
if($_SESSION['isadmin'] == 0) { //but first a check if you've got admin rights. if not, destroy the session and go back to start.
    die ('No rights for you! <meta http-equiv="refresh" content="0; URL=logout.php">');
} //this is purely a cosmetic effect. no harm could be done from here. it's merely a html page with a little check if you've got the right rights.
echo '<div class="alert alert-danger" role="alert">heres the admin world</div>';

echo $_GET['username'];

$username = $_GET['username']; //then we get the username from the session

echo "<br><hr><br>";

echo $username;

$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username"); //building a statement & getting the whole line of username = $username
$result = $statement->execute(array('username' => $username));
$user = $statement->fetch(); //putting the stuff in an array and afterwards store it in the session:
$userid = $user['id'];
$useremail = $user['email'];
$username = $user['username'];
$usergn = $user['givenName'];
$userln = $user['lastName'];
$activated = $user['activated'];
$updatedat = $user['updated_at'];
$isadmin = $user['isadmin'];
$profilepicture = $user['profilepicture'];

echo "<br><hr><br>";

echo $user;

echo "<br>";

echo $username;

 //print a info bar with the username
echo '<div class="alert alert-info" role="alert">Profil von '.$usergn.'</div>';
echo "<br/>";
//lets build a table with infos:
echo '<table class="table table-dark table-striped" style="width:30%">';
echo "<tr>";
echo "<td>";
echo "Minecraft Username";
echo "</td>";
echo "<td>";
echo $username;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "User-ID";
echo "</td>";
echo "<td>";
echo $userid;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "Name";
echo "</td>";
echo "<td>";
echo $usergn;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "Dein Ort";
echo "</td>";
echo "<td>";
echo $userln;
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "E-Mail";
echo "</td>";
echo "<td>";
echo $useremail;
echo "</td>";
echo "</tr>";
?>
</table>
<br /> <br /><br />
<table class="table table-dark table-striped" style="width:30%">
<?php
//another table just for "activated" & "isadmin"
echo "<tr>";
echo "<td>";
echo "User Status:";
echo "</td>";
echo "<td>";
if ($activated == 0) { //if not activated print it in red and render a activation link
    echo '<p class="text-danger">Noch nicht aktiviert!</p><br>';
    echo 'Click <a href="activation.php">here</a> to activate';
}
if ($activated == 1) { //if activated print so, but in green
    echo '<p class="text-success">Aktiviert!</p>';
}
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "Auf Server aktiviert:";
echo "</td>";
echo "<td>";
if ($profilepicture == 2) { //if not admin, print "User" in green
    echo '<p class="text-warning">Gesperrt</p><br>';
}
if ($profilepicture == 1) { //if admin, print so but in red
    echo '<p class="text-success">Ja</p>';
}
if ($profilepicture == 0) {
    echo '<p class="text-danger">Nein</p>';
}
if ($profilepicture == 3) {
    echo '<p class="text-danger">Nein <a class="text-warning">Anfrage läuft</a></p>';
}
echo "<tr>";
echo "<td>";
echo "User Level:";
echo "</td>";
echo "<td>";
if ($isadmin == 0) { //if not admin, print "User" in green
    echo '<p class="text-success">Nutzer</p><br>';
}
if ($isadmin == 1) { //if admin, print so but in red
    echo '<p class="text-danger">Admin</p>';
}
echo "</td>";
echo "</tr>";
//some html:
?>

</table>
<br>
<br/>
<br>
<a href="start.php"><button class="btn btn-info">Zurück</button></a>
<br/>
<br>
