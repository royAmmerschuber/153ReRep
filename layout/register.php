<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <?php  include_once "head.php"?>
    <!-- Custom styles for this template -->
    <link href="/153ReRep/layout/css/floating-labels.css" rel="stylesheet">
    <script src="/153ReRep/layout/js/auth.js"></script>
</head>

<body>
<?php include_once "header.php"?>
<div class="form-signin" id="formRegister">
    <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Register</h1>
        <p>Please Register</p>
    </div>

    <p class="err" id="eName"></p>
    <div class="form-label-group">
        <input type="text" id="inputName" class="form-control" placeholder="User Name" name="user" required autofocus>
        <label for="inputName">User Name</label>
    </div>

    <p class="err" id="ePassword1"></p>
    <div class="form-label-group">
        <input type="password" id="inputPassword1" class="form-control" placeholder="Password" name="password1" required>
        <label for="inputPassword1">Password</label>
    </div>

    <p class="err" id="ePassword2"></p>
    <div class="form-label-group">
        <input type="password" id="inputPassword2" class="form-control" placeholder="Password" name="password2" required>
        <label for="inputPassword2">Password</label>
    </div>

    <!--<div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>-->
    <button class="btn btn-lg btn-primary btn-block" onclick="checkRegister()">Register</button>
    <p class="mt-5 mb-3 text-muted text-center"><a href="/153ReRep/Auth/login">Login</a></p>

</div>
<?php include_once "footer.php"?>
</body>
</html>