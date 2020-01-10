@php 

// var_dump($data);
// Layout
$col_class = get_sub_field('split_column') ? "col-md-6" : 'col'; 
$container_width = get_sub_field("container_width");
$list_style_type = get_sub_field("list_type");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");
$include_section_header = get_sub_field("include_section_header");

$swap_image_text = get_sub_field("swap_image_and_text") ? "order-2 order-md-0" : "";

$asymetric = get_sub_field('asymetric_layout');
$priority = get_sub_field('priority');
$col_left;
$col_right;
if ($asymetric == true & $priority == 'left') { 
    $col_left = "col-md-7";
    $col_right = "col-md-5";
} else {
    $col_left = "col-md-5";
    $col_right = "col-md-7";
}
$column_count = get_sub_field('split_column') ? 2 : 1;

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
  
@endphp


<section class="standard-section {{ $bkg_color }} justify-content-{{ $justify_content }} {{ $list_style_type }} align-items-center">

  <div class="standard-background">
    <div  class="background-overlay {{ $bkg_overlay }}" 
          style="opacity: {{ $bkg_overlay_opacity }};"></div>
    <div  class="background-image" 
          style="{{ $bkg_image }}; background-position: center; "></div>
  </div>

  <div class="{{ $container_width }} overlay-{{ $bkg_overlay }}-text {{ $container_bkg_color }} py-5">

    @if ($include_section_header)
      <div class="section-intro mb-5"> <?= get_sub_field('section_header') ?></div>    
    @endif

    <div class="row align-items-{{ $vertical_content_align }}">
        
      @while (have_rows('section_content')) @php the_row() @endphp
        <div class="mb-3">
          @if (get_sub_field('split_section'))
            <div class="row">
              <div class="col-md-6">
                {!! get_sub_field('content_lhs') !!}
              </div>
              <div class="col-md-6">
                {!! get_sub_field('content_rhs') !!}
              </div>  
            </div>
          @else 
            {!! get_sub_field('text') !!}
          @endif
        </div>
      @endwhile 
             
    </div>
  </div>
    
</section>