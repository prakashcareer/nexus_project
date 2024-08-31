<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <title>Student Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/admin/css/app.min.css">
  <link rel="stylesheet" href="../assets/admin/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/admin/css/style.css">
  <link rel="stylesheet" href="../assets/admin/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../assets/admin/css/custom.css">
  <link rel="stylesheet" type="text/css" href="../assets/toast/jquery.toast.css">
</head>
<body>
  <div id="app">
     <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="text-center">Student Login</h4>
              </div>
              <div class="card-body">
                 <p class="text-center">Enter your email address and password to access the Student panel.</p> 
                <form id="LoginForm">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1">
                    <div class="email_error text-danger"></div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2">
                    <div class="password_error text-danger"></div>
                  </div>
                  <div class="form-group">
                    <label for="captcha">Captcha: <img src="../public/captcha.php" alt="Captcha Image"></label>
                    <input id="captcha" type="text" class="form-control" name="captcha" tabindex="3">
                    <div class="captcha_error text-danger"></div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">Login</button>
                    <div id="response" class="mt-3 text-danger"></div>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Don't have an account? <a href="register.php">Signup</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="../assets/admin/js/app.min.js"></script>
  <script src="../assets/toast/jquery.toast.js"></script>
  <script>
    $(document).ready(function () {
        $('#LoginForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '../public/login_action.php',
                dataType: 'json',
                data: {
                    email: $('#email').val(),
                    password: $('#password').val(),
                    captcha: $('#captcha').val()
                },
                beforeSend: function() {
                    $('#response').html("<b>Loading response...</b>");
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $.toast({
                            heading: 'Success',
                            text: response.msg,
                            position: 'top-right',
                            icon: 'success'
                        });
                        window.location.href = "dashboard.php";
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: response.msg,
                            position: 'top-right',
                            icon: 'error'
                        });
                        $('#response').html(response.msg);
                    }
                },
                error: function (xhr, status, error) {
                    $.toast({
                        heading: 'Error',
                        text: 'Something went wrong. Please try again.',
                        position: 'top-right',
                        icon: 'error'
                    });
                    $('#response').html("Posting failed: " + error);
                }
            });
        });
    });
  </script>
</body>
</html>
