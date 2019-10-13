<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/employer_signup.css">
    <title>Employer Registration</title>
</head>
<body>

<form method="post" action="../controllers/EmployerRegister.controller.php">

    <fieldset>
        <legend>Hello Employer</legend>

        <div class="form">
        <div class="profile" style="width: 100%">
            <div class="username" style="width: 40%">
                <p>Username*</p>
                <input name="username" type="text">
            </div>
            <div class="password" style="width: 50%">
                <p>Password*</p>
                <input type="password" name="password">
            </div>
        </div>

        <p>Company Name*</p>
        <input type="text" name="company">
        <p>Phone*</p>
        <input type="number" name="phone">
        <p>Area of Work*</p>
        <input type="text" name="area">
        <p>City*</p>
        <input type="text" name="city">
        <input type="submit" name = "employer">
        </div>
    </fieldset>

</form>

<div align="center">
    <?php
    if (!empty($errors)) {
        errorMassages($errors);
    } elseif (isset($_POST["employer"])) {
        echo "<p style='color: green; font-size: large'>Your Massage is sent successfully</p>";
    }
    ?>
</div>

</body>
</html>