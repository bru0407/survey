<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Style.css" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>Create Survey</title>
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
              <a href="Login.php">Login</a>
              <a href="account.php">Account</a>
              <a href="CreateSurvey.php">Create Survey</a>
              <a href="logout.php">Logout</a>
            </div>
          </div>
        </ul>
      </div>
    </div>
        <div class="createsurvey-page">
          <h1>Create Your Survey</h1>
          <form method="post">
          <fieldset class="create">
            <div class="form-group">
              <label>Survey Title:</label>
              <br>
              <input type="text" class="input" name="title" placeholder="Enter survey title."/>
              <br>
            </div>
            <div class="form-group">
              <label>Survey Description:</label>
              <br>
              <textarea class="textbox" maxlength="300" rows="10" cols="50" placeholder="Enter survey description."></textarea>
              <br>
            </div>
            <div class="form-group">
              <label>Confirm Password:</label>
              <br>
              <input type="password" class="input" name="password1" placeholder="Confirm password."/>
              <br>
            </div>
            <div class="button">
              <input type="submit" name="submit" id="submit" class="submit" value="Create Account"/>
            </div>
          </fieldset>
        </form>
    </div>


<script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "./addmore.php";
      var i=1;  


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    i=1;
                    $('.dynamic-added').remove();
                    $('#add_name')[0].reset();
                    alert('Record Inserted Successfully.');
                }  
           });  
      });


    });  
</script>



  </body>
<footer>Copyright &copy; COP4710<br></footer>
</html>
