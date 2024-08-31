<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title>Student Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/admin/css/app.min.css">
  <link rel="stylesheet" href="../assets/admin/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/admin/css/style.css">
  <link rel="stylesheet" href="../assets/admin/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../assets/admin/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='../assets/admin/img/favicon.ico' />
</head>
<body>
  <div class="loader"></div>
  <div id="app">
     <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="text-center" >Student Register</h4>
              </div>
              <div class="card-body">
                 <form method="POST" id="RegisterForm">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" tabindex="1">
                     <div class="error_name text-danger"></div>
                  </div>

                  <div class="form-group">
                    <label for="course_name">Course Name</label>
                    <select name="course_name" id="course_name" class="form-control" required>
                      <option value="">Select Course Name</option>
                        <option value="B.Tech">B.Tech</option>
                        <option value="M.Tech">M.Tech</option>
                        <option value="Bsc">Bsc</option>
                        <option value="Msc">Msc</option>
                        <option value="BCA">BCA</option>
                        <option value="MCA">MCA</option>
                    </select>
                     <div class="error_course_name text-danger"></div>
                  </div>

                  <div class="form-group">
                    <label for="Semester">Semester</label>
                    <select name="semester" id="semester" class="form-control" required>
                      <option value="">Select Semester</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                        <option value="VI">VI</option>
                        <option value="VII">VII</option>
                        <option value="VIII">VIII</option>
                        <option value="IX">IX</option>
                        <option value="X">X</option>
                    </select>
                     <div class="error_semester text-danger"></div>
                  </div>

                  <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" name="email" id="email" class="form-control" tabindex="1">
                     <div class="error_name text-danger"></div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2">
                    <div class="password_error text-danger"></div>
                  </div>

                  
                 <!--  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label for="email">Captcha : <img src="../public/captcha.php" alt="Captcha Image"></label>
                    <input id="captcha" type="text" class="form-control" name="captcha"  tabindex="1">
                     <div class="username_error text-danger"></div>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Register
                    </button>
                    <div id='response' style="color:red;"></div>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">You Have Login <a href="login.php">Singin</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
 <script src="../assets/admin/js/app.min.js"></script>
  <script src="../assets/admin/js/scripts.js"></script>
  <script src="../assets/admin/js/custom.js"></script>
</body>

</html>
   <link rel="stylesheet" type="text/css" href="../assets/toast/jquery.toast.css">
  <script src="../assets/toast/jquery.toast.js"></script>
<script>
$(document).ready(function () {
    // Validate the form
    $('#RegisterForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting the default way

        // Clear previous error messages
        $('.error_name, .error_course_name, .error_semester, .error_email, .password_error, .captcha_error').text('');

        // Get form data
        var name = $('#name').val().trim();
        var course_name = $('#course_name').val().trim();
        var semester = $('#semester').val().trim();
        var email = $('#email').val().trim();
        var password = $('#password').val().trim();
        var captcha = $('#captcha').val().trim();

        // Validate form fields
        var isValid = true;

        if (name === "") {
            $('.error_name').text('Please enter your name.');
            isValid = false;
        }
        if (course_name === "") {
            $('.error_course_name').text('Please select a course name.');
            isValid = false;
        }
        if (semester === "") {
            $('.error_semester').text('Please select a semester.');
            isValid = false;
        }
        if (email === "") {
            $('.error_email').text('Please enter your email.');
            isValid = false;
        } else if (!validateEmail(email)) {
            $('.error_email').text('Please enter a valid email address.');
            isValid = false;
        }
        if (password === "") {
            $('.password_error').text('Please enter a password.');
            isValid = false;
        }
        if (captcha === "") {
            $('.captcha_error').text('Please enter the captcha.');
            isValid = false;
        }

        // If form is valid, submit data via Ajax
        if (isValid) {
            $.ajax({
                url: '../public/register_action.php', // URL of the PHP script to handle form submission
                type: 'POST',
                dataType: 'json',
                data: {
                    name: name,
                    course_name: course_name,
                    semester: semester,
                    email: email,
                    password: password,
                    captcha: captcha
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $.toast({
                            heading: 'Success',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                        $('#RegisterForm')[0].reset(); // Clear the form
                        window.location.href = "login.php";
                    } else {
                        $.toast({
                            heading: response.status === 'Captcha' ? 'Captcha Error' : 'Error',
                            text: response.message,
                            showHideTransition: 'fade',
                            icon: 'error',
                            position: 'top-right'
                        });
                    }
                },
                error: function() {
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong. Please try again.',
                        showHideTransition: 'fade',
                        icon: 'error',
                        position: 'top-right'
                    });
                }
            });
        }
    });

    // Email validation function
    function validateEmail(email) {
        var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return re.test(email);
    }
});
</script>

</body>
</html>