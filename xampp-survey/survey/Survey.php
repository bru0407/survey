<?php
  include('server.php');

  $survey_url = !empty($_GET['survey_url']) ? $_GET['survey_url'] : "help";
  $response_id = !empty($_GET['response_id']) ? $_GET['response_id'] : "help";

  $type11q = "";
  $type12q = "";
  $type2q = "";
  $type11ans = "";
  $type12ans = "";
  $type2ans = "";
  $type11_err = "";
  $type12_err = "";
  $type2_err = "";

  $check_url = "SELECT * FROM surveys WHERE survey_url='$survey_url'";
  $yes_url = mysqli_query($db, $check_url);
  $survey_info = mysqli_fetch_assoc($yes_url);
  $match  = mysqli_num_rows($yes_url);
  if($match > 0)
  {
    $survey_title = $survey_info['survey_title'];
    $survey_desc = $survey_info['survey_desc'];

    $type11table = "SELECT question FROM type11 WHERE survey_url='$survey_url'";
    $table_11 = mysqli_query($db, $type11table);
    $type11table_entries = mysqli_fetch_assoc($table_11);
    $type11q = $type11table_entries['question'];

    $type12table = "SELECT question FROM type12 WHERE survey_url='$survey_url'";
    $table_12 = mysqli_query($db, $type12table);
    $type12table_entries = mysqli_fetch_assoc($table_12);
    $type12q = $type12table_entries['question'];

    $type2table = "SELECT question FROM type2 WHERE survey_url='$survey_url'";
    $table_2 = mysqli_query($db, $type2table);
    $type2table_entries = mysqli_fetch_assoc($table_2);
    $type2q = $type2table_entries['question'];


  }
if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    echo '<h1>'.$survey_url.'</h1>';

    if(empty($_POST["type11ans"]))
    {
      $type11_err = "Please enter a value between 1 and 5.";
    }
    else
    {
      $type11ans = $_POST['type11ans'];
      $debug = "found type11ans";
      echo '<h1>'.$type11ans.'</h1>';
      if($type11ans > 5 || $type11ans < 1)
      {
        $type11_err = "You must enter an integer between 1 and 5.";
        $type11ans = "";
      }
    }

    if(empty($_POST["type12ans"]))
    {
      $type12_err = "Please enter a value between 1 and 5.";
    }
    else
    {
      $type12ans = $_POST['type12ans'];
      if($type12ans > 5 || $type12ans < 1)
      {
        $type12_err = "You must enter an integer between 1 and 5.";
        $type12ans = "";
      }
    }

    if(!empty($_POST['type2ans']))
    {
      $type2ans = mysqli_real_escape_string($db, $_POST['type2ans']);
      if(strlen($type2ans) < 10)
      {
        $type2_err = "Your answer must be at least 10 characters long.";
        $type2ans = "";
      }
    }
    else
    {
      $type2_err = "Please answer the question.";
    }

    if(!empty($type2ans))
    {
      $submittype12 = "UPDATE recipients SET type12ans='".$type12ans."' WHERE response_id='".$response_id."'";
      $submittype2 = "UPDATE recipients SET type2ans='".$type2ans."' WHERE response_id='".$response_id."'";
      $submittype11 = "UPDATE recipients SET type11ans='".$user_email."' WHERE response_id='".$response_id."'";
      mysqli_query($db, $submittype11);
      mysqli_query($db, $submittype12);
      mysqli_query($db, $submittype2);

      echo "<script type='text/javascript'>alert('Thank you for your response!')</script>";
      echo ' <meta http-equiv="refresh" content="0;url=home.php">';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./style.css" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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

<div class="survey-page">


  <h1><?php echo $survey_title ?></h1>
  <p><?php echo $survey_desc ?></p>

  <br>
  <form class="box" action="survey.php" method="POST">

  <div class="form-group">
    <input type="hidden" name="survey_url" value="<?php echo $_GET['survey_url']?>" />
    <input type="hidden" name="response_id" value="<?php echo $_GET['response_id']?>" />
    <h2>1: <?php echo $type11q ?></h2>
    <p>
      Answer this question by selection a value from 1 - 5.
    </p>
    <p>
      1 = Strongly Disagree -> 5 = Strongly Agree
    </p>

    <br>
    <br>

    <div class="slidecontainer">
      <input type="range" min="1" max="5" step="1" value="3" id="q1" name="passengers" onchange='document.getElementById("bar1").value = "Value = " + document.getElementById("q1").value;'/>
      <input type="show" name="bar1" id="bar1" value="Value = 3" disabled />
    </div>

  </div>

  <br>

  <div class="form-group">

    <h2>2: <?php echo $type12q ?></h2>
    <p>
      Answer this question by selection a value from 1 - 5.
    </p>
    <p>
      1 = Strongly Disagree -> 5 = Strongly Agree
    </p>

    <br>
    <br>

    <div class="slidecontainer">
      <input type="range" min="1" max="5" step="1" value="3" id="q2" name="passengers" onchange='document.getElementById("bar2").value = "Value = " + document.getElementById("q2").value;'/>
      <input type="show" name="bar2" id="bar2" value="Value = 3" disabled />
    </div>

  </div>

  <br>

  <div class="form-group">
    <h2>3: <?php echo $type2q ?></h2>
    <p>
      Answer this question by writing up 200 characters.
    </p>

    <br>
    <br>

    <textarea type="text" id="type2ans" name="type2ans" maxlength="200" class="textbox" rows="10" cols="50" onkeyup="countChar(this)" value="<?php echo $type2ans; ?>"></textarea>
    <br>
    <div id="charNum" class="charNum"></div>
  </div>
  <br>

  <div class="padding-bottom">
    <input type="submit" value="Submit">
  </div>
  </form>
</div>
</body>
<footer>Copyright &copy; COP4710 Team 4<br>
</footer></html>