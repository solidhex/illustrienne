<footer>
	<section>
		<div class="nav"><?php get_template_part( 'partials/nav' ); ?></div>
	</section>
	<div class="colophon">
		<div>
			<div class="sosumi">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved. &nbsp;<span class="credits">Design by <a href="http://www.hidesignhouse.com/" target="_blank">Hi Design</a></span>
			</div>
			<?php get_template_part( 'partials/social' ); ?>
		</div>
	</div>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/assets/js/scripts.min.js"></script>

<?php
   /* Always have wp_footer() just before the closing </body>
    * tag of your theme, or you will break many plugins, which
    * generally use this hook to reference JavaScript files.
    */
    wp_footer();
?>

</body>
</html>