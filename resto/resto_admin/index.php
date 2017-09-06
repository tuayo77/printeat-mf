<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin | Connexion</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />

      </head>
      <?php 
      session_start();
require_once("class/crud.class.php");
$login = new USER();

if($login->is_loggedin()!="")
{
    $login->redirect('home.php');
}

if(isset($_POST['connexion']))
{
    $uname = strip_tags($_POST['username']);
    $upass = strip_tags($_POST['password']);
  
    if($login->doLogin($uname,$upass))
    {
        $login->redirect('home.php');
    }
    else
    {
        $error = "information erroné";
    }   
}

      ?>



      <body class="skin-black"> 
 <div class="container">
<p> <div id="error">
        <?php
            if(isset($error))
            {
                ?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
            }
        ?>
        </div>
        </p>
      <form class="form-signin" method="POST" action="#">
        <h2 class="form-signin-heading">conecté vous</h2>
        <label for="inputEmail" class="sr-only">nom d'utilisateur</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="nom d'utilisateur" required autofocus>
        <label for="inputPassword" class="sr-only">mot de passe</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="mot de passe" required>
        
        <button class="btn btn-lg btn-primary btn-block" name="connexion" type="submit">connexion</button>
      </form>

    </div> <!-- /container -->




















      </body>
     
      </html>