<?php 

function theme_register_scripts() {
	wp_enqueue_style( 'boostrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	# https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js
    wp_enqueue_style( 'challenge-theme-css', get_stylesheet_uri(), ['font-awesome-css'] );
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery') );
    wp_enqueue_script( 'jquery-tmpl-js', 'http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js', array('jquery') );
    #wp_enqueue_script( 'angular-js', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js' );
    wp_enqueue_script( 'challenge-theme-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/app.js' ), array( 'jquery','bootstrap-js'/*,'angular-js'*/ ), '1.0', true );

    

     wp_localize_script('challenge-theme-js', 'routes', ['ajaxurl' => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( "load_search_results_nonce" ), 'api' => site_url( 'wp-json/wp/v2/' )] );    
}
add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );


/*
Rest API Song Post Type
*/

function prepare_rest($data, $post, $request){
    $_data = $data->data;
/*    // Thumbnails
    $thumbnail_id = get_post_thumbnail_id( $post->ID );
    $thumbnail300x180 = wp_get_attachment_image_src( $thumbnail_id, '300x180' );
    $thumbnailMedium = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
    $full = wp_get_attachment_image_src( $thumbnail_id, 'full' );
    //Categories
    $cats = get_the_category($post->ID);
    //next/prev
    
    $nextPost = get_adjacent_post(false, '', true );
    $nextPost = $nextPost->ID;
    $prevPost = get_adjacent_post(false, '', false );
    $prevPost = $prevPost->ID;
    $_data['fi_300x180'] = $thumbnail300x180[0];
    $_data['fi_medium'] = $thumbnailMedium[0];
    $_data['full'] = $full[0];
    $_data['cats'] = $cats;
    $_data['next_post'] = $nextPost;
    $_data['previous_post'] = $prevPost;*/
    #$_data['author'] = 'bryan';
    $_data['artistname'] = wp_get_post_terms( $post->ID, 'artist' );
    $_data['albumname'] = wp_get_post_terms( $post->ID, 'album' );
    $data->data = $_data;
    #print_r($data);
    return $data;
}

add_filter('rest_prepare_post', 'prepare_rest', 10, 3);

add_action('rest_api_init', 'register_custom_fields', 1, 1);
function register_custom_fields(){
    register_rest_field(
        'songs',
        'url',
        array(
            'get_callback' => 'show_fields'
        )
    );
	  register_rest_field(
        'songs',
        'artist',
        array(
            'get_callback' => 'show_category'
        )
    );
    register_rest_field(
        'songs',
        'album',
        array(
            'get_callback' => 'show_category'
        )
    ); 
}

function show_fields($object, $field_name, $request){
    return get_post_meta($object['id'], $field_name, true);
}

function show_category($object, $field_name, $request){ 
    return wp_get_post_terms($object['id'], $field_name, false);
}

add_action('wp_ajax_search_song', 'search_song');
add_action('wp_ajax_nopriv_search_song', 'search_song');

function search_song() {
	$q = sanitize_text_field( $_GET['q'] );
	if( $q ):
		$json = _search_query($q);
	else:
		$json['success'] = false;
		$json['msg'] = '';
	endif;
	wp_send_json($json);
}

function _search_query($q){
	$args = array(
		'post_type' => 'songs',
		'post_status' => 'publish',
		's'			=> $q,
/*		'tax_query' => array(
		    			'relation' => 'OR',
		    			array(
				            'taxonomy' => 'artist',
				            'field'	=> 'name',
				            'terms' => $q
				        ),
				        array(
				            'taxonomy' => 'album',
				            'field'	=> 'name',
				            'terms' => $q
				        ),
    				)*/
		);
	$query = new WP_Query($args);

	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();

			$songs[] = array( 
				'title'	=> [ 'rendered' => get_the_title() ], 
				'artist'=> show_category( ['id' => get_the_ID()], 'artist') , 
				'url' 	=> show_fields( ['id' => get_the_ID()], 'url'),
				'id'	=> get_the_ID()
				);

		endwhile;
		$json['success'] = true;
		$json['songs'] = $songs;
	else:
		$json['success'] = false;
		$json['msg'] = 'No Song Found';
	endif;
	wp_reset_postdata();
	return $json;
}
