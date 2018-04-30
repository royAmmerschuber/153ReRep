<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Login</title>
    <?php include_once  "head.php"?>
    <!-- Custom styles for this template -->
    <link href="/153ReRep/layout/css/floating-labels.css" rel="stylesheet">
    <script src="/153ReRep/layout/js/auth.js"></script>
</head>

<body>
<?php include_once "header.php"?>
<div class="form-signin" id="formLogin">
    <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Login</h1>
        <p>Please login</p>
    </div>

    <p class="err" id="eName"></p>
    <div class="form-label-group">
        <input type="text" id="inputName" class="form-control" placeholder="Username" name="name" required autofocus>
        <label for="inputName">Username</label>
    </div>

    <p class="err" id="ePassword"></p>
    <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
        <label for="inputPassword">Password</label>
    </div>

    <!--<div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>-->
    <button class="btn btn-lg btn-primary btn-block" onclick="checkLogin()">Sign in</button>
<!--    <p class="mt-5 mb-3 text-muted text-center"><a href="/153ReRep/Auth/register">Register</a></p>-->
</div>
<?php include_once "footer.php"?>
</body>
</html>
