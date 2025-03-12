<?php
$host="localhost";
$username="root";
$password="";
$dbname="affinity_store";
$conn=new mysqli($host,$username,$password,$dbname);
if(!$conn){
    die("Not Connected");
}