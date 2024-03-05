
<?php
// Include database configuration
include '../config/config.php'; 





// SQL query to select all columns from the submit table
$sql = "SELECT * FROM submit";

// Execute the query
$result = mysqli_query($link, $sql);

// Check if the query was successful
if ($result) {
    // Fetch associative array
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    // Count the number of rows in the array
    $totalTasks = count($rows);


    while ($row = mysqli_fetch_assoc($result)) {
      $formatted_date = date("d/m/Y", strtotime($row['date_column']));
      
  }












    
    
    // Loop through each task
    foreach ($rows as $row) {
        $S_number = $row['S_number'];
        $taskName = $row['taskName']; 
        $description = $row['description'];
        $level = $row['level'];
        $deadline = $row['deadline'];
        $attachment = $row['attachment'];
        $totalTask = $row['S_number'];
        
        // Display task information or perform other operations
        //echo "S_number: $S_number <br>";
       // echo "Task Name: $taskName <br>";
        //echo "Description: $description <br>";
       // echo "Level: $level <br>";
        //echo "Deadline: $deadline <br>";
        //echo "Attachment: $attachment <br><br>";
    }
} else {
    // Error message if the query fails
    echo "Error: " . mysqli_error($link);
}

// Function to edit a task
function editTask($S_number, $taskName, $description, $deadline, $attachment, $level) {
    global $link;
    $sql = "UPDATE submit SET taskName='$taskName', description='$description', deadline='$deadline', attachment='$attachment', level='$level' WHERE S_number=$S_number";
    if (mysqli_query($link, $sql)) {
        return "Task updated successfully";
    } else {
        return "Error updating task: " . mysqli_error($link);
    }
}

// Function to delete a task
function deleteTask($S_number) {
    global $link;
    $sql = "DELETE FROM submit WHERE S_number=$S_number";
    if (mysqli_query($link, $sql)) {
        return "Task deleted successfully";
    } else {
        return "Error deleting task: " . mysqli_error($link);
    }
}

// Function to mark a task as completed
function markTaskCompleted($S_number) {
    global $link;
    $sql = "UPDATE submit SET completed=1 WHERE S_number=$S_number";
    if (mysqli_query($link, $sql)) {
        return "Task marked as completed";
    } else {
        return "Error marking task as completed: " . mysqli_error($link);
    }
}

// Close database connection
mysqli_close($link);
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager Dashboard</title>


    <!-- bootstrap cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="style.css">


    
</head>
<body>

<section>
    <div class="container-fluid">
        <div class="row">
                <header id="header">
                    <div class="top-header">
                        <span class="top-head">Task Manager Dashboard</span>
                        <span id="profile" class=" "><a  href="../profile/user-profile.php"><i class="fa-regular fa-circle-user"></i></i></a></span>
                       
                    </div>
                </header>
        </div>
    </div>            
</section>                


<section class="data">
    <div class="container-fluid">
        <div class="row">
                    <main>
                      <div class="left-side">
            <?php
            
                $completeTask = 100; 
                $pendingTask = 1;
                 ?>




                                     <div class="main-task-div row" id="main-task-div">
                                    <div class="total-task task box col-3">
                                      <h2>TOTAL TASK</h2>
                                      <p><?php echo $totalTask ?></p>
                                    </div>
                                    <div class="complete-task task box col-3">
                                        <h2>COMPLETE TASK</h2>
                                        <p><?php echo $completeTask ?></p>

                                    </div>
                                    <div class="pandding-task task box col-3">
                                        <h2>PENDING TASK</h2>
                                        <p><?php echo $pendingTask ?></p>
                                    </div>
                                </div>


                                <div id="myDiv" class="add-task box ">
                                   
                                <h1>Add Your Task</h1>
                                <a href="../submit-task/submit.php">
                                <div class=" add-task-logo">
                                    <h2><i class="fa-solid fa-plus"></i></h2>
                                    <span>Add New Task</span>
                                </div></a>
                            


                                </div>

                            <div class="first-task box">
                               


                                              <h1>Your Last Task Here</h1>
                                             <p> Task Name:-     
                                              <label><?php echo $taskName ?></label></p>
                                           <p>   Description:-
                                              <label><?php echo $description ?></label></p>
                            
                                              <p>Level:-    
                                              <label><?php echo $level ?></label></p>
                                              <p>Deadline:-
                                             <label><?php echo  $GLOBALS["date_only"]; ?></label></p>
                                             <p>Attachment:-
                                             <label><?php echo $attachment; ?></label></p>
                                             <p><a href="#">Edit</a>&nbsp;
                                                <a href="#">Delete</a>&nbsp;
                                                <a href="#">Mark</a>


                              
                          

                            </div>
                        </div>



                        <div class="side-container sidebar box">
                            <div class="top-side-header sidebar-heading">
                                <h1>THIS IS SIDEBAR</h1>
                                <nav class="navbar navbar-light   justify-content-end">
                                
                                  <form class="form-inline"> <input
                                  class=" mr-sm-2" type="search" id="searchInput" onkeyup="searchTable()"
                                  placeholder="Search here" aria-label="Search">
                                  <button class="btn btn-outline-success my-2
                                  my-sm-0" type="submit">Search</button>
                                  </form> </nav> </div>

                          <div class="sticky sidebar-content">  

                             <table class="table table-striped table-hover" id="taskTable">
                                  <thead>
                                    <tr class="table-primary">
                                      <th scope="col">Id</th>
                                      <th scope="col">Task Name</th>
                                      <th scope="col">Mark As</th>
                                      <th scope="col">Edit Task</th>
                                      <th scope="col">Delete Task</th>
                                      <th scope="col">View Task</th>
                                      <th scope="col">Create Date</th>
                                    </tr>
                                  </thead>
                          <tbody>
                            <?php
                             foreach($rows as $row) {
                                    echo "<tr>";
                                    echo "<td>".$row['S_number']."</td>";
                                    echo "<td>".$row['taskName']."</td>";
                                    echo "<td><a href='../mark/mark.php?id=".$row['S_number']."'>Mark</a></td>";
                                    echo "<td><a href='../edit/edit.php?id=".$row['S_number']."'>Edit</a></td>";
                                    echo "<td><a href='../delete/delete.php?id=".$row['S_number']."'>Delete</a></td>";
                                    echo "<td><a href='../task-view/view.php?id=".$row['S_number']."'>View</a></td>"; 
                                   echo "<td>".($row['deadline'] ?? 'N/A')."</td>";

                                    echo "</tr>";
                                }

                                ?>   
                          </tbody>
  

                                </table>


                            </div> 
                             

                            
                        </div>
                    </main>
        </div>
    </div>
</section>   




<script>
        function searchTable() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("taskTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Index 1 is for the Task Name column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>








    <script type="text/javascript">
        window.addEventListener('scroll', function() {
              var header = document.getElementById('header');
              
              
              if (window.pageYOffset > 0) {
                header.classList.add('fixed');
                
              } else {
                header.classList.remove('fixed');
              }
            });

    </script>
  

  <!-- font awesome link -->
    <script src="https://kit.fontawesome.com/5a1798d707.js" crossorigin="anonymous"></script>
    
  
   <!-- bootsrap js cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    

</body>
</html>
