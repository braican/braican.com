<?php
/**
 * braican functions and definitions
 *
 * @package braican
 */


$SET_THIS = 'set in functions';

@ini_set( 'upload_max_size' , '6M' );
@ini_set( 'post_max_size', '6M');
@ini_set( 'max_execution_time', '300' );


// remove the admin bar
add_filter('show_admin_bar', '__return_false');


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'braican_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function braican_setup() {


		/**
		 * Custom functions that act independently of the theme templates
		 */
		require( get_template_directory() . '/inc/extras.php' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 400, 294, true );

		//This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'braican' ),
		) );
	}
endif; // braican_setup

add_action( 'after_setup_theme', 'braican_setup' );


/**
 * Register widgetized area and update sidebar with default widgets
 */
function braican_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'braican' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'braican_widgets_init' );


if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, false, true);
   wp_enqueue_script('jquery');
}

/**
 * Enqueue scripts and styles
 */
function braican_scripts() {

	wp_enqueue_style( 'braican-style', get_stylesheet_uri() );

	wp_enqueue_script( 'modernizr-js', get_template_directory_uri() . '/js/modernizr.js', array(), '20130115', false );
	wp_enqueue_script( 'scrollto-js', get_template_directory_uri() . '/js/jquery.scrollTo-1.4.3.1-min.js', array('jquery'), '20130115', true );
	wp_enqueue_script( 'braican-js', get_template_directory_uri() . '/js/braican.min.js', array('jquery', 'scrollto-js'), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'braican-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	wp_localize_script('braican-js', 'braican_ajax', array('ajaxurl' => admin_url('admin-ajax.php') ) );
}
add_action( 'wp_enqueue_scripts', 'braican_scripts' );

/**
 * REGISTER POST TYPES
 */

function create_post_type() {
    register_post_type( 'project',
        array(
            'labels' => array(
                'name' => 'Projects',
                'singular_name' => 'Project',
                'add_new_item' => 'Add New Project'
            ),
            'description' => 'a content type for adding new projects',
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')
        )
    );

    register_post_type( 'funfact',
        array(
            'labels' => array(
                'name' => 'Fun Fact',
                'singular_name' => 'Fun Fact',
                'add_new_item' => 'Add New Fact (I also...)',
                'edit_item' => 'Edit Fact (I also...)'
            ),
            'description' => 'a content type for adding fun little factoids',
            'public' => true,
            'has_archive' => false,
            'supports' => array('title')
        )
    );
}
add_action( 'init', 'create_post_type' );

/**
 * REGISTER TAXONOMIES
 */

function create_taxonomies(){
    // project categories
    register_taxonomy('project_categories', 'project',
        array(
            'labels' => array(
                    'name' => 'Project Category'
                ),
            'hierarchical' => 'true'
            )
    );

    // project tags
    register_taxonomy('project_tags', 'project',
        array(
            'labels' => array(
                    'name' => 'Project Tags'
                )
            )
    );
}
add_action( 'init', 'create_taxonomies' );


/****************************
 * SOME CUSTOM FUNCTIONS
 ****************************/

// On an early action hook, check if the hook is scheduled - if not, schedule it.
function braican_schedule_getting_last_beer() {
    if ( ! wp_next_scheduled( 'braican_get_last_beer' ) ) {
        wp_schedule_event( time(), 'hourly', 'braican_get_last_beer');
    }
}
add_action( 'wp', 'braican_schedule_getting_last_beer' );

// On the scheduled action hook, run a function.
function prefix_do_this_hourly() {
    $client_secret = '8EB0A20DDC4D23AA58BD8A0EC6EF2AB9F5A75BE4';
    $client_id = '94284E70E3EC9ED86411018A5ABADFC8160A15F9';
    $username = 'braican';
    $url = "https://api.untappd.com/v4/user/beers/$username?client_id=$client_id&client_secret=$client_secret&limit=1";
    $response = json_decode(wp_remote_retrieve_body(wp_remote_get($url)));

    if($response->meta->code == "200"){
        $checkin = $response->response->beers->items[0];
        $beer = $checkin->beer->beer_name;
        $brewery = $checkin->brewery->brewery_name;
        $rating = $checkin->rating_score;

        switch ($rating) {
            case '5':
                $rating_text = "It was one of the best beers I've ever had.";
                break;
            case '4.5':
                $rating_text = "I though it was pretty amazing.";
                break;
            case '4':
                $rating_text = "I thought it was awesome.";
                break;
            case '3.5':
                $rating_text = "It was pretty good.";
                break;
            case '3':
                $rating_text = "I thought it was ok.";
                break;
            case '2.5':
                $rating_text = "It was alright.";
                break;
            case '2':
                $rating_text = "I didn't think it was great.";
                break;
            case '1.5':
                $rating_text = "I thought it was pretty bad.";
                break;
            case '1':
                $rating_text = "I thought it was really bad.";
                break;
            case '0.5':
                $rating_text = "It was absolutely awful.";
                break;
            default:
                $rating_text = "";
                break;
        }
        
        $text = "<p>$beer by <strong>$brewery</strong></p><p>$rating_text</p>";
        update_option( 'last_beer', $text );
    }
}
add_action( 'braican_get_last_beer', 'prefix_do_this_hourly' );

// get filtered content by ID 
function the_content_by_id($content_id) {
     $page_data = get_page($content_id);
     if ( $page_data )
          return apply_filters('the_content',$page_data->post_content);
     return false;
}

//
// filter_work
//
// renders the filter list
//
function filter_work(){ ?>
	<!-- the navigation -->
    <?php $term_type = "project_categories"; ?>
    <?php $work_types = get_terms($term_type); ?>
    <?php if($work_types) : ?>
        <div class="categories braica-block">
            <span>Filter:</span>
            <ul>
                <?php foreach ($work_types as $t) : ?>
                    <li><a href="#" data-category="<?php echo $t->slug; ?>"><?php echo $t->name; ?></a></li>
                <?php endforeach; ?>
                <li><a href="#" class="showall">show all</a></li>
            </ul>
        </div>
    <?php endif;
}

//
// braican_new_fact
//
function braican_new_fact(){
    $fact = get_posts(array(
        'posts_per_page'   => 1,
        'orderby'          => 'rand',
        'post_type'        => 'funfact'
    )); ?>
    
    <?php if($fact) : ?>
        <p>I also <?php print_r($fact[0]->post_title); ?>, but that's probably less important. <a href="#" class="more-facts"><i class="icon-arrows-ccw"></i></a></p>
    <?php else : ?>
        <?php echo 1; ?>
    <?php endif;

    if(isset($_GET['die'])){
        die();
    }
}
add_action( 'wp_ajax_ajax_facts', 'braican_new_fact' ); // ajax for logged in users
add_action( 'wp_ajax_nopriv_ajax_facts', 'braican_new_fact' ); // ajax for not logged in users


//
// braican_ajax_post
//
function braican_ajax_post(){
	$post_id = $_GET['post_id'];
	$post = get_post($post_id);

    if($post) : ?>

        <article <?php post_class('br-cf'); ?>>
        	<header class="project-header col">
        		<div class="braica-block">
        			<h2 class="project-title"><?php echo get_the_title($post_id); ?> <a href="/" class="close-modal"><i class="icon-cancel"></i></a></h2>
        		</div>
        	</header><!-- .project-header -->

        	<div class="project-content col col2">
        		<div class="braica-block">
        			<?php the_field('braican_project_text', $post_id); ?>
        			<?php if($link = get_field('braican_project_link', $post_id)) : ?>
        				<div class="braica-cta">
        					<a href="<?php echo $link ?>" target="_blank"><?php the_field('braican_project_link_text', $post_id); ?><i class="icon-angle-right"></i></a>
        				</div>
        			<?php endif; ?>
        		</div>
        	</div><!-- .project-content -->
        	
        	<div class="project-gallery col col4 right">
        		<div class="braica-block">
        			<?php if(get_field('braican_project_media', $post_id)) : ?>
        				<?php print(get_field('braican_project_media', $post_id)); ?>
        			<?php endif; ?>
        			<?php if(has_shortcode($post->post_content, 'gallery')) : ?>
        				<?php $gallery = get_post_gallery_images( $post ); ?>
        				<?php foreach($gallery as $img) : ?>
        					<div class="img-container">
        						<img src="<?php echo $img; ?>" alt="">
        					</div>
        				<?php endforeach; ?>
        			<?php endif; ?>
        		</div>
        	</div>
        </article><!-- #post-## -->
<?php
    else :
        echo 1;
    endif;

	die();
}
add_action( 'wp_ajax_ajax_action', 'braican_ajax_post' ); // ajax for logged in users
add_action( 'wp_ajax_nopriv_ajax_action', 'braican_ajax_post' ); // ajax for not logged in users