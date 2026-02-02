<?php

class MMUS_ARCHIVE_AUTOMATION {

  function __construct(){
    add_shortcode( 'mmus_archives', array( $this, 'mmus_archives_shortcode_cb' ) );
    add_shortcode( 'mmus_yearly_archives', array( $this, 'mmus_yearly_archives_shortcode_cb' ) );
  }

  /**
   * Converts integer to Roman.
   *
   * @param int $num
   * Integer to be converted to Roman numeral.
   *
   * @return string
   */
  private function integer_to_roman_numeral( $num ){
    $result = '';
    $num = intval($num);

    // LOOKUP ARRAY THAT CONTAINS ALL THE ROMAN NUMERALS
    $lookup = array(
      'M' => 1000,
      'CM' => 900,
      'D' => 500,
      'CD' => 400,
      'C' => 100,
      'XC' => 90,
      'L' => 50,
      'XL' => 40,
      'X' => 10,
      'IX' => 9,
      'V' => 5,
      'IV' => 4,
      'I' => 1
    );

    foreach( $lookup as $roman => $value ){

      $matches = intval($num / $value); // Determine the number of matches.

      $result .= str_repeat($roman, $matches); // Add the same number of characters to the string.

      $num = $num % $value; // Set the integer to be the remainder of the integer and the value.
    }

    return $result;
  }

  private function is_leap_year( $year ){
    $date = DateTime::createFromFormat( 'Y', $year );
    return $date->format('L') === "1" ? true : false;
  }

  private function get_recent_post_id_by_category_slug( $cat_slug ){
    $args = array(
      'post_type'      => 'post',
      'category_name'  => $cat_slug,
      'numberposts'    => 1,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'fields'         => 'ids'
    );

    $latest_post = get_posts( $args );
    return !empty( $latest_post ) ? $latest_post[0] : 0;
  }

  private function get_volume_months( $start_year, $end_year ){
    return array(
      array("April 1-15, $end_year"),
      array("March 16-31, $end_year", "March 1-15, $end_year"),
      array( $this->is_leap_year( $end_year ) ? "February 16-29, $end_year" : "February 16-28, $end_year", "February 1-15, $end_year" ),
      array("January 16-31, $end_year", "January 1-15, $end_year"),
      array("December 16-31, $start_year", "December 1-15, $start_year"),
      array("November 16-30, $start_year", "November 1-15, $start_year"),
      array("October 16-31, $start_year", "October 1-15, $start_year"),
      array("September 16-30, $start_year", "September 1-15, $start_year"),
      array("August 16-31, $start_year", "August 1-15, $start_year"),
      array("July 16-31, $start_year", "July 1-15, $start_year"),
      array("June 16-30, $start_year", "June 1-15, $start_year"),
      array("May 16-31, $start_year", "May 1-15, $start_year"),
      array("April 16-30, $start_year")
    );
  }

  private function get_volume_meta(){
    global $wp;
    $archive_path = $wp->request;

    $search_str    = array( "copied-archives-of-vol-", "archives-of-vol-" ); // NOTE: After testing, replace the array with "archives-of-vol-"
    $volume_meta   = str_replace( $search_str, "", $archive_path );
    $volume_meta   = explode( "-", $volume_meta );
    $volume_number = $volume_meta[0];
    $start_year    = $volume_meta[1];

    return array(
      'start_year'     => $start_year,
      'end_year'       => $start_year + 1,
      'total_parts'    => 24,
      'volume_number'  => $volume_number
    );

  }

  function mmus_archives_shortcode_cb( $atts ){

    $atts = shortcode_atts( array(
        'start_year'          => 0000,
        'end_year'            => 0000
      ), $atts, 'mmus_archives' );

    $atts['start_year'] = intval( $atts['start_year'] );
    $atts['end_year']   = intval( $atts['end_year'] );

    ob_start();
    ?>
  		<ul class="list-unstyled">
        <?php
          $site_url = home_url();
          $volume = ( $atts['end_year'] - $atts['start_year'] );

          for( $year = $atts['end_year']; $year >= $atts['start_year'] + 1; $year-- ):
            $next_year           = $year;
            $current_year        = $year - 1;
            $year_range          = $next_year != 2000 ? $current_year.'-'.substr( $next_year, -2 ) : $current_year.'-'.$next_year;
            $volume_archive_url  = $site_url."/archives-of-vol-$volume-$year_range/";
          ?>
          <li>
            <p>
              <a href="<?php echo $volume_archive_url; ?>" target="_blank" rel="noopener noreferrer">
                Archives of Vol. <?php echo $this->integer_to_roman_numeral($volume); ?> (Year <?php echo $year_range; ?>)
              </a>
            </p>
        </li>
        <?php $volume--; ?>
        <?php endfor;?>
  		</ul>
	  <?php
    return ob_get_clean();
  }

  function mmus_yearly_archives_shortcode_cb(){
    $volume_meta    = $this->get_volume_meta();
    $start_year     = $volume_meta['start_year'];
    $end_year       = $volume_meta['end_year'];
    $part_number    = $volume_meta['total_parts'];
    $volume_number  = $volume_meta['volume_number'];
    $volume_months  = $this->get_volume_months( $start_year, $end_year );

    ob_start();?>
    <ul class="articles-grid articles-three-grid orbit-three-grid orbit-list-db">
      <?php
        $site_url = home_url();
        foreach( $volume_months as $month_parts ):
          foreach( $month_parts as $month_part ):

          $volume_category_slug = "vol-$volume_number-no-$part_number";
          $cat_obj = get_category_by_slug( $volume_category_slug );

          // GENERATE THE ARCHIVE URL IF IT EXISTS AND HAS POSTS
          if( $cat_obj instanceof WP_Term && $cat_obj->count ):

          $volume_archive_url  = $site_url."/issue/$volume_category_slug/";
          $latest_post_id = $this->get_recent_post_id_by_category_slug( $volume_category_slug );
          $thumbnail      = !empty( $latest_post_id ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $latest_post_id  ), 'full' ) : '';
          $background_img = !empty( $thumbnail ) ? 'style="background-image:url('.$thumbnail[0].');"' : "";
      ?>
          <li>
            <div class="orbit-thumbnail-bg" <?php _e( $background_img ); ?>>
              <a href="<?php echo $volume_archive_url; ?>" target="_blank" rel="noopener noreferrer"></a>
            </div>
            <div class="post-desc">
              <h3 class="post-title">
                <a href="<?php echo $volume_archive_url; ?>" target="_blank" rel="noopener noreferrer">
                  Archive of Vol. <?php echo $this->integer_to_roman_numeral($volume_number); ?> No. <?php echo $part_number.", ".$month_part; ?>
                </a>
              </h3>
            </div>
          </li>
      <?php endif;?>
      <?php $part_number--; endforeach; endforeach; ?>
    </ul>
    <?php
    return ob_get_clean();
  }

}

new MMUS_ARCHIVE_AUTOMATION();
