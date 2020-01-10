<?php
namespace App\Controllers\partials;

use Sober\Controller\Controller;

trait SectionStandard
{
  public function content() {

  $data = [];
  $page_content = get_field('page_content');

  foreach($page_content as $content) {
    if ($content['acf_fc_layout'] == 'standard_layout_03') {

      // logic here
      $container_bkg_color = $content['container_background_color'] 
        ? "bg-" . $content['container_background_color'] . " ignore-padding" 
        : "";


      $this_content = (object) [
        'col_class'               => $content['split_column'] ? "col-md-6" : 'col',
        'container_width'         => $content["container_width"],
        'list_style_type'         => $content["list_type"],
        'justify_content'         => $content["justify_content"],
        'vertical_content_align'  => $content["vertical_content_align"],
        'include_section_header'  => $content["include_section_header"],
        'container_bkg_color'     => $container_bkg_color,
        'bkg_gradient_colors' => (object) array (
          'start'   => $content['background_gradient_colors']['gradient_start'], 
          'end'     => $content['background_gradient_colors']['gradient_end']
        )
      ];

      array_push($data, $this_content);

    } else {
      array_push($data, $content);
    }
  }

  return $data;
  }
}