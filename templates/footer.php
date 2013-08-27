<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>
<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
				<?php $load = microtime();print ('generated in '.number_format($load,2).' seconds.');?>	
			</div>
		</div>
	</div>
</footer>