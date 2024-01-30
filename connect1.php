<?php

$hostname='localhost';
$username='root';
$password='';
$database='project_s';

$conn = mysqli_connect($hostname,$username,$password,$database);

if(!$conn){
    die(mysqli_error($conn));
}


?>