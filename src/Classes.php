<?php
session_start();
global $filterquery;
$filterquery = "SELECT * FROM Classes WHERE ";

if (isset($_POST['create'])) 
{
  $connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

  $date = mysqli_real_escape_string($connection, $_POST['date']);
  $time = mysqli_real_escape_string($connection, $_POST['time']);
  $classroom = mysqli_real_escape_string($connection, $_POST['classroom']);
  $form = mysqli_real_escape_string($connection, $_POST['form']);
  $grpid = mysqli_real_escape_string($connection, $_POST['grpid']);
  $grpdepid = mysqli_real_escape_string($connection, $_POST['grpdepid']);
  $grpinstid = mysqli_real_escape_string($connection, $_POST['grpinstid']);
  $subid = mysqli_real_escape_string($connection, $_POST['subid']);
  $subdepid = mysqli_real_escape_string($connection, $_POST['subdepid']);
  $subinstid = mysqli_real_escape_string($connection, $_POST['subinstid']);

  $query = "INSERT INTO `Classes` (ClassDate, ClassTime, ClassRoom, ClassForm, GroupID, GroupDepartmentID, GroupInstituteID, SubjectID, SubjectDepartmentID, SubjectInstituteID) VALUES ('$date', NULLIF('$time', ''), '$classroom', '$form', '$grpid', '$grpdepid', '$grpinstid', '$subid', '$subdepid', '$subinstid')";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
}

if (isset($_POST['update'])) 
{
  $connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

  $id = mysqli_real_escape_string($connection, $_POST['id']);
    
  $date = mysqli_real_escape_string($connection, $_POST['date']);
  if ($date != NULL)
  {
    $query = "UPDATE `Classes` SET ClassDate='$date' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }

  $time = mysqli_real_escape_string($connection, $_POST['time']);
  if ($time != NULL)
  {
    $query = "UPDATE `Classes` SET ClassTime='$time' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $classroom = mysqli_real_escape_string($connection, $_POST['classroom']);
  if ($classroom != NULL)
  {
    $query = "UPDATE `Classes` SET ClassForm='$classroom' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $form = mysqli_real_escape_string($connection, $_POST['form']);
  if ($form != NULL)
  {
    $query = "UPDATE `Classes` SET ClassForm='$form' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $grpid = mysqli_real_escape_string($connection, $_POST['grpid']);
  if ($grpid != NULL)
  {
    $query = "UPDATE `Classes` SET GroupID='$grpid' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $grpdepid = mysqli_real_escape_string($connection, $_POST['grpdepid']);
  if ($grpdepid != NULL)
  {
    $query = "UPDATE `Classes` SET GroupDepartmentID='$grpdepid' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $grpinstid = mysqli_real_escape_string($connection, $_POST['grpinstid']);
  if ($grpinstid != NULL)
  {
    $query = "UPDATE `Classes` SET GroupInstituteID='$grpinstid' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $subid = mysqli_real_escape_string($connection, $_POST['subid']);
  if ($subid != NULL)
  {
    $query = "UPDATE `Classes` SET SubjectID='$subid' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $subdepid = mysqli_real_escape_string($connection, $_POST['subdepid']);
  if ($subdepid != NULL)
  {
    $query = "UPDATE `Classes` SET SubjectDepartmentID='$subdepid' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $subinstid = mysqli_real_escape_string($connection, $_POST['subinstid']);
  if ($subinstid != NULL)
  {
    $query = "UPDATE `Classes` SET SubjectInstituteID='$subinstid' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
}



?>

<!doctype html>
<html lang="ru" class="h-100">
<head>
  <!-- Meta tags -->
  <title>My DB App | Classes</title>
  <meta charset="utf-8">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- My CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex flex-column h-100">

<!-- Fixed navbar -->
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">My DB App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" href="Institutes.php">Institutes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Departments.php">Departments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="StudyGroups.php">Study Groups</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Subjects.php">Subjects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="Classes.php">Classes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Students.php">Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Teachers.php">Teachers</a>
          </li>
        </ul>
        <div class="text-end">
          <a class="btn btn-light me-2" href="signin.html">Sign in</a>
          <a class="btn btn-primary me-2" href="signup.html">Sign up</a>
          <a class="btn btn-danger" href="signout.php">Sign out</a>
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container" style="padding-top: 60px; padding-bottom: 60px">
    <h1 class="mt-5"><a href="Classes.php">Classes Table</a></h1>
    <table class="table table-hover table_sort">
    <thead>
      <tr>
      <th>ID</th>
      <th>Date</th>
      <th>Time</th>
      <th>Classroom</th>
      <th>Form</th>
      <th>Group ID</th>
      <th>Group Department ID</th>
      <th>Group Institute ID</th>
      <th>Subject ID</th>
      <th>Subject Department ID</th>
      <th>Subject Institute ID</th>
      <th></th>
      </tr>
    </thead>
    <tfoot>
    <tr>
      <form name="form" action="" method="POST">
        <td>...</td>
        <td><input class="input-group" type="text" name="date" id="Date" placeholder="Date"></td>
        <td><input class="input-group" type="text" name="time" id="Time" placeholder="Time"></td>
        <td><input class="input-group" type="number" name="classroom" id="Classroom" placeholder="Classroom"></td>
        <td><input class="input-group" type="number" name="form" id="Form" placeholder="Form"></td>
        <td><input class="input-group" type="number" name="grpid" id="GrpID" placeholder="Group ID"></td>
        <td><input class="input-group" type="number" name="grpdepid" id="GrpDepID" placeholder="Group Department ID"></td>
        <td><input class="input-group" type="number" name="grpinstid" id="GrpInstID" placeholder="Group Institute ID"></td>
        <td><input class="input-group" type="number" name="subid" id="SubID" placeholder="Subject ID"></td>
        <td><input class="input-group" type="number" name="subdepid" id="SubDepID" placeholder="Subject Department ID"></td>
        <td><input class="input-group" type="number" name="subinstid" id="SubInstID" placeholder="Subject Institute ID"></td>
        <!-- Confirm -->
        <td><input type="submit" name="create" value="Create" class='btn btn-outline-success w-100'></td>
      </form>
    </tr>
    <tr>
      <form name="form" action="" method="POST">
        <td><input class="input-group" type="number" name="id" id="id" placeholder="ID"></td>
        <td><input class="input-group" type="text" name="date" id="Date" placeholder="Date"></td>
        <td><input class="input-group" type="text" name="time" id="Time" placeholder="Time"></td>
        <td><input class="input-group" type="number" name="classroom" id="Classroom" placeholder="Classroom"></td>
        <td><input class="input-group" type="number" name="form" id="Form" placeholder="Form"></td>
        <td><input class="input-group" type="number" name="grpid" id="GrpID" placeholder="Group ID"></td>
        <td><input class="input-group" type="number" name="grpdepid" id="GrpDepID" placeholder="Group Department ID"></td>
        <td><input class="input-group" type="number" name="grpinstid" id="GrpInstID" placeholder="Group Institute ID"></td>
        <td><input class="input-group" type="number" name="subid" id="SubID" placeholder="Subject ID"></td>
        <td><input class="input-group" type="number" name="subdepid" id="SubDepID" placeholder="Subject Department ID"></td>
        <td><input class="input-group" type="number" name="subinstid" id="SubInstID" placeholder="Subject Institute ID"></td>
        <!-- Confirm -->
        <td><input type="submit" name="update" value="Update" class='btn btn-outline-primary w-100'></td>
      </form>
    </tr>
    </tfoot>
    <tbody>
    <?php
      $mysqli = new mysqli("appdb", "user", "password", "appDB");

      $result = $mysqli->query("SELECT * FROM Classes");
      if ($filterquery!="SELECT * FROM Classes WHERE ")
      {
        $result = $mysqli->query($filterquery);
      }

      foreach ($result as $row){
        echo "<tr class='align-middle'><td>{$row['id']}</td><td>{$row['ClassDate']}</td><td>{$row['ClassTime']}</td><td>{$row['ClassRoom']}</td><td>{$row['ClassForm']}</td><td>{$row['GroupID']}</td><td>{$row['GroupDepartmentID']}</td><td>{$row['GroupInstituteID']}</td><td>{$row['SubjectID']}</td><td>{$row['SubjectDepartmentID']}</td><td>{$row['SubjectInstituteID']}</td><td><a class='btn btn-outline-danger w-100' href='delete.php?id=".$row['id']."&table=Classes'>Delete</a></td></tr>";
      }
    ?>
    </tbody>
    </table>
    <h1 class="text">Custom Filters</h1>
    <form name="form" action="" method="POST">

    <h3 class="text">ID parameters</h3>
    <div class="input-group mb-3 wid40">
      <span class="input-group-text" id="basic-addon2">Look for IDs from</span>
      <input type="number" class="form-control input_height" aria-describedby="basic-addon2" name="firstID" placeholder="Left border of the range">
      <span class="input-group-text" id="basic-addon2">To</span>
      <input type="number" class="form-control input_height" aria-describedby="basic-addon2" name="lastID" placeholder="Right border of the range">
    </div>

    <div class="input-group mb-3 wid40">
      <span class="input-group-text" id="basic-addon2">Look for specific IDs</span>
      <input type="text" class="form-control input_height" aria-describedby="basic-addon2" name="multyID" placeholder="List IDs to search separated with comma">
    </div>

    <input class="btn btn-info btn-lg w-100 mt-3" type="submit" name="filter" value="Apply Filters">
    <a class="btn btn-secondary btn-lg w-100 mt-3" href="Classes.php">Reset Filters</a>

    </form>
  </div>
</main>

<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">Application for Development of Databases by Ivan "Torusaynim" Perlov</span>
  </div>
</footer>

<!-- javascript -->
<script src="tableSort.js"></script>
</body>
</html>
