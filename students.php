<?php
require_once 'include/utils.php';
$ACTION_VIEW='av';
$ACTION_ADD_FORM='aaf';
$ACTION_ADD_SUBMIT='aas';
$ACTION_GET_KEY='a';
$action=isset($_GET[$ACTION_GET_KEY])?$_GET[$ACTION_GET_KEY]:$ACTION_VIEW;

//$USER_ADD_KEY='user-add';
$USER_ADD_SUCCESS='user-add-success';
$USER_ADD_FAILED='user-add-failed';
$USER_ADD_NOT_SET=false;
//$user_add_result=isset($_GET[$USER_ADD_KEY])?$_GET[$USER_ADD_KEY]:$USER_ADD_NOT_SET;
if($action==$ACTION_ADD_SUBMIT) {
    if (areAllSuserAddFieldsSetAndValid()) {
        addStudentFromPostFields();
        $user_add_result = $USER_ADD_SUCCESS;
    } else
    $user_add_result = $USER_ADD_FAILED;
}else
    $user_add_result=$USER_ADD_NOT_SET;
?>
<h1 color="red">
    <?=$action?>
</h1>
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
                    <h1 color="red"><?= var_dump($user_add_result); ?></h1>
                    <?php
                        //starting the condition for changing page functionality
                        if($action==$ACTION_VIEW and !$user_add_result==$USER_ADD_FAILED){?>
                            <?php
                                if($user_add_result==$USER_ADD_SUCCESS){
                                    // display an alert if the user is added successfully
                                ?>
                                <div class="alert alert-success" role="alert">
                                    Student added successfully
                                </div>

                        <?php }?>

                    <h1 class="h5 fw-bold">Students List</h1>
                    <div class="toolbar-left-part">
                        <button class="sort ic ic-sort btn btn-sort" title="sort button"></button>
                        <a class="btn btn-primary btn-add-students" title="add student button"  href="students.php?<?=$ACTION_GET_KEY.'='.$ACTION_ADD_FORM?>">ADD NEW STUDENT</a>
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
                            <span class="col-md-1 col-auto">
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
                <?php
                    }// end of the first action (view) content
                    elseif($action==$ACTION_ADD_FORM){ ?>
                        <form action="students.php?<?=$ACTION_GET_KEY.'='.$ACTION_ADD_SUBMIT?>" method="post">
                            <?php if($user_add_result==$USER_ADD_FAILED){?>
                            <div class="alert alert-success" role="alert">
                                Please make sure you supplied the required informations in the required format
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="<?= $GLOBALS['STUDENT_NAME'] ;?>">Student name:</label>
                                <input type="text" class="form-control"  required name="<?= $GLOBALS['STUDENT_NAME'] ;?>">
                            </div>
                            <div class="form-group">
                                <label for="<?= $GLOBALS['STUDENT_EMAIL'] ;?>">Student Email</label>
                                <input type="email" class="form-control" required name="<?= $GLOBALS['STUDENT_EMAIL'] ;?>">
                            </div>
                            <div class="form-group">
                                <label for="<?= $GLOBALS['STUDENT_PHONE'] ;?>">Student Phone Number</label>
                                <input type="phone" class="form-control" required name="<?= $GLOBALS['STUDENT_PHONE'] ;?>">
                            </div>
                            <input type="submit" value="ADD STUDENT">
                        </form>
                    <?php } ?>

            </div>
        </div>
    </div>
</main>
<?php include 'footer.php'?>

</body>
</html>