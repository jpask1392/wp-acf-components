window.acf.add_action('ready', function(){
  window.acf.add_action('show_field', function( element ){
    if (element.context.classList.contains('split-on-toggle')) {
      element.context.previousElementSibling.setAttribute('style', 'width: 50%; display: inline-block;');
      element.context.setAttribute('style', 'width: 50%; display: inline-block; float:right');
    }    
  });
});
