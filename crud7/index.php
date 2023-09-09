<?php
$insert = false;
$update = false;
$delete = false;
$conn = mysqli_connect("localhost", 'root', '', 'crud');
if (!$conn) {
    die("connection are failed") . mysqli_connect_error();
}
// update querry start 
if(isset($_GET['delete'])){
    // check its working or not 
    $sno=$_GET['delete'];
    // echo $sno; 
    $sql = "DELETE FROM `notes` WHERE sno='$sno'";
    // mysqli_query($conn,"DELETE FROM `notes` WHERE sno='$sno'");
    $result = mysqli_query($conn,$sql);
    if ($result) {
        $delete = true;
    } else {
        echo "updte was cenncel ";
    }
}
// update query end
if (isset($_POST['click'])) {
    if (isset($_POST['snoEdit'])) {
        // update a data
        $sno = $_POST['snoEdit'];
        $Title = $_POST['titleEdit'];
        $desc = $_POST['descEdit'];
    
        $sql = "UPDATE `notes` SET `title` = '$Title' , `description` = '$desc' WHERE `notes`.`Sno` = $sno;";
        $result = mysqli_query($conn,$sql);
        if ($result) {
            $update = true;
        } else {
            echo "updte was cenncel ";
        }
    } 
    
    
    else {
        // insert a data 
        $Title = $_POST['title'];
        $desc = $_POST['desc'];
        $sql = "INSERT INTO `notes` ( `title`, `description`) VALUES ( '$Title', '$desc')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $insert = true;
            // echo "update was succefully";
        } else {
            echo "updte was cenncel ";
        }

    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- dta table link css   -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <title>Hello, world!</title>
</head>

<body>
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Notes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/crud7/index.php" method="post">
                        <input type="hidden" id="snoEdit" name="snoEdit">
                        <div class="mb-3">
                            <label for="notes" class="form-label">Add Title </label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <input type="text" class="form-control" id="descEdit" name="descEdit">
                        </div>

                        <button type="submit" class="btn btn-primary" name="click">update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/crud7/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Holy guacamole!</strong> You are note has been notes sucessfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
    }
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Holy guacamole!</strong> You are note has been  update are  sucessfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
    }
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Holy guacamole!</strong> You are note has been deleted sucessfully.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
    }

    ?>
    <div class="container my-3  border border-2">
        <h1 class="text-danger">Add Notes </h1>
        <form action="/crud7/index.php" method="post">
            <div class="mb-3">
                <label for="notes" class="form-label">Add Title </label>
                <input type="text" class="form-control" id="notes" name="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <input type="text" class="form-control" id="desc" name="desc">
            </div>

            <button type="submit" class="btn btn-primary" name="click">Submit</button>
        </form>
    </div>


    <div class="container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sr.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die("not work");
                }
                $Sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $Sno = $Sno + 1;
                    echo " <tr>
                    <th scope='row'>" . $Sno . "</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td><button class='edit btn btn-primary' id=" . $row['Sno'] . ">Edit</button> <button class='delete btn-danger' id=d". $row['Sno'] .">Delete</button>
                    </td>
                    </tr>";

                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    <script>
        // edits = document.getElementsByClassName('edit');
        // Array.from(edits).forEach((element) => {
        //     element.addEventListener('Click', (e) => {
        //         console.log("hayy", e.target);
        //     })
        // })

        const edits = document.getElementsByClassName('edit');

        Array.from(edits).forEach((element) => {
            element.addEventListener('click', (e) => {
                // console.log("hayy", e.target);
                tr = e.target.parentNode.parentNode;
                titlemodal = tr.getElementsByTagName('td')[0].innerText;
                descmodal = tr.getElementsByTagName('td')[1].innerText;
                console.log(titlemodal, descmodal)
                titleEdit.value = titlemodal;
                descEdit.value = descmodal;
                snoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle')
            })
            
        })
        const delets = document.getElementsByClassName('delete');

            Array.from(delets).forEach((element) => {
             element.addEventListener('click', (e) => {

                sno = e.target.id.substr(1,);
                if(confirm("press a button!")){
                    // alert("tes");
                    window.location=`/crud7/index.php?delete=${sno}`
                }
                else{
                    return false;
                }
    })
  
})

    </script>
</body>

</html>