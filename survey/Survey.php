<?php

include('server.php');

$survey_url = "";
$responder = "";

if(isset($_GET['url']) && isset($_GET['responder']))
{
  $survey_url = mysqli_real_escape_string($db, $_GET['url']);
  $responder = mysqli_real_escape_string($db, $_GET['responder']);
  $check_url = "SELECT survey_url FROM surveys WHERE survey_url='$survey_url'";
  $yes_url = mysqli_query($db, $check_url);
  $match  = mysqli_num_rows($yes_url);
  if($match > 0)
  {
    $new_table = "INSERT INTO answers (survey_url, responder) VALUES ('$survey_url', '$responder')";
    $new_answer = mysqli_query($db, $new_table);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./Style.css" type="text/css">
  <title>Survey<?php echo $survey_url ?></title>
  <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 200) {
          val.value = val.value.substring(0, 200);
        } else {
          $('#charNum').text(200 - len);
        }
      };
    </script>
</head>

<body>

<div class="header">
    <div class="inner_header">
      <div class="logo_container">
        <a href="/survey/home.php">
          <img src="https://cdn.pixabay.com/photo/2017/05/15/23/48/survey-2316468_1280.png" alt="" width="50" height="50">
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
              <a href="Login.php">Login</a>
              <?php } else { ?>
              <a href="account.php">Account</a>
              <a href="CreateSurvey.php">Create Survey</a>
              <a href="logout.php">Logout</a>
              <?php } ?>
          </div>
        </div>
      </ul>
    </div>
  </div>

<div class="survey-page">

<form>
  <h1>Survey</h1>

  <p>Survey Description</p>
  
  <br>
  <div class="form-group">

    <p>Question 1</p>
    <input type="radio" name="radio" value="1">1 <input type="radio" name="radio"
    value="2">2 <input type="radio" name="radio" value="3">3 <input type="radio"
    name="radio" value="4">4 <input type="radio" name="radio" value="5">5 <br>

  </div>

  <div class="form-group">
    <p>Question 2</p>
    <textarea maxlength="200" onkeyup="countChar(this)"rows="10" cols="50">
      
    </textarea><br>
    <div id="charNum" class="charNum"></div>
  </div>
  <br>

  <input type="submit" value="Submit"> </form>
</div>
</body>
<footer>Copyright &copy; COP4710<br>
</footer></html>
