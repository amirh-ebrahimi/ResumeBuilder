<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/forms.css">
    <title>Jobseeker Log in</title>
</head>
<body>
<form method="post" action="../controllers/JobseekerRegister.controller.php">

    <fieldset>
        <legend>Hello Jobseeker</legend>
        <h3>Profile</h3>
        <div class="clearfix">
            <div class="part-1">
                <label>Username*</label>
                <input type="text" name="username">
            </div>
            <div class="part-2">
                <label>Password*</label>
                <input type="password" name="password">
            </div>
        </div>
        <hr>
        <h3>Personal Information</h3>
        <div class="personal clearfix">
            <div class="part-1 ">
                <label>Name*</label>
                <input type="text" name="name">
                <label>Family*</label>
                <input type="text" name="family">
                <label>Nationality*</label>
                <input type="text" name="nationality">
                <label>Gender*</label>
                <select name="gender">
                    <option value="default">Choose your gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="part-2 ">
                <label>Birth Date*</label>
                <input type="date" name="birth-date">
                <label>Birth Place*</label>
                <input type="text" placeholder="Birth Place*" name="birth-place">
                <label>Phone*</label>
                <input type="number" placeholder="Phone*" name="phone">
                <label>Email*</label>
                <input type="email" placeholder="Email*" name="email">
            </div>
        </div>
        <hr>
        <h3>Education</h3>
        <div class="education clearfix">
            <div class="part-1">
                <p>Last Degree*</p>
                <select name="last-degree">
                    <option value="default">Last Degree</option>
                    <option value="high-school">High School</option>
                    <option value="bachelor">Bachelor</option>
                    <option value="master">Master</option>
                    <option value="PhD">PhD</option>
                </select>
            </div>
            <div class="part-2">
                <p>GPA*</p>
                <input type="text" name="gpa">
            </div>
        </div>
        <hr>
        <h3>Work Experiences</h3>
        <div class="jobs clearfix">
            <div class="first">
                <p>Job Title</p>
                <input type="text" name="job1-title">
                <p>From</p>
                <input type="date" name="job1-start">
                <p>To</p>
                <input type="date" name="job1-end">
                <p>Reason of departure</p>
                <input type="text" name="job1-reason">
            </div>
            <div class="second">
                <p>Job Title</p>
                <input type="text" name="job2-title">
                <p>From</p>
                <input type="date" name="job2-start">
                <p>To</p>
                <input type="date" name="job2-end">
                <p>Reason of departure</p>
                <input type="text" name="job2-reason">
            </div>
            <div class="third">
                <p>Job Title</p>
                <input type="text" name="job3-title">
                <p>From</p>
                <input type="date" name="job3-start">
                <p>To</p>
                <input type="date" name="job3-end">
                <p>Reason of departure</p>
                <input type="text" name="job3-reason">
            </div>
        </div>
        <hr>
        <h3>Background</h3>
        <textarea name="details" placeholder="Describe yourself a little bit..."></textarea>
        <hr>
        <h3>Skills</h3>
        <p>Write down your 3 skills and separate them with ","</p>
        <input type="text" name="skills" placeholder="Skills*">
        <hr>
        <h3>Interests</h3>
        <p>Write down your 3 interests and separate them with ","</p>
        <input type="text" name="interests" placeholder="Interests">
        <hr>
        <p>Enter the captcha</p>
        <img src="captcha.png" alt="CAPTCHA">
        <input type="text" name="captcha" pattern="[A-Z]{5,}" class="captcha">
        <input type="submit" name="jobseeker">
    </fieldset>
</form>
<div align="center">
    <?php
    if (!empty($errors)) {
        errorMassages($errors);
    } elseif (isset($_POST["jobseeker"])) {
        echo "<p style='color: green; font-size: large'>Your Massage is sent successfully</p>";
    }
    ?>
</div>
</body>
</html>