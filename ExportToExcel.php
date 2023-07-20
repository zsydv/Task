<?php 
require 'GetUserData.php';



$class = new UserTable('localhost', 'task', 'root', '');


echo $class->exportToExcel();




?>