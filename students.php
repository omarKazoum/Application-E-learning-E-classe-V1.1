<?php
define('ACTION_ADD_STUDENT','ACTION_ADD_STUDENT');
require_once 'include/utils.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/student.css">
</head>
<body>
<main class="container-fluid bg-gray">
    <div class="row">
        <?php include 'sidebar.php';?>
        <div class="col content">
            <?php include 'header.php';?>
            <div class="main-content row p-2 d-flex align-items-center">
                <div class="col-12 main-content-toolbar d-flex pb-2 justify-content-between align-items-center border-bottom-light">
                    <h1 class="h5 fw-bold">Students List</h1>
                    <div class="toolbar-left-part">
                        <button class="sort ic ic-sort btn btn-sort" title="sort button"></button>
                        <a class="btn btn-primary btn-add-students" title="add student button" >ADD NEW STUDENT</a>
                    </div>
                </div>
                <div class="table-header row mb-2 d-none d-lg-flex">
                    <span class="offset-1 col-2 text-start">
                        Name
                    </span>
                    <span class="col-2 text-start">
                        Email
                    </span>
                    <span class="col-2 text-start">
                        Phone
                    </span>
                    <span class="col-2 text-start">
                        Enroll Number
                    </span>
                    <span class="col-3 text-start">
                        Date of admission
                    </span>
                </div>
                <div class="row col-12 cards">
                    <?php
                        // let's fill the array with the students data
                        $students=getStudentsData();
                        // now let's print the data
                        foreach($students as $student){
                    ?>
                    <div class="col-12">
                         <div class="card shadow">
                        <div class="card-body d-flex flex-column flex-md-row">
                            <span class="col-lg-1 col-auto">
                                <img src="images/student-img.jfif" alt="" class="w-100">
                            </span>
                            <span class="col-lg-2 text-start">
                                <?php echo $student['name'];?>
                            </span>
                            <span class="col-lg-2 text-start">
                                <?php echo $student['email'];?>
                            </span>
                            <span class="col-lg-2 text-start">
                                <?php echo $student['phone'];?>
                            </span>
                            <span class="col-lg-2 text-start">
                                <?php echo $student['enrolNbr'];?>
                            </span>
                            <span class="col-lg-2 text-start">
                                <?php echo $student['dateAdmission'];?>
                            </span>
                            <span class="col-lg-1 btns">
                                <button class="ic ic-edit btn btn-edit" title="edit button">
                                </button>
                                <button class="ic ic-delete btn btn-delete" title="delete button">
                                </button>
                            </span>
                        </div>
                    </div>
                    </div>
                    <?php }?>
            </div>
            </div>
        </div>
    </div>
</main>
<?php include 'footer.php'?>
</body>
</html>