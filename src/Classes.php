<!doctype html>
<html lang="ru" class="h-100">
<head>
  <!-- Meta tags -->
  <title>My DB App | Classes</title>
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
    <h1 class="mt-5">Title</h1>
    <p class="lead">Text</p>
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
