<?php
session_start();
include ('php/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickFix - Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-ZvHjXoebDRUrTnKh9WKpWV/A0Amd+fjub5TkBXrPxe5F7WfDZL0slJ6a0mvg7VSN3qdpgqq2y1blz06Q8W2Y8A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="form-box">
            <?php
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email = '$email'");
                if(mysqli_num_rows($verify_query) != 0){
                    echo "<div class='message'>
                        <p>This email is already in use. Please try another!</p>
                    </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                }else{
                    mysqli_query($con, "INSERT INTO users (Username, Email, Password) VALUES('$username', '$email', '$password')") or die("Error Occurred");
                
                    echo "<div class='message'>
                        <p>Registration Successful!</p>
                    </div><br>";
                    echo "<a href='login.php'><button class='btn'>Login Now</button></a>";
                }
            }else{
            ?>
            <header>Sign Up for QuickFix</header>
            <form action="" method="post">
                <div class="field input">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label>Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" placeholder="Email" required>
                </div>

                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>

                <div class="field input">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                </div>

                <div class="input-box">
                    <input type="submit" name="submit" value="Register">
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In now</a>
                </div>
                <div class="back-link">
                    <a href="index.php"><i class="fas fa-arrow-left"></i> Back to Home</a>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>

    <script>
        // Password confirmation validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        const submitBtn = document.querySelector('input[type="submit"]');
        
        function validatePassword() {
            if(password.value != confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords don't match");
            } else {
                confirmPassword.setCustomValidity('');
            }
        }
        
        if(password && confirmPassword) {
            password.onchange = validatePassword;
            confirmPassword.onkeyup = validatePassword;
        }
    </script>
</body>
</html>