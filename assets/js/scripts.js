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
		// $(".post").on("click", ".share a", function (e) {
//
// 			var $el = $(this);
//
// 			if ($el.hasClass("twitter")) {
// 				console.log("FOUND TWITTER LINK");
// 			} else {
// 				console.log("No sharing matches");
// 				return false;
// 			}
//
// 			e.preventDefault();
// 		})
	};
	
	$(function () {
		App.init();
	});

})(jQuery);