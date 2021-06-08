<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Php Project</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashborad.php"> <i class="fas fa-cog"></i>
                            Dashborad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addNew.php"> <i class="fas fa-plus"></i> Add New</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="showAll.php"> <i class="fas fa-eye"></i> Show All</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <?php
    require 'conn.php';
    $sql = "SELECT * FROM books";
    $stmt = $conn->query($sql);
    $row = $stmt->fetch(PDO::FETCH_LAZY);

    ?>

    <section class="show_books mt-5">
        <div class="container">
            <table class="table table-active">
                <thead>
                    <tr>
                        <th>Id </th>
                        <th>Title </th>
                        <th>Author </th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
                        echo "
                    <tr>
                        <td>{$row->id}</td>
                        <td>{$row->Title}</td>
                        <td>{$row->Author}</td>
                        <td>{$row->active}</td>
                    </tr>
                ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>



    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>

</body>

</html>