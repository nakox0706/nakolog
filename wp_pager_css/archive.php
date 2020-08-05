<?php get_header(); ?>

<?php
if (function_exists("pagination")) {
	pagination($additional_loop->max_num_pages);
}
?>

<?php get_footer(); ?>
