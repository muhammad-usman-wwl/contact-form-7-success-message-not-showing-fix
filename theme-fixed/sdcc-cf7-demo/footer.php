<footer class="site-footer">
	<div class="wrap">
		&copy; <?php echo esc_html( date( 'Y' ) ); ?> PixelForge Studio — Demo site for the Contact Form 7 troubleshooting tutorial.
	</div>
</footer>
<?php
// THE FIX: wp_footer() prints the footer scripts, including
// Contact Form 7's JavaScript. Without it: no AJAX submit,
// no spinner, no instant success message.
wp_footer();
?>
</body>
</html>
