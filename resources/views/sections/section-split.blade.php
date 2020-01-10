@php 
// Layout
$container_width = get_sub_field("container_width");
$list_style_type = get_sub_field("list_type");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");
$include_section_header = get_sub_field("include_section_header");

$section_class = '';
$col_1_content;
$col_2_content;
$col_1_to_edge = '';
$col_2_to_edge = '';
$col_1_content_type;
$col_2_content_type;

switch (get_sub_field('layout_options')) {
  case 'text_image':
    $col_1_content = get_sub_field('text_lhs');
    $col_1_content_type = ' text';
    $col_2_content_type = ' image';
    if (get_sub_field('to_edge')) :
      $section_class = " alignment--right";
      $col_2_content = '<div style="background-image: url(' . get_sub_field('image_rhs')['url'] . ')"></div>';
      $col_2_to_edge = ' to-edge';
    else :
      $col_2_content = '<img class="w-100" src="' . get_sub_field('image_rhs')['url'] . '">';
    endif;
    break;
  case 'image_text':
    $col_1_content_type = ' image';
    $col_2_content_type = ' text';
    if (get_sub_field('to_edge')) :
      $col_1_content = '<div style="background-image:url(' . get_sub_field('image_lhs')['url'] . ')"></div>';
      $col_1_to_edge = ' to-edge';
      $section_class = " alignment--left";
    else :
      $col_1_content = '<img class="w-100" src="' . get_sub_field('image_lhs')['url'] . '">';
    endif;
    $col_2_content = get_sub_field('text_rhs');
    break;
}

$swap_image_text = get_sub_field("swap_image_and_text") ? "order-2 order-md-0" : "";

// Colors
$bkg_color = get_sub_field('background_color') ? "bg-" . get_sub_field('background_color') : "";
$bkg_overlay = !get_sub_field('background_gradient_overlay') ? "overlay-" . get_sub_field('background_overlay') : "";
$bkg_overlay_opacity = get_sub_field('background_overlay_opacity');
$column_bkg_color = get_sub_field('column_background_color');

// Images 
$bkg_image = get_sub_field('background_image');

// conditionals
$container_bkg_color = get_sub_field('container_background_color') 
  ? "bg-" . get_sub_field('container_background_color') . " ignore-padding" 
  : "";
$bkg_gradient_colors = (object) array (
  'start'   => get_sub_field('background_gradient_colors')['gradient_start'], 
  'end'     => get_sub_field('background_gradient_colors')['gradient_end']
);
$bkg_gradient = get_sub_field('background_gradient_overlay') 
  ? ", linear-gradient(90deg," . $bkg_gradient_colors->start . " 0%, " . $bkg_gradient_colors->end . " 100%)" 
  : "";
$bkg_image = get_sub_field('background_image') 
  ? "background-image: url('" . $bkg_image['url'] . "')" . $bkg_gradient 
  : "";

$sml_screen_order = get_row_index() == 1 ? $swap_image_text : "";
  
@endphp


<section class="standard-section {{ $bkg_color }} justify-content-{{ $justify_content }} {{ $list_style_type }} align-items-center {{ $section_class }}">

  @if ($bkg_image || $bkg_color)
  <div class="standard-background">
    <div  class="background-overlay {{ $bkg_overlay }}" 
          style="opacity: {{ $bkg_overlay_opacity }};"></div>
    <div  class="background-image" 
          style="{{ $bkg_image }}; background-position: center; "></div>
  </div>
  @endif

  @if ($include_section_header)
    <div class="section-intro mb-5"> <?= get_sub_field('section_header') ?></div>    
  @endif

  <div class="{{ $container_width }} overlay-{{ $bkg_overlay }}-text {{ $container_bkg_color }} py-5">

    <div class="row align-items-{{ $vertical_content_align }}">
        
      <div class="col-md-6{{ $col_1_to_edge }}{{ $col_1_content_type }}{{ $sml_screen_order }}">
        {!! $col_1_content !!}
      </div>

      <div class="col-md-6{{ $col_2_to_edge }}{{ $col_2_content_type }}">
        {!! $col_2_content !!}
      </div>
             
    </div>
  </div>
    
</section>

{{-- 
  Possible arrangements
  
  2. Left column text | Right column image
  3. Left column image | Right column text
  4. Left column text | Right column text
  
--}}