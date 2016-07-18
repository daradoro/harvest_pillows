<?php
/*
Plugin Name: ReadMore ReadLess
Plugin URI: 
Description: Add Readmore link to your pages.  Click on read more will expand content on the same page
Author: Brijesh Mishra
Version: 1.0
Author URI: http://profiles.wordpress.org/brijeshmkt/
*/


add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
    // now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['rmrl_meta_box_text'] ) )
        update_post_meta( $post_id, 'rmrl_meta_box_text', wp_kses( $_POST['rmrl_meta_box_text'], $allowed ) );
         
   
    // This is purely my personal preference for saving check-boxes
    $chk = isset( $_POST['rmrl_meta_box_check_box'] )  ? 'on' : 'off';
    update_post_meta( $post_id, 'rmrl_meta_box_check_box', $chk );
}

add_action( 'add_meta_boxes', 'rmrl_meta_box_add' );

function rmrl_meta_box_add(){
	add_meta_box( "rmlm_metabox_id", "ReadMore Read Less", 'rmrl_meta_box_display', 'page', 'side', 'high', $callback_args );
}


function rmrl_meta_box_display($post){
	$values = get_post_custom( $post->ID );
$text = isset( $values['rmrl_meta_box_text'] ) ? esc_attr( $values['rmrl_meta_box_text'][0] ) : 240;

$check = isset( $values['rmrl_meta_box_check_box'] ) ? esc_attr( $values['rmrl_meta_box_check_box'][0] ) : "";

// We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' )
?>
<p>
	Use readmore in this page ?
	<input type="checkbox" name="rmrl_meta_box_check_box" <?php checked( $check, 'on' ); ?> ><br>
</p>

<p>
	<label>Width</label>
	<input id="rmrl_meta_box_text" type="text" value="<?php echo $text; ?>" size="3" name="rmrl_meta_box_text">
</p>

	
<?php
}

add_action('init','rmrl_loadjs');

function rmrl_loadjs() {
    wp_enqueue_script( 'rmrel_readmore', plugins_url( '/js/readmore.min.js', __FILE__ ),array(), '1.0.0', true);
}



function rmrl_custom_script() {
	global $post;
	$rmrl_width = get_post_meta( $post->ID, 'rmrl_meta_box_text', true );
	$rmrl_show_readmore = get_post_meta( $post->ID, 'rmrl_meta_box_check_box', true );
	

	if($rmrl_show_readmore == 'on'){

?>	
    <script>
  jQuery(document).ready(function($) {
      $('article').readmore({
        maxHeight: <?php echo $rmrl_width; ?>
        
      });

});      
  </script>
<?php  
	}
}
add_action('wp_footer', 'rmrl_custom_script');
