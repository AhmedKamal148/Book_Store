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
    <!-- -------------------------------------------------------------------------- -->
    <!-- logic -->
    <!-- -------------------------------------------------------------------------- -->

    <?php

    //Varibles


    if (isset($_POST['add-new'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $active = $_POST['active'];
        $errors = array();

        if (empty($title) || empty($author)) {
            $errors[] = "All Fields Requierd ";
        } else {
            require 'conn.php';
            $sql = "INSERT INTO books (`title` , `author`, `active`)  VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $title,  PDO::PARAM_STR);
            $stmt->bindValue(2, $author, PDO::PARAM_STR);
            $stmt->bindValue(3, $active, PDO::PARAM_INT);
            $stmt->execute();
        }
    }



    ?>
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

    <section class="form_layout mt-3">
        <div class="container">
            <div class="header text-center">
                <h3>Add New Book</h3>
            </div>
            <form action="" method="post">


                <?php
                if (isset($errors)) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger' role='alert'>$error</div>";
                    }
                }

                ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">

                </div>
                <div class="form-group">
                    <label for="Author">Author</label>
                    <input type="text" name="author" id="Author" class="form-control" placeholder="Author">
                </div>
                <select name="active" class="select" id="selectbasic">
                    <option value="1"> Active</option>
                    <option value="0"> Un Active</option>
                </select>

                <button type="submit" class="btn btn-danger" name="add-new"> Add</button>
            </form>
        </div>
    </section>




    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>

</body>

</html>