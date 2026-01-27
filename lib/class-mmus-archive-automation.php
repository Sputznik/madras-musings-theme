<?php

class MMUS_ARCHIVE_AUTOMATION {

  function __construct(){
    add_shortcode( 'mmus_archives', array( $this, 'mmus_archives_shortcode_cb' ) );
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
                Archives of Vol. <?php echo $this->integer_to_roman_numeral($volume); ?> (<?php echo $year_range; ?>)
              </a>
            </p>
        </li>
        <?php $volume--; ?>
        <?php endfor;?>
  		</ul>
	  <?php
    return ob_get_clean();
  }

}

new MMUS_ARCHIVE_AUTOMATION();
