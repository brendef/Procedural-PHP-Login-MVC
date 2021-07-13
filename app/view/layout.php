<!-- 
-- Main page that gets loaded from index.php 
-- Relevant page view stored in $app variable and included and displayed here
-->
<div class="container d-flex flex-column min-vh-100">

    <?php include($app); ?>
</div>
<!-- Gets page footer -->
<?php include($config['INCLUDE_PATH'] . 'footer.php'); ?>