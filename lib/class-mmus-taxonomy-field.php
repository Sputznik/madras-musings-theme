<?php

/**
 * ADDS CUSTOM FIELDS IN CATEGORY CREATE AND EDIT SCREEN
 */
class MMUS_TAXONOMY_FIELD {

  private $fields;

  public function __construct() {
    $this->fields = array(
      'mmus_category_pdf' => array(
        'title'        => 'PDF',
        'behaviour'    => 'mmus-taxonomy-pdf',
        'container_id' => 'category-pdf-container'
      ),
      'mmus_category_image' => array(
        'title'        => 'Featured Image',
        'behaviour'    => 'mmus-taxonomy-image',
        'container_id' => 'category-image-container'
      )
    );

    if( is_admin() ) {
      add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );

      // ADD CUSTOM FIELD
      add_action( 'category_add_form_fields', array( $this, 'category_create_screen' ), 10, 1 );
      add_action( 'category_edit_form_fields', array( $this, 'category_edit_screen' ), 10, 2  );

      // SAVE CUSTOM FIELDS
      add_action( 'created_category', array( $this, 'save_fields' ), 10, 1 );
      add_action( 'edited_category', array( $this, 'update_fields' ), 10, 1 );

    }
  }

  function admin_assets( $hook ){
    if( $hook == 'edit-tags.php' || $hook == 'term.php' ){
      wp_enqueue_media();
      wp_enqueue_script( 'mmus-taxonomy-field', MMUS_THEME_URI.'/assets/js/mmus-taxonomy-field.js', array('jquery'), MMUS_THEME_VERSION, true );
    }
  }

  // RENDERS FIELD IN CATEGORY CREATE SCREEN
  function category_create_screen( $taxonomy ){
    foreach ( $this->fields as $field => $meta ){
      include( 'templates/create_screen.php');
    }
  }

  // RENDERS FIELD IN CATEGORY EDIT SCREEN
  function category_edit_screen( $term, $taxonomy ){
    foreach ( $this->fields as $field => $meta ){
      include( 'templates/edit_screen.php');
    }
  }

  function update_fields( $term_id ){
    foreach ( $this->fields as $field => $meta ){
      if( isset( $_POST[$field] ) && '' !== $_POST[$field] ){
        $field_value = $_POST[$field];
        update_term_meta( $term_id, $field, $field_value );
      } else {
        update_term_meta( $term_id, $field, '' );
      }
    }
  }

  function save_fields( $term_id ){
    foreach ( $this->fields as $field => $meta ){
      if( isset( $_POST[$field] ) && '' !== $_POST[$field] ){
        $field_value = $_POST[$field];
        add_term_meta( $term_id, $field, $field_value, true);
      }
    }
  }

}

new MMUS_TAXONOMY_FIELD();
