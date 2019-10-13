<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>Login</title>
</head>
<body>
<div class="container">

    <div class="left">
        <h3>Jobseeker</h3>
        <form method="post" action="../controllers/Login.controller.php">
            <p>Username</p>
            <input type="text" name="j-username">
            <p>Password</p>
            <input type="password" name="j-password">
            <input type="submit" name="jobseeker">
        </form>
        <a href="../controllers/JobseekerRegister.controller.php">
            <button>Sign Up</button>
        </a>
    </div>
    <div class="right">
        <h3>Employer</h3>
        <form method="post" action="../controllers/Login.controller.php">
            <p>Username</p>
            <input type="text" name="e-username">
            <p>Password</p>
            <input type="password" name="e-password">
            <input type="submit" name="employer">
        </form>
        <a href="../controllers/EmployerRegister.controller.php">
            <button>Sign Up</button>
        </a>
    </div>
</div>
<div align="center">
    <?php
    if (!empty($errors)) {
        errorMassages($errors);
    } elseif (isset($_POST["employer"]) || isset($_POST["jobseeker"])) {
        echo "<p style='color: green; font-size: large'>Your Massage is sent successfully</p>";
    }
    ?>
</div>

</body>
</html>