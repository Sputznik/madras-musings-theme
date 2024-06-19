<div class="form-field">
  <div id="<?php _e( $meta['container_id'] ); ?>" style="padding:0px 16px 10px 0px;"></div>
  <p>
    <a href="#" data-behaviour="<?php _e( $meta['behaviour'] ); ?>" class="button button-secondary"><?php _e( "Set ".$meta['title'] ); ?></a>
    &nbsp; &nbsp;
    <a href="#" data-behaviour="<?php _e( $meta['behaviour'] ); ?>" style="display:none"><?php _e( "Remove ".$meta['title'] ); ?></a>
  </p>
  <input type="hidden" name="<?php _e( $field ); ?>" id="<?php _e( $field ); ?>" value="" />
</div>
