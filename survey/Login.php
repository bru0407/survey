<?php include('server.php') ?>
<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="UTF-8">

    <link rel="stylesheet" href="./Style.css" type="text/css">

      <title>Current User</title>

  </head>

    <body>

      <div class="header">

        <div class="inner_header">

          <div class="logo_container">

            <a href="./home.php">

              <h1>

                <img src="http://www.flexrule.com/wp-content/uploads/2014/06/db.png" alt="" width="50" height="50">

                Survey<span>Master</span>

              </h1>

            </a>

          </div>



          <ul class="navigation">

<div class="dropdown">
	<button class="dropbtn">Menu<i class="down"></i>
</button>
<div class="dropdown-content">
          <a href="registration.php">Register</a>
<a href="CreateSurvey.php">Create Survey</a>
          <a href="Login.php">Login</a>
</div>
</div>
        </ul>
        </div>

      </div>

    <div class="register-page">

      <h1>Login</h1>

        <form method="post">

          <fieldset class="field">

            <div class="form-group">
              <img
              src="user.png"
              alt=""
              height="180"
              class="user-img"
              >

              <br>

              <label>Username:</label>

              <br>

              <input

                type="text"

                class="input" name="username"

                placeholder="Enter your first name"

              />

              <br>

            </div>

            <div class="form-group">

              <label>Password:</label>

              <br>

              <input

                type="password"

                class="input" name="password1"

                placeholder="Password"

              />

              <br>

            </div>



            <div class="button">

              <input

                type="submit"

                class="submit"

                value="Login"

              />

            </div>

          </fieldset>

        </form>

        <p>Not a user? <a href="registration.php">Create an Account here</a></p>

      </div>

    </body>

    <footer>Copyright &copy; COP4710<br></footer>

</html>
