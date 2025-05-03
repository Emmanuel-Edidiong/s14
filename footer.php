<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package s14
 */

?>

<footer class="site-footer">
    <div class="footer-container">
		<div class="footer-inner">
			<?php if ( is_active_sidebar( 'footer-col-1' ) ) : ?>
				<div class="footer-column">
					<?php dynamic_sidebar( 'footer-col-1' ); ?>
				</div>
			<?php endif; ?>

			<div class="footer-column">
				<h4>Contact Us</h4>
				<p><small class="opacity-4">e-mail:</small><br/> <span class="custom-font"><?php echo esc_html(get_option('s14_email')); ?></span></p>
				<p><small class="opacity-4">address:</small><br/> <span class="custom-font"><?php echo nl2br(esc_html(get_option('s14_address'))); ?></span></p>
				<p><span class="custom-font"><?php echo esc_html(get_option('s14_phone')); ?></span></p>
			</div>

			<?php if ( is_active_sidebar( 'footer-col-3' ) ) : ?>
				<div class="footer-column">
					<?php dynamic_sidebar( 'footer-col-3' ); ?>
				</div>
			<?php endif; ?>

			<div class="footer-column">
				<h4>Follow Us</h4>
				<ul class="social-links">
					<?php
						foreach (['facebook', 'instagram', 'youtube'] as $platform) {
							$url = get_option("s14_{$platform}_link");
							$icon_id = get_option("s14_{$platform}_icon");
							$icon_url = $icon_id ? wp_get_attachment_url($icon_id) : '';

							if ($url && $icon_url) {
								echo '<a href="' . esc_url($url) . '" target="_blank"><img src="' . esc_url($icon_url) . '" alt="' . esc_attr($platform) . '" style="width: 18px;"></a>';
							}
						}
					?>
				</ul>
			</div>
		</div>
    </div>
	<div class="footer-bottom">
		<p><small>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - All rights reserved.</small></p>
		<p class="underline"><small><a href="#" class="text-white">Terms of Use</a></small></p>
		<p class="underline"><small><a href="#" class="text-white">Privacy Policy</a></small></p>
	</div>
</footer>

</div><!-- #page -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.main-navigation ul');

    if (menuToggle && menu) {
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('show');
        });
    }
});
</script>


<?php wp_footer(); ?>

</body>
</html>
