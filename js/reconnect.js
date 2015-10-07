(function($) {

	var $window = $(window);

	function resize() {
		if ($window.width() < 990) {
			return $('.cover-stories').addClass('verso');
		}
			$('.cover-stories').removeClass('verso').removeAttr('style');
	}
    
	$window.resize(resize).trigger('resize');

})(jQuery);