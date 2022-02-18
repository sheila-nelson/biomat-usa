<?php

//settings
include "database.php";
include "utils.php";
// require_once('viewtemplate.class.php');

$pageName = "admin_home";
$pageTemplate = $pageName.".temp.php";
$stylesheet = $assetsPath.$pageName.".css";
$title = 'Biomat';

include $templatesPath."base.temp.php"
?>

