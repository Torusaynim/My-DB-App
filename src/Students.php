<?php
session_start();
global $filterquery;
$filterquery = "SELECT * FROM Students WHERE ";

if (isset($_POST['create'])) 
{
  $connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $birthday = mysqli_real_escape_string($connection, $_POST['birthday']);
  $isdorm = mysqli_real_escape_string($connection, $_POST['isdorm']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $phonenum = mysqli_real_escape_string($connection, $_POST['phonenum']);
  $grpid = mysqli_real_escape_string($connection, $_POST['grpid']);
  $depid = mysqli_real_escape_string($connection, $_POST['depid']);
  $instid = mysqli_real_escape_string($connection, $_POST['instid']);
  $ishead = mysqli_real_escape_string($connection, $_POST['ishead']);

  $query = "INSERT INTO `Students` (StudentName, StudentBirthday, Dorminory, StudentEmail, StudentPhoneNum, GroupID, GroupDepartmentID, GroupInstituteID, IsHeadman) VALUES (NULLIF('$name', ''), '$birthday', '$isdorm', NULLIF('$email', ''), NULLIF('$phonenum', ''), '$grpid', '$depid', '$instid', '$ishead')";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
}

if (isset($_POST['update'])) 
{
  $connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

  $id = mysqli_real_escape_string($connection, $_POST['id']);
    
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  if ($name != NULL)
  {
    $query = "UPDATE `Students` SET StudentName='$name' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }

  $birthday = mysqli_real_escape_string($connection, $_POST['birthday']);
  if ($birthday != NULL)
  {
    $query = "UPDATE `Students` SET StudentBirthday='$birthday' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $isdorm = mysqli_real_escape_string($connection, $_POST['isdorm']);
  if ($isdorm != NULL)
  {
    $query = "UPDATE `Students` SET Dorminory='$isdorm' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  if ($email != NULL)
  {
    $query = "UPDATE `Students` SET StudentEmail='$email' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $phonenum = mysqli_real_escape_string($connection, $_POST['phonenum']);
  if ($phonenum != NULL)
  {
    $query = "UPDATE `Students` SET StudentPhoneNum='$phonenum' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $grpid = mysqli_real_escape_string($connection, $_POST['grpid']);
  if ($grpid != NULL)
  {
    $query = "UPDATE `Students` SET GroupID='$grpid' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $depid = mysqli_real_escape_string($connection, $_POST['depid']);
  if ($depid != NULL)
  {
    $query = "UPDATE `Students` SET GroupDepartmentID='$depid' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $instid = mysqli_real_escape_string($connection, $_POST['instid']);
  if ($instid != NULL)
  {
    $query = "UPDATE `Students` SET GroupInstituteID='$instid' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
  
  $ishead = mysqli_real_escape_string($connection, $_POST['ishead']);
  if ($ishead != NULL)
  {
    $query = "UPDATE `Students` SET IsHeadman='$ishead' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
}



?>

<!doctype html>
<html lang="ru" class="h-100">
<head>
  <!-- Meta tags -->
  <title>My DB App | Students</title>
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
            <a class="nav-link" href="Classes.php">Classes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="Students.php">Students</a>
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
    <h1 class="mt-5"><a href="Students.php">Students Table</a></h1>
    <table class="table table-hover table_sort">
    <thead>
      <tr>
      <th>ID</th>
      <th>Student Name</th>
      <th>Date of Birth</th>
      <th>Dorminory</th>
      <th>E-mail</th>
      <th>Phone Number</th>
      <th>Group ID</th>
      <th>Department ID</th>
      <th>Institute ID</th>
      <th>Is Headman</th>
      <th></th>
      </tr>
    </thead>
    <tfoot>
    <tr>
      <form name="form" action="" method="POST">
        <td>...</td>
        <td><input class="input-group" type="text" name="name" id="Name" placeholder="Student Name"></td>
        <td><input class="input-group" type="text" name="birthday" id="Birthday" placeholder="Date of Birth"></td>
        <td><input class="input-group" type="number" name="isdorm" id="IsDorm" placeholder="Dorminory"></td>
        <td><input class="input-group" type="text" name="email" id="Email" placeholder="E-mail"></td>
        <td><input class="input-group" type="number" name="phonenum" id="PhoneNum" placeholder="Phone Numbere"></td>
        <td><input class="input-group" type="number" name="grpid" id="GrpID" placeholder="Group ID"></td>
        <td><input class="input-group" type="number" name="depid" id="DepID" placeholder="Department ID"></td>
        <td><input class="input-group" type="number" name="instid" id="InstID" placeholder="Institute ID"></td>
        <td><input class="input-group" type="number" name="ishead" id="IsHead" placeholder="Is Headman"></td>
        <!-- Confirm -->
        <td><input type="submit" name="create" value="Create" class='btn btn-outline-success w-100'></td>
      </form>
    </tr>
    <tr>
      <form name="form" action="" method="POST">
        <td><input class="input-group" type="number" name="id" id="id" placeholder="ID"></td>
        <td><input class="input-group" type="text" name="name" id="Name" placeholder="Student Name"></td>
        <td><input class="input-group" type="text" name="birthday" id="Birthday" placeholder="Date of Birth"></td>
        <td><input class="input-group" type="number" name="isdorm" id="IsDorm" placeholder="Dorminory"></td>
        <td><input class="input-group" type="text" name="email" id="Email" placeholder="E-mail"></td>
        <td><input class="input-group" type="number" name="phonenum" id="PhoneNum" placeholder="Phone Numbere"></td>
        <td><input class="input-group" type="number" name="grpid" id="GrpID" placeholder="Group ID"></td>
        <td><input class="input-group" type="number" name="depid" id="DepID" placeholder="Department ID"></td>
        <td><input class="input-group" type="number" name="instid" id="InstID" placeholder="Institute ID"></td>
        <td><input class="input-group" type="number" name="ishead" id="IsHead" placeholder="Is Headman"></td>
        <!-- Confirm -->
        <td><input type="submit" name="update" value="Update" class='btn btn-outline-primary w-100'></td>
      </form>
    </tr>
    </tfoot>
    <tbody>
    <?php
      $mysqli = new mysqli("appdb", "user", "password", "appDB");

      $result = $mysqli->query("SELECT * FROM Students");
      if ($filterquery!="SELECT * FROM Students WHERE ")
      {
        $result = $mysqli->query($filterquery);
      }

      foreach ($result as $row){
        echo "<tr class='align-middle'><td>{$row['id']}</td><td>{$row['StudentName']}</td><td>{$row['StudentBirthday']}</td><td>{$row['Dorminory']}</td><td>{$row['StudentEmail']}</td><td>{$row['StudentPhoneNum']}</td><td>{$row['GroupID']}</td><td>{$row['GroupDepartmentID']}</td><td>{$row['GroupInstituteID']}</td><td>{$row['IsHeadman']}</td><td><a class='btn btn-outline-danger w-100' href='delete.php?id=".$row['id']."&table=Students'>Delete</a></td></tr>";
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
    <a class="btn btn-secondary btn-lg w-100 mt-3" href="Students.php">Reset Filters</a>

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
