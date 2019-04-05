<?php include('server.php') ?>
<?php
if(!(isset($_SESSION['username'])))
{
  $_SESSION['msg'] = "You must log in to view this page.";
  header("location: /survey/login.php");
}

if(isset($_GET['logout']))
{
  session_destroy();
  unset($_SESSION['username']);
  header("location: /survey/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Style.css" type="text/css">
    <title>Create Survey</title>
  </head>
  <body>
    <div class="header">
      <div class="inner_header">
        <div class="logo_container">
          <a href="/survey/home.php">
            <h1> <img src="http://www.flexrule.com/wp-content/uploads/2014/06/db.png" alt="" width="50" height="50">
              Survey<span>Master</span>
            </h1>
          </a>
        </div>
        <ul class="navigation">
          <div class="dropdown">
            <button class="dropbtn">Menu<i class="down"></i></button>
            <div class="dropdown-content">
              <a href="registration.php">Register</a>
              <a href="CreateSurvey.php">Create Survey</a>
              <a href="Login.php">Login</a>
            </div>
          </div>
        </ul>
      </div>
    </div>
  <?php
    if(isset($_SESSION['username'])) : ?>
      <h3>Welcome <?php echo $_SESSION['username']; ?></h3>
      <button><a href="home.php?logout='1'">Logout</a></button>
    <?php
      if(isset($_SESSION['success'])) : ?>
        <div class="create">
          <h1>Create your own survey</h1>
          <p>In the text box provide below, type two questions that you would like our team to create survey out of.</p>
          <textarea maxlength="200" rows="10" cols="50"></textarea><br>
          <input type="submit" value="Submit">  <br>
          <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
          ?>
        </div>
      <?php endif ?>
    <?php endif ?>
  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>
