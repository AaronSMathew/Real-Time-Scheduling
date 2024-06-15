<?php
session_start();

ob_start();
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>School Faculty Scheduling System</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <style>
       @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(45deg, #8e2de2, #4a00e0);
  background-size: 400% 400%;
  animation: gradientAnimation 15s ease infinite;
}

@keyframes gradientAnimation {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

.login-form {
  background-color: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
  max-width: 400px;
  width: 100%;
  animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: scale(0.9);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

.login-title {
  text-align: center;
  margin-bottom: 30px;
  color: #fff;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.input-box {
  position: relative;
  margin-bottom: 20px;
}

.input-box i {
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #fff;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.input-box input,
.input-box select {
  width: 100%;
  padding: 15px 40px;
  border: none;
  border-radius: 5px;
  outline: none;
  background-color: rgba(142, 45, 226, 0.3);
  color: #fff; /* Updated input text color */
  backdrop-filter: blur(10px);
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s ease;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}

.input-box input::placeholder,
.input-box select option {
  color: rgba(255, 255, 255, 0.9); /* Updated placeholder text color */
}

.input-box select option {
  color: rgba(255, 255, 255, 0.7);
  background-color: rgba(74, 0, 224, 0.8); /* Updated background color for options */
}

.input-box select:focus {
  background-color: rgba(142, 45, 226, 0.4); /* Updated focus background color */
}
.remember-forgot-box {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.remember-forgot-box label {
  display: flex;
  align-items: center;
  color: rgba(255, 255, 255, 0.7);
  cursor: pointer;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.remember-forgot-box input[type="checkbox"] {
  margin-right: 5px;
}

.remember-forgot-box a {
  color: rgba(255, 255, 255, 0.7);
  text-decoration: none;
  transition: color 0.3s ease;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.remember-forgot-box a:hover {
  color: #fff;
}

.login-btn {
  width: 100%;
  padding: 15px;
  border: none;
  border-radius: 5px;
  background: linear-gradient(45deg, #8e2de2, #4a00e0);
  color: #fff;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s ease;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.login-btn:hover {
  background: linear-gradient(45deg, #4a00e0, #8e2de2);
}

.register {
  text-align: center;
  margin-top: 20px;
  color: rgba(255, 255, 255, 0.7);
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.register a {
  color: rgba(255, 255, 255, 0.7);
  text-decoration: none;
  transition: color 0.3s ease;
}

.register a:hover {
  color: #fff;
}

    </style>
  </head>
  <body>
    <form id="login-form" action="login.php" method="post" class="login-form">
      <h1 class="login-title">Login</h1>

      <div class="input-box">
        <i class="bx bxs-user"></i>
        <input type="text" id="username" name="username" placeholder="Username" />
      </div>
      <div class="input-box">
        <i class="bx bxs-lock-alt"></i>
        <input type="password" id="password" name="password" placeholder="Password" />
      </div>
      <div class="input-box">
        <i class="bx bx-user-circle"></i>
        <select id="type" name="type">
          <option value="" selected disabled>Select Role</option>
          <option value="3">Student</option>
          <option value="1">Admin</option>
          <option value="2">Teacher</option>
        </select>
      </div>

      <div class="remember-forgot-box">
        <label for="remember">
          <input type="checkbox" id="remember" />
          Remember me
        </label>
        <a href="#">Forgot Password?</a>
      </div>

      <button type="submit" class="login-btn">Login</button>

      <p class="register">
        Don't have an account?
        <a href="#">Register</a>
      </p>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#login-form').submit(function(e){
          e.preventDefault();
          $('#login-form button[type="submit"]').attr('disabled', true).html('Logging in...');
          if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();

          // Submit the form
          $.post('ajax.php?action=login', $(this).serialize())
          .done(function(resp) {
            console.log(resp);
            if(resp == 1) {
              // Get the username from the input field
              var username = $('#username').val();
              console.log('Username entered:', username);

              // Redirect based on selected type
              var selectedType = $('#type').val();
              console.log(selectedType);
              switch(selectedType) {
                case '1':
                  window.location.href = 'admin/index.php';
                  break;
                case '3':
                  window.location.href = 'Student/index.php';
                  break;
                case '2':
                  window.location.href = 'Teacher/index.php';
                  break;
                default:
                  console.log('Invalid type selected');
              }
            } else {
              $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
              $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
            }
          })
          .fail(function(xhr, status, error) {
            console.log(xhr.responseText);
            $('#login-form').prepend('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
            $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
          });
        });
      });
    </script>
  </body>
</html>