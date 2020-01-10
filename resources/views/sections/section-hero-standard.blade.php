@php 
$bkg_overlay = get_sub_field('background_overlay') ? '0, 0, 0' : ''; // as rgb value
$parallax_scrolling = get_sub_field('fix_in_place');
$overlay = $bkg_overlay ? "linear-gradient(rgba(" . $bkg_overlay . ", 0.6), rgba(" . $bkg_overlay . ", 0.6)), " : "";
@endphp

@if ($parallax_scrolling) <div class="hero-standard--paralax"> @endif
  <div  class="hero-standard {{ $bkg_overlay ? 'has-overlay' : '' }} {{$parallax_scrolling ? 'position-fixed' : ''}}" 
        style="background-image: {{ $overlay }}url('{{ get_sub_field('hero_image')['url'] }}')">

    <div class="container content--hero">
      {!! get_sub_field('hero_content') !!}
    </div>

  </div>  
@if ($parallax_scrolling) </div> @endif