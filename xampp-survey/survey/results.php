<?php include('server.php') ; session_start();
$survey_url = ""; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css" type="text/css">
      <title>Results</title>
  </head>
  <body>
    <div class="header">
      <div class="inner_header">
        <div class="logo_container">
          <a href="/survey/home.php">
            <h1> <img src="https://image.flaticon.com/icons/svg/1484/1484918.svg" alt="" width="50" height="50">
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
              <?php } ?>
            </div>
          </div>
        </ul>
      </div>
    </div>

    <!-- start wrap div -->
    <div class="form-group">

        <table id="myTable">
          <tr class="header1">
            <th class="account-top" style="width:25%; text-align: center;">Q1 Mean</th>
            <th class="account-top" style="width:25%; text-align: center;">Q1 Var</th>
            <th class="account-top" style="width:25%; text-align: center;">Q2 Mean</th>
            <th class="account-top" style="width:25%; text-align: center;">Q2 Var</th>
          </tr>
        <!-- start PHP code -->
        <?php
            $survey_url = mysqli_real_escape_string($db, $_GET['url']);
            $survey = "SELECT * FROM surveys WHERE survey_url='$survey_url'";
            $survey_query = mysqli_query($db, $survey);
            $survey_info = mysqli_fetch_assoc($survey_query);
            $survey_title = $survey_info['survey_title'];
            $type11mean = "SELECT AVG(type11ans) FROM recipients WHERE survey_url='$survey_url'";
            $type11var = "SELECT VARIANCE(type11ans) FROM recipients WHERE survey_url='$survey_url'";
            $type12mean = "SELECT AVG(type12ans) FROM recipients WHERE survey_url='$survey_url'";
            $type12var = "SELECT VARIANCE(type12ans) FROM recipients WHERE survey_url='$survey_url'";
            $type2ans = "SELECT * FROM recipients WHERE survey_url='$survey_url'";
            $one1mean = mysqli_query($db, $type11mean);
            $one1meaninfo = mysqli_fetch_assoc($one1mean);
            $mean1 = $one1meaninfo['AVG(type11ans)'];
            $one1var = mysqli_query($db, $type11var);
            $one1varinfo = mysqli_fetch_assoc($one1var);
            $var1 = $one1varinfo['VARIANCE(type11ans)'];
            $one2mean = mysqli_query($db, $type12mean);
            $one2meaninfo = mysqli_fetch_assoc($one2mean);
            $mean2 = $one2meaninfo['AVG(type12ans)'];
            $one2var = mysqli_query($db, $type12var);
            $one2varinfo = mysqli_fetch_assoc($one2var);
            $var2 = $one2varinfo['VARIANCE(type12ans)'];
            $type2qs = mysqli_query($db, $type2ans);
            $match  = mysqli_num_rows($type2qs);
            if($match > 0)
            {
              echo '<h1>'.$survey_title.'</h1>';

                        echo
                        "<tr>
                        <td>" . $mean1 . "</td>
                        <td>" . $var1 . "</td>
                        <td>" . $mean2 . "</td>
                        <td>" . $var2 . "</td>
                        </tr>";

                    }
                    echo "</table>";
            // INSERT LINK BACK TO ACCOUNT
             ?>
        <!-- stop PHP Code -->

    </table>

    </div>
    <br>
    <br>
    <br>

    <div class="form-group">
    <table id="myTable">
          <tr class="header1">
            <th class="account-top" style="width:100%; text-align: center;">Answer</th>
          </tr>
        <!-- start PHP code -->
        <?php
            $survey_url = mysqli_real_escape_string($db, $_GET['url']);
            $survey = "SELECT * FROM surveys WHERE survey_url='$survey_url'";
            $survey_query = mysqli_query($db, $survey);
            $survey_info = mysqli_fetch_assoc($survey_query);
            $survey_title = $survey_info['survey_title'];
            $type2ans = "SELECT * FROM recipients WHERE survey_url='$survey_url'";
            $type2qs = mysqli_query($db, $type2ans);
            $type2ans_info = mysqli_fetch_assoc($type2qs);
            $match  = mysqli_num_rows($type2qs);
            if($match > 0)
            {
              for($i = 0; $i < $match; $i++)
              {
                        echo
                        "<tr>
                        <td>" . $type2ans_info['type2ans']. "</td>
                        </tr>";
                    }
            }
                    echo "</table>";
            // INSERT LINK BACK TO ACCOUNT
             ?>
        <!-- stop PHP Code -->

    </table>
    </div>
    <!-- end wrap div -->
</body>
<footer>Copyright &copy; COP4710 Team 4<br></footer>
</html>