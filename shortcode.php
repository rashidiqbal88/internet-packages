<?php
/*
	Use shortcode like this:
	
	[packages_function category="gold_package" order="ASC"]
	[packages_function category="sliver_package" order="ASC"]
	[packages_function category="platinum_package" order="ASC"]

*/


function internet_packages_function($atts) {

		extract(shortcode_atts(

			array(
				'totalposts' => '-1',
				'category' 	 => '',
				'excerpt'	 => 'true',
			), $atts

		));
	
		$args = array(

			'posts_per_page' => $totalposts,
			'post_type' 	 => 'POST NAME',
			'order' 		 => 'ASC',
			'tax_query' 	 => array(

				array(
					'taxonomy'	=> 'POST CATEGORY NAME',
					'field' 	=> 'slug',
					'terms' 	=> $category
				)
			)
		);
	
		$myposts = new WP_Query($args);
	
		$output = '<div id="internet_pacakges" class="row">
					<div class="owl-carousel owl-theme owl-loaded owl-drag">';
	
		while ($myposts->have_posts()) {
			$myposts->the_post();
	
			$title 				= get_the_title();
			$postid 			= get_the_ID();
			$content	 		= get_the_content();
			$permalink 			= get_the_permalink();
			$url 				= site_url();
			$mbps   			= get_field('mbps'); /* This field use as Advance custom field (ACF) */
			$top_image   		= get_field('head_image');	/* This field use as Advance custom field (ACF) */
			$speedometer_needles = get_field('speedometer_image');	/* This field use as Advance custom field (ACF) */
	
			$output .= '<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" >
							<div class="item">
								<h2 class="pkgPrice_djf">'.$title.'</h2>
								<h4 class="pkg_mbps">'.$mbps.'</h4>
								<div class="meter">
									<img src="'.$speedometer_image.'" class="img-fluid speedometer_image id_'.$mbps.'" />
								</div>
								<div>
									<a class="getStarted_btn" href="'.$url.'/plans/">Get Started <span class="material-symbols-outlined">trending_flat</span></a>
								</div>
							</div>	
						</div>';
		}
	
		wp_reset_query();
		$output .= '</div></div>';
		return $output;
	}
	
	add_shortcode('internet_packages', 'internet_packages_function');
?>	