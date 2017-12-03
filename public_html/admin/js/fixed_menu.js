function fixTable() {
	var $header = $("table.foxFix > thead");
	// var tableOffset = $("table.foxFix").offset().top - $header.outerHeight() - $header.height();
	var tableOffset = $("table.foxFix").offset().top - $(window).scrollTop();
	var $fixTable = $("#header-fixed");
	var $fixedHeader = $fixTable.append($header.clone());
	function setWidthFixHeader() {
		var w = $header.outerWidth();
		$fixedHeader.css('width', w);
		$fixTable.css('top', 0);
		var thNorm = $header.find('th');
		var thFix = $fixedHeader.find('th');
		for (var i = 0, len = thNorm.length; i < len; i++) {
			w = $(thNorm[i]).outerWidth();
			$(thFix[i]).css('width', w);
		}
	}
	$(window).bind("scroll", function() {
		var offsetV = $(this).scrollTop();
		var offsetH = $(this).scrollLeft();
		if (offsetV >= tableOffset && $fixedHeader.is(":hidden")) {
			setWidthFixHeader();
			$fixedHeader.show();
		} else if (offsetV < tableOffset) {
			$fixedHeader.hide();
		}
	});
};

function fixTableFio() {
	var $header = $(".foxFix > div");
	// var tableOffset = $("table.foxFix").offset().top - $header.outerHeight() - $header.height();
	var tableOffset = $(".foxFix").offset().top - $(window).scrollTop();
	var $fixTable = $("#header-fixed-fio");
	var $fixedHeader = $fixTable;
	function setWidthFixHeader() {
		var w = $header.outerWidth();
		$fixedHeader.css('width', w);
		$fixTable.css('top', 0);
		var thNorm = $header.find('th');
		var thFix = $fixedHeader.find('th');
		for (var i = 0, len = thNorm.length; i < len; i++) {
			w = $(thNorm[i]).outerWidth();
			$(thFix[i]).css('width', w);
		}
	}
	$(window).bind("scroll", function() {
		var offsetV = $(this).scrollTop();
		var offsetH = $(this).scrollLeft();
		if (offsetV >= tableOffset && $fixedHeader.is(":hidden")) {
			setWidthFixHeader();
			$fixedHeader.show();
		} else if (offsetV < tableOffset) {
			$fixedHeader.hide();
		}
	});
};