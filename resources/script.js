$(document).ready(function(e) {

	/** Guided Research Image Map */
	(function() {
		// test if we're on the Guided Research page
		if (/Guided_Research_for_Online_Records/.test(document.location.href)) {
		  document.querySelector('#mw-content-text p').innerHTML = "<div style='width: 1000px;'><location-map></location-map></div>";
  
		  var polyfill = document.createElement('script');
		  polyfill.type = 'text/javascript';
		  polyfill.async = true;
		  polyfill.src = 'https://edge.fscdn.org/assets/components/mapFiles/webcomponentsjs/webcomponents-lite-60405515c49744988a6a24e03dedf15a.js';
		  var s = document.getElementsByTagName('script')[0];
		  s.parentNode.insertBefore(polyfill, s);
  
		  var locationMap = document.createElement('link');
		  locationMap.rel = 'import';
  /* CHANGE NEEDED: update URL below every time the location-map.html is changed */
		  locationMap.href = 'https://gist.githubusercontent.com/ahancey/a86414a07c7c1466cc36ffb790a0817d/raw/748a662f88adf92729d925ebf5fb1ce26ec0bb38/location-map.html';
		 var s = document.getElementsByTagName('script')[0];
		  s.parentNode.insertBefore(locationMap, s);
  
	  }
  })();

    // responsive image maps
	$('img[usemap]').rwdImageMaps();

	//////////////// mobile footer placement ////////////////////////
	// mobile skin uses <footer> while desktop uses <div id='footer'>
	var f = document.querySelector('footer');
	var ff = document.getElementById('fs-footer');
	if ( f != null ) {
		f.appendChild(ff);
	}

	var h = document.getElementById('main-header');
	// mw-page-base is only found in desktop view
	var a = document.getElementById('mw-page-base');
	var isMobile = false;
	var isApi = false;
	if ( a == null ) {
		// mobile insertion point
		a = document.getElementById('mw-mf-viewport');
		isMobile = true;
		if ( a == null ) {
			isMobile = false;
			isApi = true;
		}
	}
	if ( isMobile ) {
		a.insertBefore(h, a.firstChild);
		console.log ('moved header for mobile');
	}
	///////////// end mobile footer placement ///////////////////////

	/** Begin search replacement for Main Page */
	var searchBad = document.getElementById('bodySearchHomePageSearchBox');
	var searchForm = document.getElementById('searchform');
	var dupNode = searchForm.cloneNode(true);
	searchBad.parentNode.replaceChild(dupNode,searchBad);
	// searchBad.parentNode.replaceChild(searchForm,searchBad);
	var searchInput = document.getElementById('searchInput');
	searchInput.style.fontSize = "large";
	/** end search replacement */

	var mobile_menus = $(".mobile-nav .menu-item-has-children .sub-menu").hide();

	//on page resize re-calculate the left padding on the nav menu
	jQuery(window).on("load resize", function () {

		sticky_footer();
		//find the width of the logo container and use that to left pad the nav menu
		var logo_width = 10 + jQuery(".logo_container:first").width();
		jQuery("#et-top-navigation").css("padding-left", logo_width + "px !important");
	});

	jQuery(".mobile-nav").on("click", "#top-menu > .menu-item-has-children > a", function(e) {

		e.stopPropagation();
		e.preventDefault();
		//hide all the mobile menus
		mobile_menus.slideUp();
		var parent_element = jQuery(this).parent();

		if(jQuery(parent_element).hasClass("expand")) {
				jQuery(parent_element).removeClass("expand");
		} else {
				jQuery(".menu-item-has-children").removeClass("expand");
				jQuery(parent_element).addClass("expand");
				jQuery(parent_element).find(".sub-menu").slideDown();
				return false;
		}
	});

	jQuery(".mobile-menu-bar-toggle").on("click", function (e) {
		e.stopPropagation();
		e.preventDefault();
		jQuery(".mobile-nav").toggleClass("closed");
		jQuery(".mobile-nav").toggleClass("opened");
		console.log("mobile-menu-open");
		jQuery("html").toggleClass("mobile-menu-open");
	});

	//sticky footer
	function sticky_footer() {
		var th = jQuery('#top-header').height();
		var bm = jQuery('#familysearch-blog-menu').height();
		var hh = jQuery('#main-header').height();
		var fh = jQuery('#fs-footer').height();
		var wh = jQuery(window).height();
		var ch = wh - (th + bm + hh + fh);

		var selector = "#main-content";

		//is this an error page or no search results page?
		//if so add the min-height to #familysearch-blog, else add min-height to #main-content
		if (jQuery("body.search-no-results").length || jQuery("body[class*='error']").length) {
		selector = "#familysearch-blog";
		}

		jQuery(selector).css('min-height', ch);
	}


	//if there is a click on 'body' while the mobile menu is opened close it
	jQuery("html").on("click", "body", function () {
		if ($("html").hasClass("mobile-menu-open")) {
			jQuery("html").removeClass("mobile-menu-open");
		}
	});


});


// We use this function to determine the current wiki based on path
// parseUri 1.2.2
// (c) Steven Levithan <stevenlevithan.com>
// MIT License

function parseUri (str) {
	var	o   = parseUri.options,
		m   = o.parser[o.strictMode ? "strict" : "loose"].exec(str),
		uri = {},
		i   = 14;

	while (i--) uri[o.key[i]] = m[i] || "";

	uri[o.q.name] = {};
	uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) {
		if ($1) uri[o.q.name][$1] = $2;
	});

	return uri;
};

parseUri.options = {
	strictMode: false,
	key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],
	q:   {
		name:   "queryKey",
		parser: /(?:^|&)([^&=]*)=?([^&]*)/g
	},
	parser: {
		strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
		loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
	}
};
