@php 
$bkg_overlay = '0, 0, 0'; // as rgb value
$overlay = $bkg_overlay ? "linear-gradient(rgba(" . $bkg_overlay . ", 0.6), rgba(" . $bkg_overlay . ", 0.6)), " : "";
// style="background-image: {{ $overlay }}url('{{ get_sub_field('hero_image')['url'] }}')"
// $options = get_sub_field('hero_slideshow_options');
// $show_controls = (in_array('show_controls', $options) ? true : false);
// $show_indicators = (in_array('show_indicators', $options) ? true : false);
@endphp

<div  class="hero-slideshow {{ $bkg_overlay ? 'has-overlay' : '' }}">

  <div id="carousel-hero" class="carousel slide" data-ride="carousel-hero">

    <ol class="carousel-indicators">
      @while (have_rows('hero_slides')) @php the_row() @endphp
        <li data-target="#carousel-hero" data-slide-to="{{ get_row_index() - 1 }}" class={{ get_row_index() == 1 ? "active": ""}}></li>    
      @endwhile
    </ol>

    <div class="carousel-inner" style="background-color: rgba(0,0,0,1)">
      @while (have_rows('hero_slides')) @php the_row() @endphp
 
      <div  class="carousel-item w-100{{ get_row_index() == 1 ? " active": ""}}"
            style="background-image: {{ $overlay }}url('{{ get_sub_field('slide_image')['url'] }}')">

        <div class="carousel-caption d-none d-md-block">
          <h5>{{get_row_index()}} slide label</h5>
        </div>
        
      </div>
      @endwhile
    </div>

    <a class="carousel-control-prev" href="#carousel-hero" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-hero" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</div>  