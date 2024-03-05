<?php
// Include database configuration
     include "../config/config.php";

// Define variables to store form data
$taskName = $description = $deadline = $level = $attachment = "";
// Define variables to store error messages
$taskName_err = $description_err = $level_err = $attachment_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate task name
    if (isset($_POST["taskName"]) && !empty(trim($_POST["taskName"]))) {
        $taskName = trim($_POST["taskName"]);
    } else {
        $taskName_err = "Please enter a task name.";
    }

    // Validate description
    if (isset($_POST["description"]) && !empty(trim($_POST["description"]))) {
        $description = trim($_POST["description"]);
    } else {
        $description_err = "Please enter a description.";
    }

    // Validate level
    if (isset($_POST["level"]) && !empty(trim($_POST["level"]))) {
        $level = trim($_POST["level"]);
    }else {
        $level_err = "Please select a level.";
    }

   

    // If no errors, insert data into database
    if (empty($taskName_err) && empty($description_err) && empty($level_err)) {
        
        $sql = "INSERT INTO submit (taskName, description, level, attachment, deadline) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
           
            mysqli_stmt_bind_param($stmt, "sssbi", $param_taskName, $param_description, $param_level, $param_attachment, $param_deadline);

           
            $param_taskName = $taskName;
            $param_description = $description;
            $param_level = $level;
            $param_attachment = $attachment;
            $param_deadline = $deadline;

          
            if (mysqli_stmt_execute($stmt)) {
              
                echo "Data inserted successfully.";
                header("location: ../dashboard-page/dashboard.php");
                exit; // Terminate script execution after redirection
            } else {
                echo "Something went wrong. Please try again later.";
            }
        } else {
            echo "Error: " . mysqli_error($link);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Close connection
mysqli_close($link);
?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <style type="text/css">
        body{
            background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/652/confectionary.png);

        }

        .main-div{
                  position: relative;
                   background: linear-gradient(to bottom, #D5DEE7 0%, #E8EBF2 50%, #E2E7ED 100%), linear-gradient(to bottom, rgba(0,0,0,0.02) 50%, rgba(255,255,255,0.02) 61%, rgba(0,0,0,0.02) 73%), linear-gradient(33deg, rgba(255,255,255,0.20) 0%, rgba(0,0,0,0.20) 100%);
                     background-blend-mode: normal,color-burn;
                     box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px; 
                     max-width: 30rem;
                     left: 50%;
                     top: 50%;
                     transform: translate(-50%, 16%);
                     border-radius: 1rem;
                     padding: 2rem;
        }
        .main-div h2{
            font-size: 2rem;
            text-transform: uppercase;
            color: #21117a;
            font-weight: 900;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
           justify-content: center;

        }

        .main-div label{
            font-size: 1.2rem;
            text-transform: capitalize;
            color: #21117a;

        }

        .main-div input, textarea{
            padding: .5rem;
            width: 100%;
            background: transparent;
            border: .1rem solid #11117a;
            border-radius: 1rem;
            margin: .5rem 0;
            font-size: 1rem;
            color: black;
        }

        option{
            background: transparent;
        }

        #btn{
            background-color: #21117a;
            text-transform: uppercase;
            color: #fff;
            font-weight: 700;
            letter-spacing: .1rem;
        }

        header{
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #D5DEE7 0%, #E8EBF2 50%, #E2E7ED 100%), linear-gradient(to bottom, rgba(0,0,0,0.02) 50%, rgba(255,255,255,0.02) 61%, rgba(0,0,0,0.02) 73%), linear-gradient(33deg, rgba(255,255,255,0.20) 0%, rgba(0,0,0,0.20) 100%);
 background-blend-mode: normal,color-burn;
 box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
 position: fixed;
 width: 100%;
 z-index: 1;
 height: 3rem;
        }

        header i{
            font-size: 2.5rem;
            position: relative;
          
            left: 3rem; 
            color: #21117a;       }


    </style>
</head>
<body>

     <header><div><a href="../dashboard-page/dashboard.php"><i class="fa-solid fa-house"></a></div></i></header>

    <div class="main-div">
    <h2>Submit Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name" >Title:-</label><br>
        <input type="text" id="name" name="taskName"  placeholder="Enter Task Name...." required>
        <span> <?php echo $taskName_err ?></span><br>
        <label for="desc" >Description:-</label><br>
        <textarea id="desc"  name="description" placeholder="Enter task details here..." rows="4" cols="50"></textarea><br>
        
        <label for="date">Deadline:-</label><br>
        <input type="date" id="date" name="deadline" placeholder="Enter Deadline date....."><br>
        <label for="level">Level:-</label><br>
        <select id="level" name="level">
            <option>Easy Level</option>
            <option>Intermediate Level</option>
            <option>Hard Level</option>
        </select><br>
        <label for="attachment">Attachment</label><br>
        <input type="file" id="attachment" name="attachment"><br>
        <br>
        <input type="submit" id="btn" value="Submit">
        <input type="reset" id="btn" value="Reset">
    </form>
</div>



  <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/5a1798d707.js" crossorigin="anonymous"></script>

</body>
</html>
