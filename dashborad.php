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
            <a class="navbar-brand" href="#">Book Store </a>
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
    // Handling active & Edit & Delete 
    error_reporting("E_ALL & ~ E_NOTIC");
    require 'conn.php';
    if ($_GET['box'] == 'active') {

        $sqlUpdate = "UPDATE books SET active = 1 WHERE id = :id ";
        $stmt = $conn->prepare($sqlUpdate);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: dashborad.php");
    } elseif ($_GET['box'] == 'unactive') {
        $id = intval($_GET['id']);
        $sqlUpdate = "UPDATE books SET active = 0 WHERE id = :id ";
        $stmt = $conn->prepare($sqlUpdate);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: dashborad.php");
    } elseif ($_GET['box'] == 'edit') {

        $id = intval($_GET['id']);
        $sql = "SELECT * FROM books Where id= $id ";
        $stmt = $conn->query($sql);
        $row = $stmt->fetch();


        if (isset($_POST['edit'])) {
            $title = $_POST['title'];
            $author = $_POST['author'];

            $updateSql = "UPDATE books SET title = :title , author = :author WHERE id =$id";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindValue(":title", $title, PDO::PARAM_STR);
            $updateStmt->bindValue(":author", $author, PDO::PARAM_STR);
            $updateStmt->execute();

            header("Location: dashborad.php");
        }

    ?>
    <section class="form_layout m-auto">
        <div class="container">
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="<?php echo $row->Title; ?>" id="title" class="form-control"
                        placeholder="Title">

                </div>
                <div class="form-group">
                    <label for="Author">Author</label>
                    <input type="text" name="author" value="<?php echo $row->Author; ?>" id="Author"
                        class="form-control" placeholder="Author">
                </div>
                <button type="submit" class="btn btn-danger" name="edit"> Edit</button>
            </form>
        </div>
    </section>
    <?php

    } elseif ($_GET['box'] == 'delete') {
        $id = intval($_GET['id']);
        $sql = "DELETE FROM books WHERE id = $id";
        $stmt = $conn->query($sql);
        header("Location: dashborad.php");
    } else {





        // Show On Table -> Dashborad
        $sql = "SELECT * FROM books ";
        $stmt = $conn->query($sql);
        $count = $stmt->rowCount();

        if ($count) {
            $row = $stmt->fetch();
        }

    ?>
    <section class="dashboard ">
        <div class="container">
            <table class="table table-bordered  text-center  ">
                <thead>
                    <tr>
                        <th>Id </th>
                        <th>Title </th>
                        <th>Author </th>
                        <th>Status</th>
                        <th>Edit || Delete</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    do {
                        if ($row->active == 0) {
                            echo "
                            <tr>
                                <td>{$row->id}</td>
                                <td>{$row->Title}</td>
                                <td>{$row->Author}</td>
                                <td>
                                    <a href = 'dashborad.php?box=active&id={$row->id}'>Active</a>
                                </td>
                                <td>
                                <a  class='btn btn-success'  href = 'dashborad.php?box=edit&id={$row->id}'>Edit</a>
                             
                                <a  class='btn btn-danger'   href = 'dashborad.php?box=delete&id={$row->id}'>Delete</a>
        
                            </td>
                            </tr>
                        ";
                        } elseif ($row->active == 1) {
                            echo "
                            <tr>
                                <td>{$row->id}</td>
                                <td>{$row->Title}</td>
                                <td>{$row->Author}</td>
                                <td>
                                    <a href = 'dashborad.php?box=unactive&id={$row->id}'>UnActive</a>
                                </td>
                                <td>
                                <a class='btn btn-success' href = 'dashborad.php?box=edit&id={$row->id}'>Edit</a>
                                
                                <a class='btn btn-danger' href = 'dashborad.php?box=delete&id={$row->id}'>Delete</a>
        
                            </td>
                            </tr>
                        ";
                        }
                    } while ($row = $stmt->fetch());
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