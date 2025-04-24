<?php   
  session_start();   
  include('php/config.php');
      
  // If user is already logged in, redirect to dashboard 
  if (isset($_SESSION["valid"])) {     
      header("Location: dashboard.php");     
      exit; 
  } 
?>    

<!DOCTYPE html> 
<html lang="en"> 
<head>     
    <meta charset="UTF-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <title>QuickFix - Login</title>     
    <link rel="stylesheet" href="style.css">     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-ZvHjXoebDRUrTnKh9WKpWV/A0Amd+fjub5TkBXrPxe5F7WfDZL0slJ6a0mvg7VSN3qdpgqq2y1blz06Q8W2Y8A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
</head> 
<body>     
    <div class="container">         
        <div class="form-box">             
            <?php             
            if (isset($_POST['submit'])) {                 
                $email = mysqli_real_escape_string($con, $_POST['email']);                 
                $password = mysqli_real_escape_string($con, $_POST['password']);
                
                // Query to get the user                 
                $result = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'") or die("Error Occurred: " . mysqli_error($con));                 
                $row = mysqli_fetch_assoc($result);
                                 
                // Verify user exists and password matches                 
                if (is_array($row) && !empty($row)) {                     
                    if ($password === $row['password']) {                         
                        // Store session variables                         
                        $_SESSION['valid'] = $row['email'];                         
                        $_SESSION['username'] = $row['username'];                         
                        $_SESSION['id'] = $row['id'];
                        
                        // Force session write before redirect
                        session_write_close();
                        
                        // Redirect to dashboard
                        header("Location: dashboard.php");
                        exit; // Important to prevent further execution                     
                    } else {                         
                        echo "<div class='message'>                             
                            <p>Wrong Username or Password</p>                         
                        </div> <br>";                         
                        echo "<a href='login.php'><button class='btn'>Go Back</button></a>";                     
                    }                 
                } else {                     
                    echo "<div class='message'>                         
                        <p>Wrong Username or Password</p>                     
                    </div> <br>";                     
                    echo "<a href='login.php'><button class='btn'>Go Back</button></a>";                 
                }             
            } else {             
            ?>             
            <header>Login to QuickFix</header>             
            <form action="" method="post">                 
                <div class="field input">                     
                    <label for="email">Email</label>                     
                    <input type="text" name="email" id="email" placeholder="Email" required>                 
                </div>                                  
                <div class="field input">                     
                    <label for="password">Password</label>                     
                    <input type="password" name="password" id="password" placeholder="Password" required>                 
                </div>                                  
                <div class="input-box">                     
                    <input type="submit" name="submit" value="Login">                 
                </div>                 
                <div class="links">                     
                    Don't have an account? <a href="register.php">Sign up now</a>                 
                </div>                 
                <div class="back-link">                     
                    <a href="index.php"><i class="fas fa-arrow-left"></i> Back to Home</a>                 
                </div>             
            </form>             
            <?php } ?>         
        </div>     
    </div> 
</body> 
</html>