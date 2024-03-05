<?php
        // Include config file
        require_once "../config/config.php";

        // Define variables and initialize with empty values
        $username = $password = $confirm_password = "";
        $username_err = $password_err = $confirm_password_err = "";

        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            // Validate username
            if(empty(trim($_POST["username"]))){
                $username_err = "Please enter a username.";
            } else{
                // Prepare a select statement
                $sql = "SELECT id FROM login WHERE username = ?";

                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);

                    // Set parameters
                    $param_username = trim($_POST["username"]);

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);

                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $username_err = "This username is already taken.";
                        } else{
                            $username = trim($_POST["username"]);
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }

            // Validate password
            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter a password.";
            } elseif(strlen(trim($_POST["password"])) < 6){
                $password_err = "Password must have atleast 6 characters.";
            } else{
                $password = trim($_POST["password"]);
            }

            // Validate confirm password
            if(empty(trim($_POST["confirm_password"]))){
                $confirm_password_err = "Please enter confirm password.";
            } else{
                $confirm_password = trim($_POST["confirm_password"]);
                if(empty($password_err) && ($password != $confirm_password)){
                    $confirm_password_err = "Password did not match.";
                }
            }

            // Check input errors before inserting in database
            if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

                // Prepare an insert statement
                $sql = "INSERT INTO login ( username, password) VALUES (?, ?)";

                if($stmt = mysqli_prepare($link, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

                    // Set parameters
                    $param_username = $username;
                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        // Redirect to login page
                        header("location: ../index.php");
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
    <title>Sign Up</title>
    <style>
        body{
             background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/652/confectionary.png);
        font: 14px sans-serif;
            /* background-image: radial-gradient(73% 147%, #EADFDF 59%, #ECE2DF 100%), radial-gradient(91% 146%, rgba(255,255,255,0.50) 47%, rgba(0,0,0,0.50) 100%);
 background-blend-mode: screen;*/ }
        .wrapper{ padding: 20px;
           width: 39rem;
        padding: 2rem;
        position: relative;
        left: 50%;
        
        top: 50%;
        transform: translate(-50%, +30%);
          background: linear-gradient(to bottom, #D5DEE7 0%, #E8EBF2 50%, #E2E7ED 100%), linear-gradient(to bottom, rgba(0,0,0,0.02) 50%, rgba(255,255,255,0.02) 61%, rgba(0,0,0,0.02) 73%), linear-gradient(33deg, rgba(255,255,255,0.20) 0%, rgba(0,0,0,0.20) 100%);
 background-blend-mode: normal,color-burn;
 box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
          border-radius: 3rem;
          display: flex;
          align-items: center;
          justify-content: center;}

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
            font-weight: 500;
            margin: 1rem 0;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;

         }
         .btn-primary{
            color: #787878;
            border: none;
           font-weight: 700;
            border-radius: 1rem;
           box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
         }

         .wrapper span{
            font-weight: 500;
            color: crimson;
            font-size: 1.4rem;
         }


header{
    background-color: red;
}

    </style>
</head>
<body>
 <header><div><i class="fa-solid fa-house"></div></i></header>

    <div class="wrapper">
        <h2>Sign&nbsp;Up</h2>
        <!-- <p>Please fill this form to create an account.</p> -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
                <!-- <label>Username</label> -->
                <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div <?php echo "(!empty($password_err)) ? 'has-error' : '';" ?>>
                <!-- <label>Password</label> -->
                <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                <!-- <label>Confirm Password</label> -->
                <input type="password" name="confirm_password" class="form-control" placeholder="confirm_password" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default btn-primary" value="Reset">
            </div>
            <p>Already have an account? <a href="../index.php">Login here</a>.</p>
        </form>
    </div>  


    <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/5a1798d707.js" crossorigin="anonymous"></script>
      
</body>


</html>
