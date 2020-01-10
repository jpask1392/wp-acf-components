@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')

    @while (have_rows('page_content')) @php the_row() @endphp
    @php $index = get_row_index() - 1 @endphp
      @if (get_row_layout() == "split_layout") 
        @include('sections.section-split', ['section' => $content[$index]])
      @endif
      @if (get_row_layout() == "grid_layout") 
        @include('sections.section-grid', ['section' => $content[$index]])
      @endif
      @if (get_row_layout() == "standard_layout") 
        @include('sections.section-standard-03')
      @endif
      @if (get_row_layout() == "hero_standard_layout") 
        @include('sections.section-hero-standard')
      @endif
      @if (get_row_layout() == "hero_slideshow_layout") 
        @include('sections.section-hero-slideshow')
      @endif
    @endwhile
    
  @endwhile
@endsection
