  //Opengraph values for Facebook, added to HEAD




  if ($vars['view_mode'] == 'full') {

    // Using the array, test if each string shows up in the fieds on $vars['node']
    // If so, set your og:image value one time


    // then set body once
    $image_search = array(
      array('field_main_image', 'uri'),
      array('field_youtube', 'thumbnail_path'),
      //'field_herpderp',
    );


    if (isset($vars['node']['#field_main_image'])){
      $img = field_get_items('node', $vars['node'], 'field_main_image');
      $img_url = file_create_url($img[0]['uri']);
      $og_image = array(
        '#tag' => 'meta',
        '#attributes' => array(
          'property' => 'og:image',
          'content' => $img_url,
        ),
      );
      drupal_add_html_head($og_image, 'og_image');
    }

    switch ($vars['node']->type) {
      case 'article':
      case 'book':
      case 'context':
      case 'event':
      case 'external_link':
      case 'publication':

        //Opengraph for title
        $title = $vars['title'];
        $og_title = array(
          '#tag' => 'meta',
          '#attributes' => array(
            'property' => 'og:title',
            'content' => $title,
          ),
        );
        drupal_add_html_head($og_title, 'og_title');

        // Opengraph for the image


        // Opengraph for the summary
        $body_field = field_view_field('node', $vars['node'], 'body', array('type' => 'text_plain'));
        $summary = text_summary($body_field[0]['#markup']);
        $og_description = array(
          '#tag' => 'meta',
          '#attributes' => array(
            'property' => 'og:description',
            'content' => $summary,
          ),
        );
        drupal_add_html_head($og_description, 'og_description');

        break;

      //in case of video link, not image
      case 'dialogue_program':
      case 'multimedia':

        //Opengraph for title
        $title = $vars['title'];
        $og_title = array(
          '#tag' => 'meta',
          '#attributes' => array(
            'property' => 'og:title',
            'content' => $title,
          ),
        );
        drupal_add_html_head($og_title, 'og_title');

        // Opengraph for the youtube thumbnail as the image
        $img = field_get_items('node', $vars['node'], 'field_youtube');
        $img_url = file_create_url($img[0]['thumbnail_path']);
        $og_image = array(
          '#tag' => 'meta',
          '#attributes' => array(
            'property' => 'og:image',
            'content' => $img_url,
          ),
        );
        drupal_add_html_head($og_image, 'og_image');

        //Opengraph for body
        $body_field = field_view_field('node', $vars['node'], 'body', array('type' => 'text_plain'));
        $summary = text_summary($body_field[0]['#markup']);
        $og_description = array(
          '#tag' => 'meta',
          '#attributes' => array(
            'property' => 'og:description',
            'content' => $summary,
          ),
        );
        drupal_add_html_head($og_description, 'og_description');

        break;
      /***Maybe????***/
      //case 'profile':
      //uses profile picture

      //case 'wilson-quartely':
      //uses cover image

//      default:
 //        do the default

//        break;

    }
  }
}

