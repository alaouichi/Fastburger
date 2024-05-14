<?php
$hn='localhost';
$un='fastburger_admin';
$pw='';
$db='fast_butger';
$conn =mysqli_connect($hn,$un,$pw,$db);
if(!$conn){

    die('Connection failed:' .mysqli_connect.error());

}
else{
    echo('Connection is sucessfull')
}