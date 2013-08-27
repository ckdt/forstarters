<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>
<a class="sr-only" href="#content">Skip navigation</a>

<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a>
    </div>
    <nav class="collapse navbar-collapse navbar-ex1-collapse" role="navigation">
      <?php 
			wp_nav_menu( array(
				'menu'			=> 'top_menu',
				'depth'			=> 2,
				'container'		=> false,
				'menu_class'	=> 'nav navbar-nav',
				'fallback_cb'	=> false,
				//Process nav menu using our custom nav walker
				'walker'		=> new wp_bootstrap_navwalker()
			)
		);
		?>
    </nav>
  </div>
</header>