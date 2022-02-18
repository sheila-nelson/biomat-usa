<?php

//settings
include "database.php";
include "utils.php";

// require_once('viewtemplate.class.php');

// $viewTemplate->assign('TITLE', 'Admin Home');

$pageName = "main";
$pageTemplate = $pageName.".temp.php";
$stylesheet = $assetsPath.$pageName.".css";
$title = 'ztest5000';

/*
some comment
*/
$a = 6;
$b = 6;
var_dump($a==$b);
echo 10*5;

// Login Form control
if (isset($_POST["login"])) {
    echo serialize($_POST);
    $loginName = $_POST["username"];
    $loginPass = $_POST["password"];
    $sql = "SELECT * FROM admin WHERE Name='{$loginName}' AND Password='{$loginPass}'";
    echo $sql;

    $res = $db->query($sql);
    if ($res->num_rows > 0) {
        $results = $res->fetch_assoc();
        $_SESSION["Id"] = $results["Id"];
        $_SESSION["Name"] = $results["Name"];

        echo "<script>
            window.open('admin_home.php', '_self');    
        
         </script>";
    } else {
        echo "Bad Credentials! Try Again";
    }

}


include "./templates/base.temp.php";
?>

<div class="well">This is a Basic Well</div>