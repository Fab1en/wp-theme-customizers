<?php

/*
 * ArtSite theme customizer custom background image settings
 */
function artsite_background_image_customizer( $wp_customize ){
    
    // Customizer Control Class
    class Artsite_Customize_Background_Position extends WP_Customize_Control {
     
        public function render_content() {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input type="hidden" id="customize-bg-position" <?php $this->link(); ?> value="<?php echo $this->value()?>">
            </label>
            <script>
            jQuery(function($){
                // poll the iframe to update the customizer input field
                setInterval(function(){
                    if(frames.length) {
                        var from = $('#customize-bg-position').val();
                        var to = frames[0].background_position;
                        if(from != to) $('#customize-bg-position').val(to).change();
                    }
                }, 500);
            });
            </script>
            <?php
        }
    }
    
    $wp_customize->add_control( new Artsite_Customize_Background_Position( $wp_customize, 'artsite_background_position', array(
        'label'      => __( 'Background Position' ),
        'section'    => 'artsite_colors',
        'settings'   => 'artsite_background_position',
    ) ) );
}
add_action( 'customize_register', 'artsite_background_image_customizer' );

/*
 * Javascript code used in the customizer iframe to move the background image
 */
function artsite_customize_live_apply(){
    wp_enqueue_script('artsite_customize_background_image', get_template_directory_uri().'/customizer/javascript/customize-theme.js', array('jquery'), false, true);
}
add_action('customize_preview_init', 'artsite_customize_live_apply');
