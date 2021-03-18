jQuery(function() {
   jQuery('.content-bottom').on('click', function() {
       jQuery('#blockmap').hide();
   });
   jQuery('.content-bottom').mouseleave(function() {
       jQuery('#blockmap').show(); 
   });    
});