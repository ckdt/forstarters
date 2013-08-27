<?php
/**
 * @package WordPress
 * @subpackage forstarters
 */
?>

<?php
$images = get_sub_field('images');
?>

<div class="content-block images">
	<div class="container">

		<div class="row">
<?php 
if( $images ): 

// global vars
$total = count($images);
$output = '';

foreach( $images as $image ):

    $caption = $image['image_caption'];
    $image = $image['image_field']; 
    $count ++;

    if($total === 1):

        $output = '<div class="col-lg-offset-3 col-lg-6">';
        $output .= '<img src="'.$image['sizes']['image1170x780'].'" alt="'.$image['alt'].'"  title="'.$image['title'].'" />';    
        $output .= '<div class="caption">'.$caption.'</div>';
        $output .= '</div>';   

    elseif($total === 2):

        // first has col-lg-offset-
        if( $count === 1 ){ 
            $output = '<div class="col-lg-offset-2 col-lg-4">';
        }else{
            $output .= '<div class="col-lg-4">';
        }
        $output .= '<img src="'.$image['sizes']['image1170x780'].'" alt="'.$image['alt'].'"  title="'.$image['title'].'" />';    
        $output .= '<div class="caption">'.$caption.'</div>';
        $output .= '</div>';   

    elseif($total === 3):
       
        // first has col-lg-offset-
        if( $count === 1 ){ 
            $output = '<div class="col-lg-4">';
        }else{
            $output .= '<div class="col-lg-4">';
        }
        $output .= '<img src="'.$image['sizes']['image1170x780'].'" alt="'.$image['alt'].'"  title="'.$image['title'].'" />';    
        $output .= '<div class="caption">'.$caption.'</div>';
        $output .= '</div>';   

     elseif($total === 4):
        
        // first has col-lg-offset-
        if( $count === 1 ){ 
            $output = '<div class="col-lg-3">';
        }else{
            $output .= '<div class="col-lg-3">';
        }
        $output .= '<img src="'.$image['sizes']['image1170x780'].'" alt="'.$image['alt'].'"  title="'.$image['title'].'" />';    
        $output .= '<div class="caption">'.$caption.'</div>';
        $output .= '</div>';   
    endif;

endforeach;

echo $output;

endif; 
?>


		</div>
	</div>
</div>