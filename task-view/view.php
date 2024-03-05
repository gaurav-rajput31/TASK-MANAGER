<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task View</title>

<style>
  html{
     margin: 0;
    padding: 0;
  }
  body {
    font-family: Arial, sans-serif;
    background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/652/confectionary.png);
   
  }

  .container {
                       background: linear-gradient(to bottom, #D5DEE7 0%, #E8EBF2 50%, #E2E7ED 100%), linear-gradient(to bottom, rgba(0,0,0,0.02) 50%, rgba(255,255,255,0.02) 61%, rgba(0,0,0,0.02) 73%), linear-gradient(33deg, rgba(255,255,255,0.20) 0%, rgba(0,0,0,0.20) 100%);
                     background-blend-mode: normal,color-burn;
                     box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px; 
    max-width: 800px;
    margin: 7rem auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h1 {
    color: #21117a;
    margin-bottom: 20px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
  }

  p {
    color: #555;
    padding: 1rem;
    line-height: 1.6;
  }

  strong {
    color: #21117a;
  }

  a {
    color: #007bff;
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
  }

  .attachment {
    margin-top: 10px;
  }

  .attachment a {
    display: inline-block;
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
  }

  .attachment a:hover {
    background-color: #0056b3;
    text-decoration: none;
  }

  .btn{
            background-color: #21117a;
            text-transform: uppercase;
            color: #fff;
            font-weight: 700;
            letter-spacing: .1rem;
            padding: .8rem;
            border-radius: .4rem;
        }

        .btn:hover{
          text-decoration: none;
        }

        .box {

   border-radius: 1rem;
    border: .2rem solid #b4c4d6;
    position: relative;
    animation: moveBorder 4s infinite linear;
  }

  @keyframes moveBorder {
    0% {
      border-top-color: #b4c4d6;
      border-right-color: #468791;
      border-bottom-color: #a3ba91;
      border-left-color: #b4c4d6;
    }
    25% {
      border-top-color: #a3ba91;
    }
    50% {
      border-right-color: #a3ba91;
    }
    75% {
      border-bottom-color: #696969;
    }
    100% {
      border-left-color: #a3ba91;
    }
  }

   nav{
            margin: 0;

            padding: 0;
            background: linear-gradient(to bottom, #D5DEE7 0%, #E8EBF2 50%, #E2E7ED 100%), linear-gradient(to bottom, rgba(0,0,0,0.02) 50%, rgba(255,255,255,0.02) 61%, rgba(0,0,0,0.02) 73%), linear-gradient(33deg, rgba(255,255,255,0.20) 0%, rgba(0,0,0,0.20) 100%);
 background-blend-mode: normal,color-burn;
 box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
 position: sticky;
 width: 100%;
 z-index: 1;
 height: 3rem;
 overflow-x: hidden;
        }

        nav i{
            font-size: 2.5rem;
            position: relative;
          
            left: 3rem; 
            color: #21117a;       }




</style>
</head>
<body>

   <nav><div><a href="../dashboard-page/dashboard.php"><i class="fa-solid fa-house"></a></div></i></nav>




<?php
  $task = array(
    'title' => 'Complete Project Proposal',
    'description' => 'Write and finalize the project proposal document.',
    'deadline' => '2024-03-10',
    'attachment' => 'project_proposal.docx',
    'level' => 'High'
);
?>

<div class="container box">
  <h1><?php echo $task['title']; ?></h1>
  <p><strong>Description:</strong> <?php echo $task['description']; ?></p>
  <p><strong>Deadline:</strong> <?php echo $task['deadline']; ?></p>
  <p><strong>Attachment:</strong> <a href="<?php echo $task['attachment']; ?>"><?php echo $task['attachment']; ?></a></p>
  <p><strong>Level:</strong> <?php echo $task['level']; ?></p>
   <a class="btn" href="edit_task.php?id=<?php echo $row['S_number']; ?>">Edit</a> 
                    <a class="btn" href="delete_task.php?id=<?php echo $row['S_number']; ?>">Delete</a> 
                    <a class="btn" href="add_task.php">Add Task</a>
</div>


<!-- font awesome link -->
    <script src="https://kit.fontawesome.com/5a1798d707.js" crossorigin="anonymous"></script>

</body>
</html>
