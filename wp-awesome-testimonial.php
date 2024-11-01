<?php 
/*
Plugin Name: Wp Awesome Testimonial
Author: Nayon
Author Uri: http://www.nayonbd.com
Description:Service Box is simple, It’s beautifully manage your website service showcase, responsive, lightweight plugin for creating responsive service box.
Version:1.0
*/

class atw_main_class{

	public function __construct(){
		add_action('init',array($this,'atw_main_area'));
		add_action('wp_enqueue_scripts',array($this,'atw_main_script_area'));
		add_shortcode('testimonial',array($this,'atw_main_shortcode_area'));
	}

	public function atw_main_area(){

		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		load_plugin_textdomain('atw_photo_textdomain', false, dirname( __FILE__).'/lang');
		register_post_type('awesome-testimonial',array(
			'labels'=>array(
				'name'=>'Testimonial'
			),
			'public'=>true,
			'supports'=>array('title','thumbnail','editor'),
			'menu_icon'=>'dashicons-palmtree'
	    ));

	}
	public function atw_main_script_area(){

		wp_enqueue_style('bootstrap',PLUGINS_URL('css/bootstrap.min.css',__FILE__));
		wp_enqueue_style('font-awesome',PLUGINS_URL('css/font-awesome.min.css',__FILE__));
		wp_enqueue_style('testimonial-maincss',PLUGINS_URL('css/style.css',__FILE__));
		wp_enqueue_script('bootstrapjs',PLUGINS_URL('js/bootstrap.min.js',__FILE__),array('jquery'));
		wp_enqueue_script('mainjs',PLUGINS_URL('js/main.js',__FILE__),array('jquery'));

	}

	public function atw_main_shortcode_area($attr,$content){
	ob_start();
	?>
	<!-- testimonial start-->
	<div class="testimonial-showcase ">
        <div class="container">
            <div class="row">
				<?php $atestimonial = new wp_Query(array(
					'post_type'=>'awesome-testimonial'
				));
				while( $atestimonial->have_posts() ) : $atestimonial->the_post();
				?>	
                <div class="col-md-6 col-lg-4">
                    <div class="teastimonial-item-04">
                        <div class="thumb">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="bottom-content">
                            <div class="clients-details">
                                <div class="content">
                                    <h4 class="name"><?php the_title(); ?></h4>
                                </div>
                            </div>
                            <p><?php the_content(); ?></p>
                        </div>
                    </div>
                </div>
				<?php endwhile; ?>
            </div>
        </div>
    </div>
	<?php
	return ob_get_clean();
	}
}
new atw_main_class();





