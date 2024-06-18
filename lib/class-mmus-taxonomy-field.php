<?php

/**
 * ADDS CUSTOM FIELDS IN CATEGORY CREATE AND EDIT SCREEN
 */
class MMUS_TAXONOMY_FIELD {

  public function __construct() {
    if( is_admin() ) {
      add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );

      // ADD CUSTOM FIELD
      add_action( 'category_add_form_fields', array( $this, 'category_create_screen' ), 10, 1 );
      add_action( 'category_edit_form_fields', array( $this, 'category_edit_screen' ), 10, 2  );

      // SAVE CUSTOM FIELDS
      add_action( 'created_category', array( $this, 'save_field' ), 10, 1 );
      add_action( 'edited_category', array( $this, 'update_field' ), 10, 1 );
    }
  }

  function admin_assets( $hook ){
    if( $hook == 'edit-tags.php' || $hook == 'term.php' ){
      wp_enqueue_media();
      wp_enqueue_script( 'mmus-taxonomy-field', MMUS_THEME_URI.'/assets/js/mmus-taxonomy-field.js', array('jquery'), MMUS_THEME_VERSION, true );
    }
  }

  // RENDERS FIELD IN CATEGORY CREATE SCREEN
  function category_create_screen( $taxonomy ){ ?>
    <div class="form-field" style="margin-top:35px">
      <div id="category-image-container" style="padding:0px 16px 10px 0px;"></div>
      <p>
        <a href="#" data-behaviour=mmus-taxonomy-image class="button button-secondary"><?php _e('Set Featured Image'); ?></a>
        &nbsp; &nbsp;
        <a href="#" data-behaviour=mmus-taxonomy-image style="display:none"><?php _e('Remove Featured Image'); ?></a>
      </p>
      <input type="hidden" name="mmus_category_image" id="mmus_category_image" value="" />
    </div> <?php
  }

  // RENDERS FIELD IN CATEGORY EDIT SCREEN
  function category_edit_screen( $term, $taxonomy ){ ?>
    <tr class="form-field term-group-wrap">
      <th scope="row">
        <label for="mmus_category_image">Featured Image</label>
      </th>
      <td>
      <?php $image_url = get_term_meta ( $term -> term_id, 'mmus_category_image', true ); ?>
      <div id="category-image-container">
        <?php if ( $image_url ) : ?>
          <img src="<?php _e( $image_url );?>" alt="cat_featured_img" style="max-width:100%">
        <?php endif; ?>
      </div>
      <p>
        <a href="#" data-behaviour=mmus-taxonomy-image class="button button-secondary"><?php _e('Set Featured Image'); ?></a>
        &nbsp; &nbsp;
        <a href="#" data-behaviour=mmus-taxonomy-image style="<?php $image_url ? '' : _e('display:none');?>"><?php _e('Remove Featured Image'); ?></a>
        <input type="hidden" name="mmus_category_image" id="mmus_category_image" value="<?php $image_url ? _e($image_url) : '';?>" />
      </p>
      </td>
    </tr><?php
  }

  function save_field( $term_id ){
    if( isset( $_POST['mmus_category_image'] ) && '' !== $_POST['mmus_category_image'] ){
      $image = $_POST['mmus_category_image'];
      add_term_meta( $term_id, 'mmus_category_image', $image, true);
    }
  }

  function update_field( $term_id ){
    if( isset( $_POST['mmus_category_image'] ) && '' !== $_POST['mmus_category_image'] ){
      $image = $_POST['mmus_category_image'];
      update_term_meta( $term_id, 'mmus_category_image', $image );
    } else {
      update_term_meta( $term_id, 'mmus_category_image', '' );
    }
  }
}

new MMUS_TAXONOMY_FIELD();
