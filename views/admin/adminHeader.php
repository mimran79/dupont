<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?> | DuPost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
</head>

<body class="min-vh-100 d-flex flex-column">
    <main class="container-fluid px-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
            <div class="container-fluid">
                <a class="navbar-brand fw-bolder" style="width: 120px;" href="index">Dr.DuPont</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto" style="width: 120px; justify-content: flex-end;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="appointments">Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="patients">Patients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="schedule">Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="news">News</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto" style="width: 120px; justify-content: flex-end;">
                        <?php if (!isset($_SESSION['role'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="">Login</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../logout">Logout</a>
                            </li>
                        <?php }; ?>
                    </ul>
                </div>
            </div>
        </nav>