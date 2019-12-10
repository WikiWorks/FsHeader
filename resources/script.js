window.FS = window.FS || {};

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

	//on page resize re-calculate the left padding on the nav menu
	jQuery(window).on("load resize", function () {

		sticky_footer();
		//find the width of the logo container and use that to left pad the nav menu
		var logo_width = 10 + jQuery(".logo_container:first").width();
		jQuery("#et-top-navigation").css("padding-left", logo_width + "px !important");
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

});




!function(e, t, n) {
    e.HF = e.HF || {};


    !function() {
        var n, r = t.querySelectorAll("#header2019 .nav-menu-trigger");
        function i(t) {
            if (this.classList.contains("nav-menu-trigger")) {
                var r = !1;
                this.nextElementSibling !== n && (r = !0),
                a(),
                r && function(t) {
                    if (t) {
                        n = t,
                        t.previousElementSibling.setAttribute("aria-expanded", "true"),
                        t.previousElementSibling.classList.add("active"),
                        t.setAttribute("aria-hidden", "false"),
                        t.style.display = "block";
                        var r = e.innerWidth
                          , i = t.getBoundingClientRect();
                        i.right > r && (t.style.marginLeft = "-" + (i.right - r) + "px")
                    }
                }(this.nextElementSibling),
                t.stopPropagation()
            }
        }
        function a() {
            n && (n.previousElementSibling.setAttribute("aria-expanded", "false"),
            n.previousElementSibling.classList.remove("active"),
            n.setAttribute("aria-hidden", "true"),
            n.style.marginLeft = "",
            n.style.display = "",
            n = null)
        }
        Array.prototype.forEach.call(r, function(e) {
            e.addEventListener("click", i)
        }),
        t.addEventListener("click", a)
    }(),
    // FS.User.sessionId && (r = function(e) {
    //     if (e > 0) {
    //         var n = t.querySelector("#messagesLink .unread-message-badge");
    //         n && (n.style.display = "block")
    //     }
    // }
    // ,
    // i = FS.baseUrl + "/service/messaging/inbox/users/" + FS.User.profile.cisId + "/counters",
    // a = [["Accept", "application/json"], ["Authorization", "Bearer " + FS.User.sessionId]],
    // FS.xhr("GET", i, a, null, function(e) {
    //     if (200 !== e.status)
    //         return console.warn("Network Error: " + e.response);
    //     var t = FS.JSON.parse(e.responseText);
    //     r(t.totalUnreadThreads)
    // })),
    !function() {
		var t = document;
        var e, n = t.getElementById("mobileDrawerContainer"), r = t.getElementById("mobileDrawer");
        t.getElementById("hamburgerLink").addEventListener("click", function() {
            n.classList.add("open"),
            setTimeout(l)
        }),
        t.getElementById("closeDrawer").addEventListener("click", a);
        var i = t.querySelectorAll("#mobileDrawer .menuTrigger");
        function a() {
            n.classList.remove("open"),
            t.body.removeEventListener("click", s),
            t.body.removeEventListener("keyup", c)
        }
        function o(t) {
            if (this.classList.contains("menuTrigger")) {
                var n = !1;
                this.nextElementSibling !== e && (n = !0),
                e && (e.previousElementSibling.setAttribute("aria-expanded", "false"),
                e.previousElementSibling.classList.remove("active"),
                e.setAttribute("aria-hidden", "true"),
                e.classList.remove("active"),
                e = null),
                n && (r = this.nextElementSibling) && (e = r,
                r.previousElementSibling.setAttribute("aria-expanded", "true"),
                r.previousElementSibling.classList.add("active"),
                r.setAttribute("aria-hidden", "false"),
                r.classList.add("active")),
                t.stopPropagation()
            }
            var r
        }
        function l() {
            t.body.addEventListener("click", s),
            t.body.addEventListener("keyup", c)
        }
        function s(e) {
            r.contains(e.target) || a()
        }
        function c(e) {
            "Escape" === e.key && a()
        }
        Array.prototype.forEach.call(i, function(e) {
            e.addEventListener("click", o)
        })
        FS.User.getCurrentUserPortraitUrl().then(function(e) {
            if (e) {
                const n = t.createElement("img");
                n.classList.add("user-icon"),
                n.src = e,
                t.querySelector("#liAccount .user-icon").replaceWith(n)
            }
        })
    }(),
    function() {
        HF.hiddenElements = [];
        var e, n = (e = t.getElementById("header2019"),
        t.getElementById("hf-floating-header-wrapper") || e);
        HF.getHeaderHeight = function() {
            return n ? n.offsetHeight : 0
        }
        ,
        HF.hideHeader = function(e, t) {
            var r = HF.getHeaderHeight() + 50;
            n && (Array.isArray(t) ? t.push(n) : t = [n],
            Array.isArray(e) ? e.push(n) : e = [n]),
            e.forEach(function(e) {
                r += e.offsetHeight
            });
            var i = "-" + r + "px";
            t.forEach(function(e) {
                HF.hiddenElements.push(e),
                e.style.transition = ".5s",
                e.style.top = i
            })
        }
        ,
        HF.unhideHeader = function() {
            HF.hiddenElements.forEach(function(e) {
                e.style.transition = ".5s",
                e.style.top = ""
            }),
            HF.hiddenElements = []
        }
    }(),
    HF.updateLang = function(t) {
        var n = null;
        if (e.location.hostname.match("familysearch.org") && (n = ".familysearch.org"),
        FS.Cookie.setCookie("fslanguage", t, "/", null, n),
        -1 !== e.location.href.indexOf("locale=")) {
            var r = e.location.search.slice(1).split("&").filter(function(e) {
                return !(0 === e.indexOf("locale="))
            }).join("&");
            e.location.href = e.location.pathname + (r ? "?" + r : "")
        } else
            HF.dtmLangRoutingPath ? e.location.href = "/" + t + e.location.pathname.substr(HF.dtmLangRoutingPath.length + 1) : e.location.reload()
    }
    ,
    HF.simpleModal = function(e, n) {
        var r = (n || t).querySelector("#" + e);
        if ("" === r.style.visibility) {
            (backdrop = r.querySelector("#" + e + " .backdrop.click-close")) && (backdrop.onclick = function() {
                HF.simpleModal(e)
            }
            );
            for (var i = r.querySelectorAll("#" + e + " .closeBtn"), a = 0; a < i.length; a++)
                i[a].onclick = function() {
                    HF.simpleModal(e)
                }
        }
        "visible" === r.style.visibility ? (r.style.visibility = "hidden",
        r.style.opacity = "0") : (r.style.visibility = "visible",
        r.style.opacity = "1")
    }
    ,
    function() {
        if (t.querySelector("#global-footer")) {
            if (!FS.showEx("trustEEx")) {
                var e = t.querySelector(".cookie-consent-link");
                e && e.addEventListener("click", function() {
                    HF.simpleModal("cookieConsentModal")
                })
            }
            var n = t.querySelectorAll(".langPicker");
            if (n)
                for (var r = 0, i = n.length; r < i; r++)
                    n[r].addEventListener("keydown", e=>{
                        13 !== e.keyCode && 13 !== e.which || (HF.simpleModal("langPickerModal"),
                        t.querySelector("#langPickerModal").focus())
                    }
                    ),
                    n[r].addEventListener("click", function() {
                        HF.simpleModal("langPickerModal"),
                        t.querySelector("#langPickerModal").focus()
                    })
        }
    }(),
    e.HF = e.HF || {},
    HF.showVideoPlayer = function(e, n) {
        var r = JSON.parse(e.getAttribute("data-config"))
          , i = t.querySelector("#" + n)
          , a = r.forceHTML || !1
          , o = '<object class="BrightcoveExperience"><param name="bgcolor" value="#000000" />' + '<param name="width" value="{0}" />'.format(r.width || "100%") + '<param name="height" value="{0}" />'.format(r.height || "100%") + '<param name="playerID" value="{0}" />'.format(r.playerId || "710849472001") + '<param name="playerKey" value="{0}" />'.format(r.playerKey || "AQ~~,AAAApYNoccE~,xDmRWfqDlPhbhwoOkZ1F_TSoe20nAtRQ") + '<param name="isVid" value="true" /><param name="isUI" value="true" />' + '<param name="autoStart" id="autoStart" value="{0}" />'.format(r.autoPlay || "true") + '<param name="dynamicStreaming" value="true" />' + '<param name="@videoPlayer" value="{0}" />'.format(r.videoId) + '<param name="secureConnections" value="true" /><param name="secureHTMLConnections" value="true" /><param name="includeAPI" value="true" /><param name="templateReadyHandler" value="onTemplateReady" /><param name="htmlFallback" value="true" />';
        o += a ? '<param name="forceHTML" value="true" />' : "",
        o += "</object>",
        i.querySelector(".backdrop").addEventListener("click", function() {
            i.querySelector("section").innerHTML = ""
        }),
        i.querySelector("section").innerHTML = o,
        HF.simpleModal(n),
        "undefined" != typeof brightcove ? brightcove.createExperiences() : FS.fetchScript("https://sadmin.brightcove.com/js/BrightcoveExperiences.js", function() {
            brightcove.createExperiences()
        })
    }
    ,
    HF.openGetSatisfactionPopup = function(e) {
        e && e.preventDefault(),
        t.body.querySelector("#helpFeedbackModal") ? HF.simpleModal("helpFeedbackModal") : FS.xhr("GET", "/ask/getFeedbackModalHTML", null, null, function(e) {
            var n;
            try {
                n = JSON.parse(e.response)
            } catch (a) {
                return void console.error("Could not parse response as JSON:", a)
            }
            var r = t.createElement("div");
            t.body.appendChild(r),
            r.outerHTML = n.markup;
            var i = t.createElement("script");
            i.innerHTML = n.script,
            t.body.appendChild(i),
            HF.simpleModal("helpFeedbackModal"),
            "function" == typeof scrollToTop && scrollToTop()
        })
    }
}(window, document);