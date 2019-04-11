<?php
echo $survey_start;

session_start();
// Include config file
require_once "server.php";

if(isset($_GET['logout']))
{
  session_destroy();
  unset($_SESSION['username']);
  header("location: /survey/login.php");
}

// Define variables and initialize with empty values
$username = $_SESSION['username'];
$survey_desc = "";
$survey_title = "";
$survey_start = "";
$survey_end = "";
$type1s = ["", "", "", "", ""];
$type2s = ["", "", "", "", ""];
$title_err = "";
$desc_err = "";
$survey_url = "";
$start_err = "";
$end_err = "";


function makeURL()
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    while (1)
    {
        $key = '';
        for ($i = 0; $i < 10; $i++) {
            $key .= substr($chars, (random_int(0, 255) % (strlen($chars))), 1);
        }
        break;
    }
    return $key;
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  // Validate username
  if(empty($_POST["survey_title"]))
  {
    $title_err = "Please enter a title for your survey.";
  }
  else
  {
    $survey_title = mysqli_real_escape_string($db, $_POST['survey_title']);
  }

  if(!empty($_POST["survey_desc"]))
  {
    $survey_desc = mysqli_real_escape_string($db, $_POST['survey_desc']);
  }

  //generate url
  do
  {
    $random_url = makeURL();
    $url_check_query = "SELECT * FROM surveys WHERE survey_url = '$random_url' LIMIT 1";
    $url_check_result = mysqli_query($db, $url_check_query);
    $url_survey = mysqli_fetch_assoc($url_check_result);
  } while($url_survey['survey_url'] == $random_url);
  $survey_url = $random_url;

  if(empty($_POST["survey_start"]))
  {
    $start_error = "You must enter a start date.";
  }
  else
  {
    $survey_start = $_POST['survey_start'];
    echo $survey_start;
  }

  if(empty($_POST["survey_end"]))
  {
    $end_error = "You must enter an end date.";
  }
  else
  {
    $survey_end = $_POST['survey_end'];
  }

  if(!empty($survey_url)) //and something about question count variables here
  {
    $insert_survey = "INSERT INTO surveys (username, survey_url, survey_title, survey_desc) VALUES ('$username',
      '$survey_url', '$survey_title', '$survey_desc')";
    mysqli_query($db, $insert_survey);
    $_SESSION['survey_url'] = $survey_url;
    $_SESSION['created'] = "Survey created successfully.";

    echo ' <meta http-equiv="refresh" content="0;url=recipients.php">';
  }
}

  // Close connection
  mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      function countChar(val) {
        var len = val.value.length;
        if (len >= 500) {
          val.value = val.value.substring(0, 500);
        } else {
          $('#charNum').text(500 - len);
        }
      };
    </script>
    <title>Create Survey</title>
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
        <div class="createsurvey-page">
          <h1>Create Your Survey</h1>
          <form action="createsurvey.php" method="post">
          <fieldset class="create">
            <br>
            <div class="form-group  <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
              <label>Survey Title:</label>
              <br>
              <input type="text" class="input" name="survey_title" placeholder="Enter survey title." value="<?php echo $survey_title; ?>"/>
              <br>
            <span class="help-block"><?php echo $title_err; ?></span>
            <br>
            </div>

            <br>
            <div class="form-group  <?php echo (!empty($desc_err)) ? 'has-error' : ''; ?>">
              <label>Survey Description:</label>
              <br>
              <textarea type="date" class="textbox" name="survey_desc" maxlength="500" rows="10" cols="50" onkeyup="countChar(this)" placeholder="Enter survey description." value="<?php echo $survey_desc; ?>"></textarea>
              <div id="charNum" class="charNum"></div>
              <br>
            <span class="help-block"><?php echo $desc_err; ?></span>
            <br>
            </div>

            <br>

            <div class="form-group <?php echo (!empty($start_err)) ? 'has-error' : ''; ?>">
              <label>Starting Date:</label>
              <input type="date" class="datepicker" id="start" name="start" placeholder="Enter survey starting date." value="<?php echo $survey_start; ?>">
            </div>
            <br>
            <span class="help-block"><?php echo $start_err; ?></span>

            <br>

            <div class="form-group <?php echo (!empty($end_err)) ? 'has-error' : ''; ?>">
              <label>Ending Date:</label>
              <input type="text" class="datepicker" id="end" name="end" placeholder="Enter survey ending date." value="<?php echo $survey_end; ?>">
            </div>
            <br>
            <span class="help-block"><?php echo $end_err; ?></span>
            <br>

            <br>

            <div class="form-group">
              <label>Type 1 Questions:</label>
                <input
                  type="text"
                  name="name[]"
                  placeholder="Enter 1-5 type question."
                  class="type11"
                  id="type11"
                />

                <br>

                <input
                  type="text"
                  name="name[]"
                  placeholder="Enter 1-5 type question."
                  class="type11"
                  id="type11"
                />

                <br>

                <input
                  type="text"
                  name="name[]"
                  placeholder="Enter 1-5 type question."
                  class="type11"
                  id="type11"
                />

            </div>

            <br>

            <div class="form-group">
              <label>Type 2 Questions:</label>
                <input
                  type="text"
                  name="name[]"
                  placeholder="Enter text type question."
                  class="type2"
                  id="type2"
                />

                <br>

                <input
                  type="text"
                  name="name[]"
                  placeholder="Enter text type question."
                  class="type2"
                  id="type2"
                />

                <br>

                <input
                  type="text"
                  name="name[]"
                  placeholder="Enter text type question."
                  class="type2"
                  id="type2"
                />

            </div>

            <br>

            <div class="button">
              <input type="submit" name="submit" id="submit" class="submit" value="Create Account"/>
            </div>
          </fieldset>
        </form>
    </div>

<script>
  $( function() {
    $( ".datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
    {
      
    }
  } );
</script>

  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>
