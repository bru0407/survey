
<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./Style.css" type="text/css">
  <title>Home Page</title>
</head>
<body>

  <div class="header">
    <div class="inner_header">
      <div class="logo_container">
        <a href="/survey/home.php">
          <h1> <img src="http://www.flexrule.com/wp-content/uploads/2014/06/db.png" alt="" width="50" height="50">
            SurveyMaster
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

<div class="home-page">
  <h1>Welcome to SurveyMaster</h1>
  <div class="images">
    <a href="Login.php">
      <img src="https://lh3.googleusercontent.com/0N_6m-gZn6WJbaweASX6e_RXp5tmUU77e2qV6nfPp0-VStWC41lWp-tYWrI_A3-K7jBkSvMQB8Ie0-5CzQqGRHmy5LgWd34=s688" alt="" width="200"height="200">
      <p>Member Login</p>
    </a>
  </div>

  <div class="images">
    <a href="registration.php">
      <img src="https://static.thenounproject.com/png/542237-200.png" alt="" width="200"height="200">
      <p>New User</p>
    </a>
  </div>
</div>

<footer>Copyright &copy; COP4710<br>
</footer>
</html>
