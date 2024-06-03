<?php
$hn='localhost';
$un='fastburger_admin';
$pw='ayu9JksAZZeLMNQ*';
$db='fast_burger';
$conn =mysqli_connect($hn,$un,$pw,$db);
if(!$conn){

    die('Connection failed:' .mysqli_connect.error());

}
else{
    echo('Connection is sucessfull');
}