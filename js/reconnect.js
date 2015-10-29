(function($) {

	var $window = $(window);

	function resize() {
		if ($window.width() < 990) {
			return $('.cover-feature').addClass('verso');
		}
			$('.cover-feature').removeClass('verso').css('margin-left','');
	}

	$window.resize(resize).trigger('resize');

})(jQuery);