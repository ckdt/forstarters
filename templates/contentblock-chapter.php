<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>
<?php
	$title = get_sub_field('chapter_title');
?>
<div class="content-block chapter">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a name="<?php echo fs_to_slug($title); ?>"><?php echo $title; ?></a>
			</div>
		</div>
	</div>
</div>