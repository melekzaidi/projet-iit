<?php
require_once('classes/user.php');
require_once("classes/config.php");
$user = new User();



// Signup Logic
if (isset($_POST["signup"])) {
    $username = $_POST['signupusername'];
    $password = $_POST['signuppassword'];
    $email = $_POST['signupemail'];

    try {
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setEmail($email);

        $user->insert_user();
        $_SESSION["success"]="Signup succeded";
        header('location: success.php'); // Redirect to error page

    } catch (Exception $ex) {
        $_SESSION["error"] = $ex->getMessage();
        header('location: error.php'); // Redirect to error page
       
    }
}

// Login Logic
if (isset($_POST["login"])) {
    $loginUsername = $_POST['loginusername'];
    $loginPassword = $_POST['loginpassword'];
    $user->setUsername($loginUsername);
    
    $user->setPassword($loginPassword); // Assuming setPassword method exists to set password
    try {
        $users = $user->select_user();
        if (count($users) == 0) {
            throw new Exception('Login failed');
        } else {
            if($loginUsername === 'admin') {
                $_SESSION['login'] = 'loginadmin';
            } else {
                $_SESSION['login'] = 'loginuser';
            }
            $_SESSION['username'] = $loginUsername;
            header('Location: storeshop.php');
            exit(); // Always exit after redirection
        }
    } catch (Exception $ex) {
        $_SESSION["error"] = $ex->getMessage();
        header('Location: error.php'); // Redirect to error page
        exit(); // Always exit after redirection
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login & Signup Form</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<section class="wrapper active">
<div class="form login">
        <header>Login</header>
        <form action="#" method="post">
            <input type="text" name="loginusername" placeholder="Username" required/>
            <input type="password" name="loginpassword" placeholder="Password" required/>
            <a href="#">Forgot password?</a>
            <input type="submit" name="login" value="Login"/>
        </form>
    </div>
    <div class="form signup">
        <header >Signup</header>
        <form action="#" method="post">
            <input type="text" name="signupusername" placeholder="Full name" required/>
            <input type="text" name="signupemail" placeholder="Email address" required/>
            <input type="password" name="signuppassword" placeholder="Password" required/>
            <div class="checkbox">
                <input type="checkbox" id="signupCheck"/>
                <label for="signupCheck">I accept all terms & conditions</label>
            </div>
            <input name="signup" type="submit" value="Signup"/>
        </form>
    </div>

    

    <script>
        const wrapper = document.querySelector(".wrapper"),
            signupHeader = document.querySelector(".signup header"),
            loginHeader = document.querySelector(".login header");

        loginHeader.addEventListener("click", () => {
            wrapper.classList.add("active");
        });
        signupHeader.addEventListener("click", () => {
            wrapper.classList.remove("active");
        });
    </script>
</section>
</body>
</html>
