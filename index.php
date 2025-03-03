<?php
$filePath = dirname(__FILE__);
include "$filePath/controller/mainController.php";

if(isset($_GET["page"])){
    $page = $_GET["page"];
}
else{
    $page = "default";
}

$controller = mainController($page);
include "$filePath/controller/$controller";
?>