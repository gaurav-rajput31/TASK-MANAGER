<?php
// Start session
session_start();

// Check if user is already logged in, if yes, redirect to dashboard
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: dashboard.php");
//     exit;
// }

// Include config file
require_once "config/config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM login WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to dashboard page
                            header("location: dashboard-page/dashboard.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body{
         font: 14px sans-serif;
          background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/652/confectionary.png);
             /*background-image: radial-gradient(73% 147%, #EADFDF 59%, #ECE2DF 100%), radial-gradient(91% 146%, rgba(255,255,255,0.50) 47%, rgba(0,0,0,0.50) 100%);
 background-blend-mode: screen;*/ }
        .wrapper{ padding: 20px;
           width: 36rem;
        padding: 2rem;
        position: relative;
        left: 50%;
        
        top: 50%;
        transform: translate(-50%, +50%);
           background: linear-gradient(to bottom, #D5DEE7 0%, #E8EBF2 50%, #E2E7ED 100%), linear-gradient(to bottom, rgba(0,0,0,0.02) 50%, rgba(255,255,255,0.02) 61%, rgba(0,0,0,0.02) 73%), linear-gradient(33deg, rgba(255,255,255,0.20) 0%, rgba(0,0,0,0.20) 100%);
 background-blend-mode: normal,color-burn;
 box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
          border-radius: 3rem;
          display: flex;
          align-items: center;
          justify-content: center;
         }
         .wrapper h2{
            padding: 4rem;
            padding-left: 3rem;
            font-size: 3rem;
            color: #787878;
         }
         .wrapper form{
                  padding: 2rem;
                  padding-left: 1rem;
                  position: relative;
                  left: 1rem;
                  color: #787878;
                  font-size: 1.6rem;
                  font-weight: 800;
         }
         a, p{
            font-size: 1rem;
            text-decoration: none;
            font-weight: 500;
            

         }
         input{
            padding: .6rem;
            border: none;
            background-color: transparent;
            border-radius: .5rem;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 1rem 0;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;

         }
         .btn-primary{
            color: #787878;
            border: none;
            position: relative;
            left: 30%;
            border-radius: 1rem;
           box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
         }

          .wrapper span{
            font-weight: 500;
            color: crimson;
            font-size: 1.4rem;
         }

    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <!-- <p>Please fill in you to login.</p> -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
                <!-- <label>Username</label> -->
                <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
                <!-- <label>Password</label> -->
                <input type="password" name="password" placeholder="Password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div <?php echo (!empty($login_err)) ? 'has-error' : ''; ?>>
                <span class="help-block"><?php echo $login_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register/register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>
