<?php
  require_once "server.php";

  session_start();

  $email1 = "";
  $wrong = "no";
  if(isset($_SESSION['survey_url']) && !empty($_SESSION['survey_url']))
  {
    //populate email_array
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $wrong = "post";
        $survey_url = $_SESSION['survey_url'];
        $email1 = mysqli_real_escape_string($db, $_POST['email1']);
        $responder = $email1;
        $find_query = "SELECT * FROM surveys WHERE survey_url='$survey_url'";
        $search = mysqli_query($db, $find_query);
        $match  = mysqli_num_rows($search);
        if($match > 0)
        {
            $wrong = "no it's fine";
            //inside loop: for each email in email array
            require "Mail.php";
            $from = "surveymasterdevteam@gmail.com";
            $to = $email1;
            $host = "ssl://smtp.gmail.com";
            $port = "465";

            $devemail = 'surveymasterdevteam@gmail.com';
            $password = 'devteam!';
            $subject = "You've been invited to take a survey!";
            $body = '

            Over at SurveyMaster, home of award winning surveys, you have been invited to participate in a survey.
            To take the survey, click the link below.
            <a href="localhost/survey/survey.php?survey_url='.$survey_url.'&responder='.$responder.'">
            localhost/survey/survey.php?survey_url='.$survey_url.'&responder='.$responder.'</a>

            ';

            $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject);
            $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $devemail, 'password' => $password));
            $mail = $smtp->send($to, $headers, $body);

            echo ' <meta http-equiv="refresh" content="0;url=survey.php?survey_url='.$survey_url.'>';
        }
          else
          {
            $wrong = "yeah";
          }
      }
        else
        {
          echo "Why aren't you posting";
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Send Out Survey</title>
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
          <h1>Add Recipients</h1>
          <fieldset class="create">
            <div class="recipients">
            <div class="form-group">
                <label>Recipient's Emails:</label>
                <div class="email-icon">
                  <img 
                    src="https://image.flaticon.com/icons/svg/129/129481.svg" 
                    alt="" 
                    class="email-icon"
                    width="90"
                    height="auto"
                  >
                </div>

                <form name="add_name" id="add_name" action="recipients.php" method="post">

                    <br>

                    <div class="input-icon">
                      <input 
                        type="text" 
                        name="email1" 
                        placeholder="Enter first recipient's email" 
                        class="input" 
                        value="<?php echo $email1; ?>" 
                      />
                      <i>1:</i>
                    </div>

                    <br>

                    <div class="input-icon input-icon-right">
                      <input 
                        type="text" 
                        name="email1" 
                        placeholder="Enter second recipient's email" 
                        class="input"
                        value="<?php echo $email1; ?>" 
                      />
                      <i>2:</i>
                    </div>

                    <br>

                    <div class="input-icon">
                      <input 
                        type="text" 
                        name="email1" 
                        placeholder="Enter third recipient's email" 
                        class="input" 
                        value="<?php echo $email1; ?>" 
                      />
                      <i>3:</i>
                    </div>

                    <br>

                    <div class="input-icon input-icon-right">
                      <input 
                        type="text" 
                        name="email1" 
                        placeholder="Enter fourth recipient's email" 
                        class="input" 
                        value="<?php echo $email1; ?>" 
                      />
                      <i>4:</i>
                    </div>

                    <br>

                    <div class="input-icon">
                      <input 
                        type="text" 
                        name="email1" 
                        placeholder="Enter fifth recipient's email" 
                        class="input" 
                        value="<?php echo $email1; ?>" 
                      />
                      <i>5:</i>
                    </div>

                    <br>

                    <div class="input-icon input-icon-right">
                      <input 
                        type="text" 
                        name="email1" 
                        placeholder="Enter sixth recipient's email" 
                        class="input"
                        value="<?php echo $email1; ?>" 
                      />
                      <i>6:</i>
                    </div>

                    <br>

                    <div class="input-icon">
                      <input 
                        type="text" 
                        name="email1" 
                        placeholder="Enter seventh recipient's email" 
                        class="input" 
                        value="<?php echo $email1; ?>" 
                      />
                      <i>7:</i>
                    </div>

                    <br>

                    <div class="input-icon input-icon-right">
                      <input 
                        type="text" 
                        name="email1" 
                        placeholder="Enter eigth recipient's email" 
                        class="input"
                        value="<?php echo $email1; ?>" 
                      />
                      <i>8:</i>
                    </div>

                    <br>

                    <div class="input-icon">
                      <input 
                        type="text" 
                        name="email1" 
                        placeholder="Enter ninth recipient's email" 
                        class="input"
                        value="<?php echo $email1; ?>" 
                      />
                      <i>9:</i>
                    </div>

                    <br>

                    <div class="input-icon input-icon-right">
                      <input 
                        type="text" 
                        name="email1" 
                        placeholder="Enter tenth recipient's email" 
                        class="input" 
                        value="<?php echo $email1; ?>" 
                      />
                      <i>10:</i>
                    </div>

                    <br>

                    <div class="recipient-submit">
                     <input
                            type="submit"
                            name="submit"
                            id="submit"
                            class="btn btn-info"
                            value="Submit"
                      />  
                    </div>    


                 </form>  
            </div> 
          </div>
        </fieldset>
    </div>

  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>
