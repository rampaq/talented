<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
?>

<link rel=stylesheet href="<?=$resource_abs_url;?>css/overview.css"> <!-- speciální styly pro hlavní stránku -->


<!-- footers -->
<?php //require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // currently just the closing /body and /html ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
