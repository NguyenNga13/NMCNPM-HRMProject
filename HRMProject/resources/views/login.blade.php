<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>HRM</title>
  <base href="{{asset('')}}">

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">

  <div>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form role="form" action="login" method="POST" id="form-login" >
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <h1>Đăng nhập</h1>
            @include('hrm.layout.notify')
            <div class="form-group">
              <div>
                <input type="text" class="form-control" placeholder="Tên đăng nhập" required="" autofocus="" name="username"  id="username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Mật khẩu" required="" name="password" id="password" />

              </div>
            </div>

            <div class="clearfix"></div>
            <div class="form-group">
              <div class="col-md-4">
                <div class="radio">
                  <label><input type="radio" name="position" value="3" checked>Chung</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="radio">
                  <label><input type="radio" name="position" value="2">HRM</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="radio">
                  <label><input type="radio" name="position" value="1">Admin</label>
                </div>
              </div>

            </div>
            <div class="clearfix"></div>


            <div class="separator">
              <a class="reset_pass" href="#">Quên mật khẩu?</a>

              <!-- <a href="#" > Quên mật khẩu </a> -->

              <button type="submit" class="btn btn-default submit" form="form-login">Đăng nhập</button>
            </div>
          </form>
        </section>
      </div>




    </div>
  </div>
</body>
</html>
