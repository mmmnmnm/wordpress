<?php
function rebalance_child_mmn_styles() {

    $parent_style = 'rebalance-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'rebalance-child-mmn-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'rebalance_child_mmn_styles' );

//mmn: added for better quality logo pic (as opposed to 80x80px logo in parent theme)
function theme_prefix_setup() {
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 200,
		'flex-width' => true,
	) );

}
add_action( 'after_setup_theme', 'theme_prefix_setup',20); // define prio 20 so that parent's custom logo setting is overridden


/* mmmnmnm, mmn */
function rebalance_entry_footer_card() {

	// Posts
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		/*$tags_list = get_the_tag_list( '', esc_html__( ', ', 'rebalance' ) );
		if ( $tags_list ) {
			echo '<span class="entry-tags">' . $tags_list . '</span>';
		};*/

    // Output variable
    $entry_meta_output = '';
    // Author
    $author = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
    // Categories: mmn added
    $categories_list = get_the_term_list( get_the_ID(), 'category', '<span class="entry-categories">', esc_html_x( ', ', 'Categories separator', 'rebalance' ), '</span>' );
    // Tags
    $tags_list = get_the_tag_list( '<span class="entry-tags">', esc_html_x( ', ', 'Tags separator', 'rebalance' ), '</span>' );
    //Data: mmn added
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }
    $time_string = sprintf( $time_string,
  		esc_attr( get_the_date( 'c' ) ),
  		esc_html( get_the_date() ),
  		esc_attr( get_the_modified_date( 'c' ) ),
  		esc_html( get_the_modified_date() )
  	);
    $post_date = '<span class="entry-tags-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';

    $entry_meta_output .= $categories_list;
    $entry_meta_output .= $tags_list;
    if (suppress_author()){
      //do nothing
    } else {
      $entry_meta_output .= $author;
    }
    $entry_meta_output .= $post_date;
    echo $entry_meta_output; // WPCS: XSS OK.
	}

	// Projects
	if ( is_single() && 'jetpack-portfolio' === get_post_type() ) {
		// Show project TAGS on single project templates
		$project_tags_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', '<span class="entry-tags">', esc_html__( ', ', 'rebalance' ), '</span>' );
		if ( $project_tags_list ) {
			echo $project_tags_list;
		}
	} elseif ( 'jetpack-portfolio' === get_post_type() ) {
		// Show project TYPES on all other project templates
		$project_type_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<span class="entry-categories">', esc_html__( ', ', 'rebalance' ), '</span>' );
		if ( $project_type_list ) {
			echo $project_type_list;
		}
	}

	// Edit link
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'rebalance' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/*
 * Alters event's archive titles (mmmnmn, mmn taken from: https://theeventscalendar.com/knowledgebase/altering-or-removing-titles-on-calendar-views/)
 */
function tribe_alter_event_archive_titles ( $original_recipe_title, $depth ) {
	// Modify the titles here
	// Some of these include %1$s and %2$s, these will be replaced with relevant dates
	$title_upcoming =   'Upcoming Events'; // List View: Upcoming events
	$title_past =       'Past Events'; // List view: Past events
	$title_range =      'Events for %1$s - %2$s'; // List view: range of dates being viewed
	$title_month =      '%1$s'; // Month View, %1$s = the name of the month
	$title_day =        '%1$s'; // Day View, %1$s = the day
	$title_all =        'All events for %s'; // showing all recurrences of an event, %s = event title
	$title_week =       'Events for week of %s'; // Week view
	// Don't modify anything below this unless you know what it does
	global $wp_query;
	$tribe_ecp = Tribe__Events__Main::instance();
	$date_format = apply_filters( 'tribe_events_pro_page_title_date_format', tribe_get_date_format( true ) );
	// Default Title
	$title = $title_upcoming;
	// If there's a date selected in the tribe bar, show the date range of the currently showing events
	if ( isset( $_REQUEST['tribe-bar-date'] ) && $wp_query->have_posts() ) {
		if ( $wp_query->get( 'paged' ) > 1 ) {
			// if we're on page 1, show the selected tribe-bar-date as the first date in the range
			$first_event_date = tribe_get_start_date( $wp_query->posts[0], false );
		} else {
			//otherwise show the start date of the first event in the results
			$first_event_date = tribe_event_format_date( $_REQUEST['tribe-bar-date'], false );
		}
		$last_event_date = tribe_get_end_date( $wp_query->posts[ count( $wp_query->posts ) - 1 ], false );
		$title = sprintf( $title_range, $first_event_date, $last_event_date );
	} elseif ( tribe_is_past() ) {
		$title = $title_past;
	}
	// Month view title
	if ( tribe_is_month() ) {
    $title = sprintf(
			$title_month,
			date_i18n( tribe_get_option( 'monthAndYearFormat', 'F Y' ), strtotime( tribe_get_month_view_date() ) )
		);
	}
	// Day view title
	if ( tribe_is_day() ) {
		$title = sprintf(
			$title_day,
			date_i18n( tribe_get_date_format( true ), strtotime( $wp_query->get( 'start_date' ) ) )
		);
	}
	// All recurrences of an event
	if ( function_exists('tribe_is_showing_all') && tribe_is_showing_all() ) {
		$title = sprintf( $title_all, get_the_title() );
	}
	// Week view title
	if ( function_exists('tribe_is_week') && tribe_is_week() ) {
		$title = sprintf(
			$title_week,
			date_i18n( $date_format, strtotime( tribe_get_first_week_day( $wp_query->get( 'start_date' ) ) ) )
		);
	}
	if ( is_tax( $tribe_ecp->get_event_taxonomy() ) && $depth ) {
		$cat = get_queried_object();
		$title = '<a href="' . esc_url( tribe_get_events_link() ) . '">' . $title . '</a>';
		$title .= ' &#8250; ' . $cat->name;
	}
  $title = ucfirst($title);
	return $title;
}
add_filter( 'tribe_get_events_title', 'tribe_alter_event_archive_titles', 11, 2 );

/**
 * Prints HTML with meta information for the current post-date/time, categories, tags and author.
 * mmmnmnm, mmn: custom meta data logic, e.g., no author for videos
 */
function rebalance_entry_meta() {

	// Get time string
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	// Format time string
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	// Output variable
	$entry_meta_output = '';
	// Author
	$author = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
	// Post date
	$post_date = '<span class="entry-tags-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';
	// Categories
	$categories_list = get_the_term_list( get_the_ID(), 'category', '<span class="entry-categories">', esc_html_x( ', ', 'Categories separator', 'rebalance' ), '</span>' );
	// Project type
	$project_type_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<span class="entry-categories">', esc_html_x( ', ', 'Categories separator', 'rebalance' ), '</span>' );
	// Tags
	$tags_list = get_the_tag_list( '<span class="entry-tags">', esc_html_x( ', ', 'Tags separator', 'rebalance' ), '</span>' );

	// Portfolio output
	if ( 'jetpack-portfolio' === get_post_type() ) {
		$entry_meta_output .= $project_type_list;
		echo $entry_meta_output; // WPCS: XSS OK.
	// Everything else's output
	} else {
    // mmmnmnm, mmn: no author for videos
    if (!suppress_author()) {
        $entry_meta_output .= $author;
    }
		$entry_meta_output .= $post_date;
		$entry_meta_output .= $categories_list;
		echo $entry_meta_output; // WPCS: XSS OK.
	}

	// Edit link
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'rebalance' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

function suppress_author(){
  //mmmnmnm, mmn: introduced new custom field to decide whether or not author should be shown
  $custom_fields = get_post_custom(get_the_ID());
  $suppress_author = $custom_fields['suppress-author'];
  if ($suppress_author[0] == 'yes'){
    return true;
  }
  else{
    return false;
  }
}

function suppress_feature_image(){
  //mmmnmnm, mmn: introduced new custom field to suppress feature image
  $custom_fields = get_post_custom(get_the_ID());
  $suppress_author = $custom_fields['suppress-feature-image'];
  if ($suppress_author[0] == 'yes'){
    return true;
  }
  else{
    return false;
  }
}


/*add_action( 'tribe_events_mobile_breakpoint', 'mobile_breakpoint' );

function mobile_breakpoint() {
  return 100000;
}*/

/*mmn: try to get WP not to kill pic quality */
add_filter('jpeg_quality', function($arg){return 100;},20);

/*MMN: change default times of event: https://theeventscalendar.com/support/forums/topic/start-and-end-times/*/
add_action( 'tribe_events_meta_box_timepicker_default', 'new_default_time', 10, 2 );
function new_default_time( $default, $type) {
	$default = false;
	if ( 'start' === $type ) {
		$default = '23:00';
	} elseif ( 'end' === $type ) {
		$default = '5:00';
	}
	$time = $default;
	return $time;
}

//MMN: this was a workaround to move the likes from http to https urls
/*function refer_to_unsecure_FB_likes_og( $tags ) {
        global $post;

        $url = $tags['og:url'];
        $url = preg_replace("/^https:/i", "http:", $url);
        $tags['og:url'] = $url;
        return $tags;
}
add_filter( 'jetpack_open_graph_tags', 'refer_to_unsecure_FB_likes_og' );
*/

//mmn: save facebook likes after http -> https change, see: https://cognitiveseo.com/blog/13431/recover-facebook-shares-https/
remove_action( 'wp_head',             'rel_canonical'                          );
add_action( 'wp_head',             'rel_canonical_mmn'                          );

function rel_canonical_mmn() {
	if ( ! is_singular() ) {
		return;
	}

	$id = get_queried_object_id();

	if ( 0 === $id ) {
		return;
	}

	$url = wp_get_canonical_url( $id );

	if ( ! empty( $url ) ) {
    if ((get_the_date('Y-m-d') <= '2018-05-10') && preg_match('/facebookexternalhit/i',$_SERVER['HTTP_USER_AGENT'])){
      echo '<link rel="canonical" href="' . str_replace("https","http",esc_url( $url )) . '" />' . "\n";
    }
    else {
      echo '<link rel="canonical" href="' . esc_url( $url ) . '" />' . "\n";
      }
	}

}

add_filter( 'jetpack_open_graph_tags', function( $tags ){
  if (is_singular() && (get_the_date('Y-m-d') <= '2018-05-10') && preg_match('/facebookexternalhit/i',$_SERVER['HTTP_USER_AGENT'])){
    unset(  $tags['og:url' ] );
    $id = get_queried_object_id();

  	if ( 0 === $id ) {
  		return;
  	}

  	$url = wp_get_canonical_url( $id );
    $tags['og:url'] = str_replace("https","http",esc_url( $url )); //since no https on www2 page, make up some visible change
  }
	return $tags;
});

//delete card attribute added by events calendar
//rationale: rebalance theme formats this class in a strange way, which causes the events calendar display look unpretty 
add_filter( 'post_class', 'delete_card_class', 11, 1);
function delete_card_class( $wp_classes) {

    if (get_post_type($post->ID)=='tribe_events'){
      # List tag to delete
      $class_delete = array('card');

      # Verify if exist the class of WP in $class_delete
      foreach ($wp_classes as $class_css_key => $class_css) {
          if (in_array($class_css, $class_delete)) {
              unset($wp_classes[$class_css_key]);
          }
      }
    }
    return $wp_classes;
}
?>
