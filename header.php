<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package s14
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 's14' ); ?></a>

	<header id="masthead" class="site-header">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-right">
				<a href="#" class="underline-1">Contact Us</a>
                <span class="divider">|</span>
                <a href="#">Members Login</a>
                <span class="divider">|</span>
                <a href="#" class="d-flex"><i class="fas fa-search"></i> <span>Search</span></a>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="main-header">
        <div class="container header-container">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">&#9776;</button>
            <div class="branding">
                <?php
                    $custom_logo_id = get_option('s14_logo'); 

                    if ($custom_logo_id) {
                        echo '<a href="' . esc_url(home_url('/')) . '"><img src="' . $custom_logo_id . '" alt="Logo" class="site-logo"></a>';
                    } else {
                        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></h1>';
                    }
                ?>
            </div>
            <div class="header-content">
                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                        )
                    );
                    ?>
                    <div class="header-buttons-sm">
                        <a href="#" class="btn-member">Become a Member</a>
                        <a href="#" class="btn-donate">Donate</a>
                    </div>
                </nav>

                <div class="header-buttons">
                    <a href="#" class="btn-member">Become a Member</a>
                    <a href="#" class="btn-donate">Donate</a>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.main-navigation');

    toggleButton.addEventListener('click', function () {
        nav.classList.toggle('active');
    });
});
</script>
