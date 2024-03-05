<?php
// Include database configuration
include '../config/config.php'; 

// Check if ID parameter is provided in the URL
if(isset($_GET['id'])) {
    // Retrieve task ID from URL parameter
    $id = $_GET['id'];
    
    // Check if form is submitted
    if(isset($_POST['submit'])) {
        // Retrieve form data
        $taskName = $_POST['taskName'];
        $description = $_POST['description'];
        $deadline = $_POST['deadline'];
        $attachment = $_POST['attachment'];
        $level = $_POST['level'];
        
        // Update task in the database
        $sql = "UPDATE submit SET taskName='$taskName', description='$description', deadline='$deadline', attachment='$attachment', level='$level' WHERE S_number=$id";
        $result = mysqli_query($link, $sql);
        
        if($result) {
            echo "Task updated successfully.";
            header("location: ../dashboard-page/dashboard.php");
        } else {
            echo "Error updating task: " . mysqli_error($link);
        }
    }
    
    // Retrieve task details from the database
    $sql = "SELECT * FROM submit WHERE S_number=$id";
    $result = mysqli_query($link, $sql);
    
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $taskName = $row['taskName'];
        $description = $row['description'];
        $deadline = $row['deadline'];
        $attachment = $row['attachment'];
        $level = $row['level'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style type="text/css">
        html{
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        body{
            width: 100%;
            height: 100%;
            box-sizing: border-box;
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
        .main-div h1{
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
            width: 99%;
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
            
            background: linear-gradient(to bottom, #D5DEE7 0%, #E8EBF2 50%, #E2E7ED 100%), linear-gradient(to bottom, rgba(0,0,0,0.02) 50%, rgba(255,255,255,0.02) 61%, rgba(0,0,0,0.02) 73%), linear-gradient(33deg, rgba(255,255,255,0.20) 0%, rgba(0,0,0,0.20) 100%);
 background-blend-mode: normal,color-burn;
 box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
 position: fixed;
 width: 100%;
 z-index: 1;
 height: 3rem;
 overflow-x: hidden;
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

    <div id="main-div" class="main-div">
    <h1>Edit Task</h1>
    <form method="post" action="">
        <label for="taskName">Task Name:</label><br>
        <input type="text" id="taskName" name="taskName" value="<?php echo $taskName; ?>"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $description; ?></textarea><br>
        <label for="deadline">Deadline:</label><br>
        <input type="date" id="deadline" name="deadline" value="<?php echo $deadline; ?>"><br>
        <label for="attachment">Attachment:</label><br>
        <input type="text" id="attachment" name="attachment" value="<?php echo $attachment; ?>"><br>
        <label for="level">Level:</label><br>
        <input type="text" id="level" name="level" value="<?php echo $level; ?>"><br><br>
        <input type="submit" name="submit" class="btn" id="btn" value="Update Task">
    </form>
</div>

<!-- font awesome link -->
    <script src="https://kit.fontawesome.com/5a1798d707.js" crossorigin="anonymous"></script>
</body>
</html>
<?php
    } else {
        echo "Task not found.";
    }
} else {
    echo "Task ID not provided.";
}
?>
