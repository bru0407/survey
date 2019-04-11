<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./style.css" type="text/css">
  <title>Home Page</title>
</head>
<body>

  <div class="header">
    <div class="inner_header">
      <div class="logo_container">
        <a href="/survey/home.php">
          <img src="https://image.flaticon.com/icons/svg/1484/1484918.svg" alt="" width="50" height="50">
           <h1>
            SurveyMaster
          </h1>
        </a>
      </div>
      <ul class="navigation">
        <div class="dropdown">
          <button class="dropbtn">Menu<i class="down"></i></button>
          <div class="dropdown-content">
            <?php if (empty($_SESSION['loggedin']) || !isset($_SESSION['loggedin'])) { ?>
              <a href="registration.php">Register</a>
              <a href="login.php">Login</a>
              <?php } else { ?>
              <a href="account.php">Account</a>
              <a href="createsurvey.php">Create Survey</a>
              <a href="logout.php">Logout</a>
              <?php } ?>
          </div>
        </div>
      </ul>
    </div>
  </div>


<div class="home-page">
  <h1>SurveyMaster</h1>
  <h2>Home of award winning surveys</h2>
  <br>
  <div class="wallpaper">
      <img 
        src="home.jpg" 
        alt="" 
        class="home-picture"
      >
      <button class="btn">
        <?php if (empty($_SESSION['loggedin']) || !isset($_SESSION['loggedin'])) { ?>
            <a href="login.php">Start Here</a>
        <?php } else { ?>
            <a href="createsurvey.php">Start Here</a>
        <?php } ?>
      </button>
  </div>

  <div class="row">
    <h1>Acknowledgements</h1> 
    <div class="column">
      <img 
        src="https://cdn0.iconfinder.com/data/icons/education-circular-2/90/92-512.png" 
        alt="" 
        class="award"
        width="100"
        height="auto"
      >
      <h2>A+</h2>
      <h2>Award</h2>
    </div>
    <div class="column">
      <img 
        src="https://png.pngtree.com/svg/20161018/e4ea6b608b.png" 
        alt="" 
        class="award"
        width="100"
        height="auto"
      >
      <h2>Backpack</h2>
      <h2>Award</h2>
    </div>
    <div class="column">
      <img 
        src="https://cdn0.iconfinder.com/data/icons/tutor-icon-set/512/diploma_icon-512.png" 
        alt="" 
        class="award"
        width="100"
        height="auto"
      >
      <h2>Graduation</h2>
      <h2>Award</h2>
    </div>
  </div>

</div>

<footer>Copyright &copy; COP4710<br>
</footer>
</html>
