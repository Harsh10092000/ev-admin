

<?php
$host="localhost";
$username="root";
$password="";
$dbname="u874817156_indowagen";
$conn=new mysqli($host,$username,$password,$dbname);
if(!$conn){
    die("Not Connected");
}