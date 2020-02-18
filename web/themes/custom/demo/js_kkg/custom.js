(function($) {
	// Check if the filter exists
    if($('#views-exposed-form-attorney-view-page-1 select').length){
        // Your change function
        $('#views-exposed-form-attorney-view-page-1 select').change(function() {
            // Submit the form
            $(this).parents('form').submit();
        });
     }

})(jQuery);