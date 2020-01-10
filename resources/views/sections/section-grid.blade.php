@php 
// layout 
$content_width = get_sub_field('content_width');
$justify_content = get_sub_field('justify_content'); 
$layout_type = get_sub_field('layout_type');

$max_items_per_row = get_sub_field('max_items_per_row'); // default 'no limit'
$col_width;
switch ($max_items_per_row) {
    case 1: $col_width = "col-lg-12"; break;
    case 2: $col_width = "col-lg-6"; break;
    case 3: $col_width = "col-sm-6 col-lg-4"; break;
    case 4: $col_width = "col-sm-6 col-lg-3"; break;
    default: $col_width = "col-sm-6 col-md-3 col-lg-2"; break;
}

// colors 
$bkg_color = get_sub_field('background_color');

@endphp 

<section class="grid-layout bg-{{$bkg_color}} py-5 px-0 px-sm-5 {{ $layout_type }}">

  <div class="{{ $content_width }}">

    @if (get_sub_field('headline_section'))
    <div class="row">
      <div class="col">{!! get_sub_field('headline_section') !!}</div>
    </div>
    @endif

    <div class="row justify-content-{{ $justify_content }}">
      @if (have_rows('grid_content'))

        @while (have_rows('grid_content')) @php the_row() @endphp

        <div class="{{$col_width}}">
          @if (get_sub_field('link_grid_tile')) <a class="card-link" href="{{ get_sub_field('link') }}"> @endif 
          <div class="card mx-auto my-4">
            @switch($layout_type)
              @case('numbered-grid')
                <div class="numbered-img p-3 text-center">{{ get_row_index() }}</div>
                @break
              @case('image-grid')
                <img class="card-img-top" src="{{ get_sub_field('card_image')['url'] }}" alt="{{ get_sub_field('card_image')['alt'] }}">
                @break
            @endswitch
            <div class="card-body">
              {!! get_sub_field('card_text') !!}
            </div>
          </div>
          @if (get_sub_field('link_grid_tile')) </a> @endif 
        </div>
        
        
        @endwhile 

    </div>
    @endif

  </div>
</section>
