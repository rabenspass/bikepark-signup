
<html>
<head>
<title>Logout</title>
<meta http-equiv="refresh" content="0; URL=start.php">
</head>
<body>
<?php
//just start a session and destroy it. afterwards go back to the start page (thats what the http-equiv refresh does)
session_start();
session_destroy();
 
echo "Logout erfolgreich. Gehe zur Startseite";

?>
</body>
</html>