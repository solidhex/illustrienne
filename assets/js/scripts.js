var App = App || {};

(function ($) {
	
	"use strict";
	
	App.init = function () {
		this.accordionList();
		this.postSharing();
	};
	
	App.accordionList = function () {
		$(".linkage").on("click", ".trigger", function (e) {
			
			e.preventDefault();
			
			var $trigger = $(this),
				$ul = $trigger.next("ul");
			
				if ($ul.is(":visible")) {
					$trigger.removeClass("active");
					$ul.slideUp("fast");
				} else {
					$trigger.addClass("active");
					$ul.slideDown("fast");
				}
			
		});
	};
	
	App.postSharing = function () {
		$(".share").on("click", "a", function (e) {
		
			switch ($(this).attr("class")) {
			case "fb":
				e.preventDefault();
				window.open($(this).attr("href"), 'sharer', 'toolbar=0,status=0,width=548,height=325');
				break;
			default:
				
			}
			
		});
	};
	
	$(function () {
		App.init();
	});

})(jQuery);