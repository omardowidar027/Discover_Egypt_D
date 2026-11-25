<?php
if (!isset($pageTitle)) $pageTitle = "Discover Egypt";
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle) ?> | Discover Egypt</title>
    <meta name="description" content="Discover Egypt - a dynamic tourism website built with PHP, MySQL and Bootstrap.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/Discover_Egypt_D/assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top glass-nav">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/Discover_Egypt_D/index.php">
      <span class="brand-mark"><i class="bi bi-compass"></i></span> Discover <span>Egypt</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <li class="nav-item"><a class="nav-link" href="/Discover_Egypt_D/index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/Discover_Egypt_D/places.php">Places</a></li>
        <li class="nav-item"><a class="nav-link" href="/Discover_Egypt_D/about.php">About</a></li>
        <li class="nav-item"><a class="nav-link admin-link" href="/Discover_Egypt_D/admin/index.php"><i class="bi bi-shield-lock"></i> Admin</a></li>
      </ul>
    </div>
  </div>
</nav>
<main>
