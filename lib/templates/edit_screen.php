<tr class="form-field term-group-wrap">
  <th scope="row">
    <label for="<?php _e( $field ); ?>"><?php _e( $meta['title'] ); ?></label>
  </th>
  <td>
  <?php $resource_url = get_term_meta ( $term->term_id, $field, true ); ?>
  <div id="<?php _e( $meta['container_id'] ); ?>">
    <?php if ( $resource_url ) : ?>
        <?php if( $field == 'mmus_category_image' ): ?>
          <img src="<?php _e( $resource_url );?>" alt="cat_featured_img" style="max-width:100%">
        <?php else:?>
          <p><?php _e( $resource_url );?></p>
        <?php endif;?>
    <?php endif; ?>
  </div>
  <p>
    <a href="#" data-behaviour="<?php _e( $meta['behaviour'] ); ?>" class="button button-secondary"><?php _e( "Set ".$meta['title'] ); ?></a>
    &nbsp; &nbsp;
    <a href="#" data-behaviour="<?php _e( $meta['behaviour'] ); ?>" style="<?php $resource_url ? '' : _e('display:none');?>"><?php _e( "Remove ".$meta['title'] ); ?></a>
    <input type="hidden" name="<?php _e( $field ); ?>" id="<?php _e( $field ); ?>" value="<?php $resource_url ? _e($resource_url) : '';?>" />
  </p>
  </td>
</tr>
