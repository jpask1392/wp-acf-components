@php 
// Layout
$columns = get_sub_field("columns");
$column_count = count(get_sub_field('columns'));
$col_class;
switch ($column_count) {
    case 1: $col_class = "none"; break;
    case 2: $col_class = "col-md-6"; break;
    case 3: $col_class = "col-md-4"; break;
    case 4: $col_class = "col-md-3"; break;
    default: $col_class = "none";
}
$container_width = get_sub_field("container_width");
$list_style_type = get_sub_field("list_type");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");
$include_section_header = get_sub_field("include_section_header");
$swap_image_text = get_sub_field("swap_image_and_text") ? "order-2 order-md-0" : "";

$asymetric = $column_count == 2 ? get_sub_field('asymetric_layout') : false;
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

  <div class="{{ $container_width }} overlay-{{ $bkg_overlay }}-text {{ $container_bkg_color }}">

    @if ($include_section_header)
    <div class="section-intro mb-5"> <?= get_sub_field('section_header') ?></div>    
    @endif

    <div class="row align-items-{{ $vertical_content_align }}">
        @while (have_rows('columns')) @php the_row() @endphp
        @php 
        $current_field_type = $columns[get_row_index() - 1]['content_type'];
        @endphp
        
        <div class="type-{{$current_field_type}} {{ $asymetric ? ( get_row_index() == 1 ? $col_left : $col_right ) : $col_class }} {{ get_row_index() == 1 ? $swap_image_text : "" }} p-5">

            @if ($current_field_type == "oEmbed") 
            <div class="o-embed-container"> <?= get_sub_field('embed') ?> </div>

            @elseif ($current_field_type == "image")
            <img class="w-100" src="{{ get_sub_field('image')['url'] }}" alt={{ get_sub_field('image')['alt'] }}>

            @elseif ($current_field_type == "text")
            <div class="bg-{{ $column_bkg_color }}"> <div> <?= get_sub_field('text') ?> </div> </div>

            @elseif ($current_field_type == "accordion")
            @while (have_rows('accordion')) @php the_row() @endphp 
                @include('partials.accordion', [
                'accordion_header'  => get_sub_field('accordion_header'),
                'accordion_content' => get_sub_field('accordion_content'),
                'row_index'         => get_row_index(),
                'section_index'     => $section_index,
                ])
            @endwhile
            @endif
            
        </div>
        @endwhile 
    </div>
  </div>
    
</section>