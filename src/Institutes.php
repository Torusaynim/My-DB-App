<?php
session_start();
global $filterquery;
$filterquery = "SELECT * FROM Institutes WHERE ";

if (isset($_POST['create'])) 
{
  $connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $director = mysqli_real_escape_string($connection, $_POST['director']);
  $office = mysqli_real_escape_string($connection, $_POST['office']);

  $query = "INSERT INTO `Institutes` (InstituteName, InstituteHeadName, InstituteOffice) VALUES ('$name', '$director', '$office')";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
}

if (isset($_POST['update'])) 
{
  $connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

  $id = mysqli_real_escape_string($connection, $_POST['id']);
    
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  if ($name != NULL)
  {
    $query = "UPDATE `Institutes` SET InstituteName='$name' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }

  $director = mysqli_real_escape_string($connection, $_POST['director']);
  if ($director != NULL)
  {
    $query = "UPDATE `Institutes` SET InstituteHeadName='$director' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }
    
  $office = mysqli_real_escape_string($connection, $_POST['office']);
  if ($office != NULL)
  {
    $query = "UPDATE `Institutes` SET InstituteOffice='$office' WHERE id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  }  
}

if (isset($_POST['filter'])) 
{
  $connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

  $firstID = mysqli_real_escape_string($connection, $_POST['firstID']);
  $lastID = mysqli_real_escape_string($connection, $_POST['lastID']);
  $multyID = mysqli_real_escape_string($connection, $_POST['multyID']);
  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $director = mysqli_real_escape_string($connection, $_POST['director']);
  $firstNum = mysqli_real_escape_string($connection, $_POST['firstNum']);
  $lastNum = mysqli_real_escape_string($connection, $_POST['lastNum']);
  $multyNum = mysqli_real_escape_string($connection, $_POST['multyNum']);

  $andFlag=0;

  if ($firstID!=NULL && $lastID!=NULL)
  {
    $filterquery = $filterquery."id BETWEEN $firstID AND $lastID";
    $andFlag=1;
  }
  elseif ($firstID!=NULL)
  {
    $filterquery = $filterquery."id >= $firstID";
    $andFlag=1;
  }
  elseif ($lastID!=NULL)
  {
    $filterquery = $filterquery."id <= $lastID";
    $andFlag=1;
  }

  if ($multyID!=NULL)
  {
    if ($andFlag==1)
    {
      $filterquery = $filterquery." AND id IN ($multyID)";
    }
    else
    {
      $filterquery = $filterquery."id IN ($multyID)";
      $andFlag=1;
    }
  }

  if ($name!=NULL)
  {
    if ($andFlag==1)
    {
      $filterquery = $filterquery." AND InstituteName LIKE '%$name%'";
    }
    else
    {
      $filterquery = $filterquery."InstituteName LIKE '%$name%'";
      $andFlag=1;
    }
  }
  
  if ($director!=NULL)
  {
    if ($andFlag==1)
    {
      $filterquery = $filterquery." AND InstituteHeadName LIKE '%$director%'";
    }
    else
    {
      $filterquery = $filterquery."InstituteHeadName LIKE '%$director%'";
      $andFlag=1;
    }
  }
  
  if ($firstNum!=NULL && $lastNum!=NULL)
  {
    if ($andFlag==1)
    {
      $filterquery = $filterquery." AND InstituteOffice BETWEEN $firstNum AND $lastNum";
    }
    else
    {
      $filterquery = $filterquery."InstituteOffice BETWEEN $firstNum AND $lastNum";
      $andFlag=1;
    }
  }
  elseif ($firstNum!=NULL)
  {
    if ($andFlag==1)
    {
      $filterquery = $filterquery." AND InstituteOffice >= $firstNum";
    }
    else
    {
      $filterquery = $filterquery."InstituteOffice >= $firstNum";
      $andFlag=1;
    }
  }
  elseif ($lastNum!=NULL)
  {
    if ($andFlag==1)
    {
      $filterquery = $filterquery." AND InstituteOffice <= $lastNum";
    }
    else
    {
      $filterquery = $filterquery."InstituteOffice <= $lastNum";
      $andFlag=1;
    }
  }

  if ($multyNum!=NULL)
  {
    if ($andFlag==1)
    {
      $filterquery = $filterquery." AND InstituteOffice IN ($multyNum)";
    }
    else
    {
      $filterquery = $filterquery."InstituteOffice IN ($multyNum)";
      $andFlag=1;
    }
  }
}

?>

<!doctype html>
<html lang="ru" class="h-100">
<head>
  <!-- Meta tags -->
  <title>My DB App | Institutes</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
            <a class="nav-link active" href="Institutes.php">Institutes</a>
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
    <h1 class="mt-5">Institutes Table</h1>
    <table class="table table-hover table_sort">
    <thead>
      <tr>
      <th>ID</th>
      <th>Name of the Institute</th>
      <th>Director</th>
      <th>Office Number</th>
      <th></th>
      </tr>
    </thead>
    <tfoot>
    <tr>
      <form name="form" action="" method="POST">
        <td>...</td>
        <td><input class="input-group" type="text" name="name" id="Name" placeholder="Name of the Institute"></td>
        <td><input class="input-group" type="text" name="director" id="Director" placeholder="Director"></td>
        <td><input class="input-group" type="number" name="office" id="Office" placeholder="Office Number"></td>
        <!-- Confirm -->
        <td><input type="submit" name="create" value="Create" class='btn btn-outline-success w-100'></td>
      </form>
    </tr>
    <tr>
      <form name="form" action="" method="POST">
        <td><input class="input-group" type="number" name="id" id="id" placeholder="ID"></td>
        <td><input class="input-group" type="text" name="name" id="name" placeholder="Name of the Institute"></td>
        <td><input class="input-group" type="text" name="director" id="director" placeholder="Director"></td>
        <td><input class="input-group" type="number" name="office" id="office" placeholder="Office Number"></td>
        <!-- Confirm -->
        <td><input type="submit" name="update" value="Update" class='btn btn-outline-primary w-100'></td>
      </form>
    </tr>
    </tfoot>
    <tbody>
    <?php
      $mysqli = new mysqli("appdb", "user", "password", "appDB");

      $result = $mysqli->query("SELECT * FROM Institutes");
      if ($filterquery!="SELECT * FROM Institutes WHERE ")
      {
        $result = $mysqli->query($filterquery);
      }

      foreach ($result as $row){
        echo "<tr class='align-middle'><td>{$row['id']}</td><td>{$row['InstituteName']}</td><td>{$row['InstituteHeadName']}</td><td>{$row['InstituteOffice']}</td><td><a class='btn btn-outline-danger w-100' href='delete.php?id=".$row['id']."&table=Institutes'>Delete</a></td></tr>";
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
      <input type="text" class="form-control input_height" aria-describedby="basic-addon2" name="multyID" placeholder="List IDs to search">
    </div>

    <h3 class="text">Name of the Institute parameters</h3>
    <div class="input-group mb-3 wid40">
      <span class="input-group-text" id="basic-addon2">Look for institutes like</span>
      <input type="text" class="form-control input_height" aria-describedby="basic-addon2" name="name" placeholder="Part of the institute name">
    </div>
    
    <h3 class="text">Director parameters</h3>
    <div class="input-group mb-3 wid40">
      <span class="input-group-text" id="basic-addon2">Look for directors like</span>
      <input type="text" class="form-control input_height" aria-describedby="basic-addon2" name="director" placeholder="Part of the director's name">
    </div>

    <h3 class="text">Office Number parameters</h3>
    <div class="input-group mb-3 wid40">
      <span class="input-group-text" id="basic-addon2">Look for office numbers from</span>
      <input type="number" class="form-control input_height" aria-describedby="basic-addon2" name="firstNum" placeholder="Left border of the range">
      <span class="input-group-text" id="basic-addon2">To</span>
      <input type="number" class="form-control input_height" aria-describedby="basic-addon2" name="lastNum" placeholder="Right border of the range">
    </div>

    <div class="input-group mb-3 wid40">
      <span class="input-group-text" id="basic-addon2">Look for specific office numbers</span>
      <input type="text" class="form-control input_height" aria-describedby="basic-addon2" name="multyNum" placeholder="List office numbers to search">
    </div>

    <input class="btn btn-info btn-lg w-100 mt-3" type="submit" name="filter" value="Apply Filters">
    <a class="btn btn-secondary btn-lg w-100 mt-3" href="Institutes.php">Reset Filters</a>

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
