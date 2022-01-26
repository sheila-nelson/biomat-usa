<?php 
///////////////////////////////////////////////////////////////////////
// admin_home page template
///////////////////////////////////////////////////////////////////////
?>

<h1 class="test"><?php echo $title ?></h1>
This is the admin dashboard

<?php 

if (isset($_SESSION['Id'])) {
    include $partialsPath."sidenav.part.php";

}

?>
    
<script src="" async defer></script>
