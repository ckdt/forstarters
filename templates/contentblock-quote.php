<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>
<?php 
$quote_field = get_sub_field('quote_content');
$quote = $quote_field;

$quote_style = get_sub_field('quote_style');
$style ='';
if( $quote_style == 'full' ){ $style = 'col-lg-12'; }
if( $quote_style == 'centered' ){ $style = 'col-lg-8 col-lg-offset-2'; }
if( $quote_style == 'inline' ){ $style = 'col-lg-6 col-lg-offset-3'; }
?>
<div class="content-block quote">
	<div class="container">
		<div class="row">
			<div class="quote <?php echo $style; ?>">
				<blockquote>
					<p><?php echo $quote; ?></p>
					<small>
						<?php if( get_sub_field('quote_url') ):?>
							<cite title="<?php the_sub_field('quote_author'); ?>"><a href="<?php the_sub_field('quote_url'); ?>"> <?php the_sub_field('quote_author'); ?> </a></cite>
						<?php else: ?>
							<cite title="<?php the_sub_field('quote_author'); ?>"><?php the_sub_field('quote_author'); ?></cite>
						<?php endif; ?>
					</small>
				</blockquote>
			</div>
		</div>
	</div>
</div>