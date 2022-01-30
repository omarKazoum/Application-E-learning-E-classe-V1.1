<?php
require_once 'include/utils.php';

if(isset($_GET['id'])){
    echo 'id passed is '.$_GET['id'].'<br>';
    deleteStudent($_GET['id']);
    //header('location:students.php');
}else
    die('student id not defined');