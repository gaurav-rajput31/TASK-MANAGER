<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Task View</title>

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
  }

  .container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h1 {
    color: #333;
    margin-bottom: 20px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
  }

  p {
    color: #555;
    line-height: 1.6;
  }

  strong {
    color: #007bff;
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
  }
</style>
</head>
<body>

<?php
// Sample task data
$task = array(
    'title' => 'Complete Project Proposal',
    'description' => 'Write and finalize the project proposal document.',
    'deadline' => '2024-03-10',
    'attachment' => 'project_proposal.docx',
    'level' => 'High'
);
?>

<div class="container">
  <h1><?php echo $task['title']; ?></h1>
  <p><strong>Description:</strong> <?php echo $task['description']; ?></p>
  <p><strong>Deadline:</strong> <?php echo $task['deadline']; ?></p>
  <p><strong>Attachment:</strong> <a href="<?php echo $task['attachment']; ?>"><?php echo $task['attachment']; ?></a></p>
  <p><strong>Level:</strong> <?php echo $task['level']; ?></p>
</div>

</body>
</html>
