<?php
session_start(); //get a session started.
//here we dont need a db connection, just some data from the session
$userid = $_SESSION['userid'];
$isadmin = $_SESSION['isadmin']; 
$activated = $_SESSION['activated'];
//now lets build the website (its just a bootstrap example page)
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Minecraft Bikepark Projekt</title>


    <link href="ressources/css/bootstrap.min.css" rel="stylesheet">
    <link href="ressources/css/start.css" rel="stylesheet">
  </head>

  <body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">Minecraft Bikepark</h5>
      <nav class="my-2 my-md-0 mr-md-3">

        <a class="p-2 text-dark" href="https://github.com/rabenspass/bikepark-signup">Fork me on GitHub</a>
        <?php
      if($userid > 0){ //if the user is logged in (has a userid above 0) then print this:
        echo 'Hi <a href="profile.php">'.$_SESSION['username'].'</a>';  
      }else{ //if there isn't a user session print a register button instead
      echo '<a class="p-2 text-dark" href="register.php">Registrieren</a>';
    }
      ?>
      </nav>
      <?php
      if($userid > 0){ //if the user is logged in (has a userid above 0) print a logout button
        echo '<a class="btn btn-outline-primary" href="logout.php">Ausloggen</a>';  
      }else{ //if there isn't a user session print a login button
      echo '<a class="btn btn-outline-primary" href="login.php">Einloggen</a>';
    }
      ?>
    </div>
    <?php
    if(isset($_GET['activation_req'])) { //looks for "?activation_req=1" in the url and prints the warning below
    echo '<div class="alert alert-danger" role="alert">Your account isnt activated yet!</div><br>';
}?>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">bikepark.rabenspass.de Registrierung</h1>
      <p class="lead">Registriere dich hier um mit uns deinen Traum Bikepark zu konzipieren.</p>
    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
      <?php
      if($userid > 0){ // you get the drift, if the user is logged in print this
        ?>
        <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Profil</h4>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mt-3 mb-4">
          <li>Dein Profil</li>
        </ul>
        <a href="profile.php"><button type="button" class="btn btn-lg btn-block btn-primary">Profil</button></a>
      </div>
    </div>
        <?php  
      }else{ //if not print this
      ?>
      <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Registrieren</h4>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mt-3 mb-4">
          <li>Wenn du noch keinen Account hast.</li>
        </ul>
        <a href="register.php"><button type="button" class="btn btn-lg btn-block btn-primary">Registriere dich hier</button></a>
      </div>
    </div>
      <?php
    }
      ?>
        <?php
      if($userid > 0){ //same
        ?>
        <div class="card mb-4 box-shadow">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Bereits aktiviert?</h4>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mt-3 mb-4">
          <li>Pr&uuml;fe ob du schon freigeschaltet bist.</li>
        </ul>
        <?php
        if ($activated == 0) { //check if the user is activated. if not, disable the button.
    echo '<a href="?activation_req=1"><button class="btn btn-primary disabled">Freischalt Bereich</button></a>';
}
if ($activated == 1) { //if enabled, than activate the button & give it a real function.
    echo '<a href="activatedarea.php"><button class="btn btn-lg btn-block btn-primary">Freischalt Bereich</button></a>';
}?>
      </div>
    </div>
        <?php  
      }else{ //else print a login field
      ?>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Login</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Einloggen</li>
            </ul>
            <a href="login.php"><button type="button" class="btn btn-lg btn-block btn-primary">Einloggen</button></a>
          </div>
        </div>
      <?php
    }
      ?>
       <?php
      if($userid > 0){//yeah, you guessed. same as above
        ?>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Passwort ändern</h4>
          </div>
          <div class="card-body">
              <ul class="list-unstyled mt-3 mb-4">
              <li>Das selbe wie Passwort vergessen. Braucht einen aktivierten Account!</li>
            </ul>
            <a href="forgotpass.php"<button type="button" class="btn btn-lg btn-block btn-outline-primary">Passwort ändern</button></a>
          </div>
        </div>
      </div>
        <?php  
      }else{ //...
      ?>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Passwort zurücksetzen</h4>
          </div>
          <div class="card-body">
              <ul class="list-unstyled mt-3 mb-4">
              <li>Lasse hier dein Passwort zurücksetzen</li>
            </ul>
            <a href="forgotpass.php"<button type="button" class="btn btn-lg btn-block btn-outline-primary">Passwort zurücksetzen</button></a>
          </div>
        </div>
      </div>
      <?php
    }
      ?>
      <?php
if ($isadmin == 0) { //checks if admin privileges are granted. if not, just print a linebreak
    echo '<br>';
}
if ($isadmin == 1) { //if admin rights are granted, print a admin area button
    echo '<a href="adminarea.php"><button class="btn btn-danger">Admin Area</button></a>';
}
//footer and stuff 
?>
      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="https://web.td00.de/woddle.gif" alt="" >
            <small class="d-block mb-3 text-muted">&copy; NO RIGHTS RESERVED! 2021</small>
          </div>
          <div class="col-6 col-md">
            <h5>Mehr</h5>
            <ul class="list-unstyled text-small">
              
              <li><a class="text-muted" href="https://thiesmueller.de">Software & Infrastruktur</a></li>
              <li><a class="text-muted" href="https://bikepark.rabenspass.de">Über das Projekt</a></li>
              <li><a class="text-muted" href="https://rabenspass.de">Rabenspass</a></li>
                  </ul>
          </div>
      
          <div class="col-6 col-md">
            <h5>Über</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="https://github.com/rabenspass/bikepark-signup">GitHub Projekt</a></li>
              <li><a class="text-muted" href="https://rabenspass.de/datenschutzerklaerung">Datenschutzerklaerung</a></li>
              <li><a class="text-muted" href="https://rabenspass.de/impressum/">Impressum</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="ressources/js/bootstrap.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
