<?php
 // var_dump($wgUser);
/**
 * Returns the session identifier for the user.
 * Otherwise returns false for an anonymous user.
 * @param  string $cookieName The name of the cookie to check for a session
 * @return [mixed] session identifier (which would evaluate to true) or false
 */
function getSessionIdFromCookie ($cookieName="fssessionid") {
	$sessionId = null;
	$sessionId = @$_COOKIE["$cookieName"];

	if ( !is_null( $sessionId ) && !empty( $sessionId ) ) {
		return $sessionId;
	} else {
		return false;
	}
}

/**
 * Check if a user has a certain permission. Defaults to checking the
 * ViewTempleUIPermission permission.
 * @param  [integer] $sessionId A valid session identifier
 * @param  string $perm      The permission to check
 * @return [bool] True if user has permission; else False
 */
function checkTemplePermission ($sessionId=null, $perm="ViewTempleUIPermission") {
	if (is_null($sessionId)) {
		return false;
	}
	if ( !empty($sessionId) ) {
		$endpoint = "https://www.familysearch.org/service/ident/cas/cas-public-api/authorization/v1/authorize?perm=$perm&context=FtNormalUserContext&sessionId=$sessionId";

		$xml = file_get_contents($endpoint);
		$xml = new SimpleXMLElement($xml);

		$tAuthorized = $xml->authorized->__toString();
		return ($tAuthorized === 'false')? false : true;
	}
}

/**
 * Check for the value of an LDS profile preference. Defaults to check 'showLDSTempleInfo'
 * @param  [int]  $sessionId A session identifier for a logged in user
 * @param  string  $pref  The preference item to retrieve the value of.
 * @return boolean At least in the case of showLDSTempleInfo, the value is true/false
 */
function hasPref ($sessionId, $pref="showLDSTempleInfo") {
	$ch = curl_init("https://www.familysearch.org/service/tree/tree-data/profile/pref/$pref");
	// When we curl_exec, return a string rather than output directly
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	// Send our session cookie in the request
	curl_setopt ($ch, CURLOPT_COOKIE, "fssessionid=$sessionId");
	$json = curl_exec($ch);
	curl_close($ch);
	$objJson = json_decode($json);
	$data = $objJson->{'data'};
	// The data element is itself json encoded
	if ($data) {
		$hasPref = json_decode($data);
		$hasPref = $hasPref->{'pref'};
		return $hasPref;
	}
	return null;
}


?>
<!--BEGIN QUALTRICS WEBSITE FEEDBACK SNIPPET-->
<script type='text/javascript'>
(function(){var g=function(e,h,f,g){
this.get=function(a){for(var a=a+"=",c=document.cookie.split(";"),b=0,e=c.length;b<e;b++){for(var d=c[b];" "==d.charAt(0);)d=d.substring(1,d.length);if(0==d.indexOf(a))return d.substring(a.length,d.length)}return null};
this.set=function(a,c){var b="",b=new Date;b.setTime(b.getTime()+6048E5);b="; expires="+b.toGMTString();document.cookie=a+"="+c+b+"; path=/; "};
this.check=function(){var a=this.get(f);if(a)a=a.split(":");else if(100!=e)"v"==h&&(e=Math.random()>=e/100?0:100),a=[h,e,0],this.set(f,a.join(":"));else return!0;var c=a[1];if(100==c)return!0;switch(a[0]){case "v":return!1;case "r":return c=a[2]%Math.floor(100/c),a[2]++,this.set(f,a.join(":")),!c}return!0};
this.go=function(){if(this.check()){var a=document.createElement("script");a.type="text/javascript";a.src=g+ "&t=" + (new Date()).getTime();document.body&&document.body.appendChild(a)}};
this.start=function(){var a=this;window.addEventListener?window.addEventListener("load",function(){a.go()},!1):window.attachEvent&&window.attachEvent("onload",function(){a.go()})}};
try{(new g(100,"r","QSI_S_ZN_1YB8u9S54WqyizP","https://zn1yb8u9s54wqyizp-lds.siteintercept.qualtrics.com/WRSiteInterceptEngine/?Q_ZID=ZN_1YB8u9S54WqyizP&Q_LOC="+encodeURIComponent(window.location.href))).start()}catch(i){}})();
</script><div id='ZN_1YB8u9S54WqyizP'><!--DO NOT REMOVE-CONTENTS PLACED HERE--></div>
<!--END WEBSITE FEEDBACK SNIPPET-->


<header id="header2019" class="logged-out">
  <div class="top">
    <div class="left">
      <h1>
        
        <a class="logo beta" href="/" data-test="header-logo" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_logo&quot;}" data-component-init="AdobeLinkTracker">
          <span class="sr-only">Family Search</span>
        </a>
      </h1>
      <nav id="primaryNav">
        
          <div class="primary-nav-item nav-menu-parent ">
            <button class="primary-nav-text nav-menu-trigger" data-config="lo_hdr9_tree" data-component-init="AdobeLinkTracker" aria-expanded="false">Tree</button>
            
              <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu" style="">
                
                  <li class="submenu-item ">
                    <a href="/tree/pedigree" class="submenu-link" data-config="lo_hdr9_tree:pedigree" data-test="pedigree" data-component-init="AdobeLinkTracker">Tree</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/tree/person" class="submenu-link" data-config="lo_hdr9_tree:person" data-test="person" data-component-init="AdobeLinkTracker">Person</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/tree/find" class="submenu-link" data-config="lo_hdr9_tree:findinTree" data-test="findinTree" data-component-init="AdobeLinkTracker">Find</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/tree/list/people" class="submenu-link" data-config="lo_hdr9_tree:lists" data-test="lists" data-component-init="AdobeLinkTracker">Lists</a>
                  </li>
                
              </ul>
            
          </div>
        
          <div class="primary-nav-item nav-menu-parent ">
            <button class="primary-nav-text nav-menu-trigger" data-config="lo_hdr9_srch" data-component-init="AdobeLinkTracker">Search</button>
            
              <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
                
                  <li class="submenu-item ">
                    <a href="/search/" class="submenu-link" data-config="lo_hdr9_srch:records" data-test="records" data-component-init="AdobeLinkTracker">Records</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/tree/find/name" class="submenu-link" data-config="lo_hdr9_srch:findInFamilyTree" data-test="findInFamilyTree" data-component-init="AdobeLinkTracker">Family Tree</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/search/family-trees" class="submenu-link" data-config="lo_hdr9_srch:genealogies" data-test="genealogies" data-component-init="AdobeLinkTracker">Genealogies</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/search/catalog" class="submenu-link" data-config="lo_hdr9_srch:catalog" data-test="catalog" data-component-init="AdobeLinkTracker">Catalog</a>
                  </li>
                
                  <li class="submenu-item books">
                    <a href="https://www.familysearch.org/library/books/" class="submenu-link" data-config="lo_hdr9_srch:books" data-test="books" data-component-init="AdobeLinkTracker">Books</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/wiki/en/Main_Page" class="submenu-link" data-config="lo_hdr9_srch:wiki" data-test="wiki" data-component-init="AdobeLinkTracker">Research Wiki</a>
                  </li>
                
              </ul>
            
          </div>
        
          <div class="primary-nav-item nav-menu-parent ">
            <button class="primary-nav-text nav-menu-trigger" data-config="lo_hdr9_photos" data-component-init="AdobeLinkTracker">Memories</button>
            
              <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
                
                  <li class="submenu-item ">
                    <a href="/photos/" class="submenu-link" data-config="lo_hdr9_photos:overview" data-test="overview" data-component-init="AdobeLinkTracker">Overview</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/photos/gallery" class="submenu-link" data-config="lo_hdr9_photos:gallery" data-test="gallery" data-component-init="AdobeLinkTracker">Gallery</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/photos/people" class="submenu-link" data-config="lo_hdr9_photos:people" data-test="people" data-component-init="AdobeLinkTracker">People</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/photos/find" class="submenu-link" data-config="lo_hdr9_photos:find" data-test="find" data-component-init="AdobeLinkTracker">Find</a>
                  </li>
                
              </ul>
            
          </div>
        
          <div class="primary-nav-item nav-menu-parent ">
            <button class="primary-nav-text nav-menu-trigger" data-config="lo_hdr9_indexing" data-component-init="AdobeLinkTracker" aria-expanded="true">Indexing</button>
            
              <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
                
                  <li class="submenu-item ">
                    <a href="/indexing/" class="submenu-link" data-config="lo_hdr9_indexing:overview" data-test="overview" data-component-init="AdobeLinkTracker">Overview</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/indexing/my-indexing" class="submenu-link" data-config="lo_hdr9_indexing:web_indexing" data-test="web_indexing" data-component-init="AdobeLinkTracker">Web Indexing</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/indexing/projects" class="submenu-link" data-config="lo_hdr9_indexing:find_a_project" data-test="find_a_project" data-component-init="AdobeLinkTracker">Find a Project</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/indexing/help" class="submenu-link" data-config="lo_hdr9_indexing:get_help" data-test="get_help" data-component-init="AdobeLinkTracker">Help Resources</a>
                  </li>
                
              </ul>
            
          </div>
        
          <div class="primary-nav-item nav-menu-parent ">
            <button class="primary-nav-text nav-menu-trigger" data-config="lo_hdr9_activities" data-component-init="AdobeLinkTracker" aria-expanded="false">Activities</button>
            
              <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu" style="">
                
                  <li class="submenu-item ">
                    <a href="/discovery/about" class="submenu-link" data-config="lo_hdr9_activities:allAboutMe" data-test="allAboutMe" data-component-init="AdobeLinkTracker">All About Me</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/discovery/compare" class="submenu-link" data-config="lo_hdr9_activities:compareAFace" data-test="compareAFace" data-component-init="AdobeLinkTracker">Compare-a-Face</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/discovery/record" class="submenu-link" data-config="lo_hdr9_activities:recordMyStory" data-test="recordMyStory" data-component-init="AdobeLinkTracker">Record My Story</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/discovery/picture" class="submenu-link" data-config="lo_hdr9_activities:pictureMyHeritage" data-test="pictureMyHeritage" data-component-init="AdobeLinkTracker">Picture My Heritage</a>
                  </li>
                
                  <li class="submenu-item ">
                    <a href="/discovery/activities/" class="submenu-link" data-config="lo_hdr9_activities:inHomeActivities" data-test="inHomeActivities" data-component-init="AdobeLinkTracker">In-Home Activities</a>
                  </li>
                
              </ul>
            
          </div>
        
      </nav>
    </div>
    <div class="right">
      <nav id="secondaryNav">
        <div class="nav-menu-parent">
          <button id="helpLink" class="nav-menu-trigger" aria-haspopup="true" aria-expanded="false" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help&quot;}" data-component-init="AdobeLinkTracker">
            <img src="https://edge.fscdn.org/assets/components/hf/assets/img/icons/header-help-c9bf91771596fb21d30797738c2aa37a.svg">
            <span class="nav-trigger-text">Help</span>
          </button>
          <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu" style="">
            <li class="submenu-item"><a href="/home/etb_gettingstarted" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:gettingStarted&quot;}" data-component-init="AdobeLinkTracker">Getting Started</a></li>
            <div class="submenu-divider"></div>
            <li class="submenu-item"><a href="/ask/landing" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:helpCenter&quot;}" data-component-init="AdobeLinkTracker">Help Center</a></li>
            <li class="submenu-item"><a href="/ask/landing?search=Getting%20Started&amp;show=lessons&amp;message=true" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:learningCenter&quot;}" data-component-init="AdobeLinkTracker">Learning Center</a></li>
            <div class="submenu-divider"></div>
            <li class="submenu-item"><a href="/help/" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:contactUs&quot;}" data-component-init="AdobeLinkTracker">Contact Us</a></li>
            <li class="submenu-item"><a href="/help/communities" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:community&quot;}" data-component-init="AdobeLinkTracker">Community</a></li>
            <li class="submenu-item"><a href="/ask/mycases#/" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:myCases&quot;}" data-component-init="AdobeLinkTracker">My Cases</a></li>
            <li class="submenu-item"><a href="/wiki/en/Main_Page" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:researchWiki&quot;}" data-component-init="AdobeLinkTracker">Research Wiki</a></li>
            <div class="submenu-divider"></div>
            <li class="submenu-item"><a href="/help/helper" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:helperResources&quot;}" data-component-init="AdobeLinkTracker">Helper Resources</a></li>
          </ul>
        </div>
        
          
            <a href="/auth/familysearch/login?fhf=true&amp;returnUrl=%2F" id="signInLink" class="highlight" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_login&quot;}" data-component-init="AdobeLinkTracker">Sign In</a>
            <a href="/register/" id="registerLink" class="highlight border" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_register&quot;}" data-component-init="AdobeLinkTracker">Create Account</a>
          
        
        <button id="hamburgerLink">
          <img src="https://edge.fscdn.org/assets/components/hf/assets/img/icons/header-hamburger-5eccc4487e684c3f2bdb4f6810d56851.svg">
        </button>
      </nav>
    </div>
  </div>
  <div id="mobileDrawerContainer" class="">
    <div id="mobileDrawer">
      <button id="closeDrawer">
        <img src="https://edge.fscdn.org/assets/components/hf/assets/img/icons/close-934062c39475a612a1ac8d6bae631b56.svg">
      </button>
      
        <div id="loAccount">
          
            <a href="/auth/familysearch/login?fhf=true&amp;returnUrl=%2F" id="signInLink" class="highlight" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_login&quot;}" data-component-init="AdobeLinkTracker">Sign In</a>
            <a href="/register/" id="registerLink" class="highlight border" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_register&quot;}" data-component-init="AdobeLinkTracker">Create Account</a>
          
        </div>
      
      
        <div class="">
          <div class="menuRow menuTrigger" data-config="lo_hdr9_tree" data-component-init="AdobeLinkTracker" aria-expanded="false">Tree</div>
          
            <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
              
                <li class="menuRow ">
                  <a href="/tree/pedigree" class="submenu-link" data-config="lo_hdr9_tree:pedigree" data-test="pedigree" data-component-init="AdobeLinkTracker">Tree</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/tree/person" class="submenu-link" data-config="lo_hdr9_tree:person" data-test="person" data-component-init="AdobeLinkTracker">Person</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/tree/find" class="submenu-link" data-config="lo_hdr9_tree:findinTree" data-test="findinTree" data-component-init="AdobeLinkTracker">Find</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/tree/list/people" class="submenu-link" data-config="lo_hdr9_tree:lists" data-test="lists" data-component-init="AdobeLinkTracker">Lists</a>
                </li>
              
            </ul>
          
        </div>
      
        <div class="">
          <div class="menuRow menuTrigger" data-config="lo_hdr9_srch" data-component-init="AdobeLinkTracker" aria-expanded="false">Search</div>
          
            <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
              
                <li class="menuRow ">
                  <a href="/search/" class="submenu-link" data-config="lo_hdr9_srch:records" data-test="records" data-component-init="AdobeLinkTracker">Records</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/tree/find/name" class="submenu-link" data-config="lo_hdr9_srch:findInFamilyTree" data-test="findInFamilyTree" data-component-init="AdobeLinkTracker">Family Tree</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/search/family-trees" class="submenu-link" data-config="lo_hdr9_srch:genealogies" data-test="genealogies" data-component-init="AdobeLinkTracker">Genealogies</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/search/catalog" class="submenu-link" data-config="lo_hdr9_srch:catalog" data-test="catalog" data-component-init="AdobeLinkTracker">Catalog</a>
                </li>
              
                <li class="menuRow books">
                  <a href="https://www.familysearch.org/library/books/" class="submenu-link" data-config="lo_hdr9_srch:books" data-test="books" data-component-init="AdobeLinkTracker">Books</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/wiki/en/Main_Page" class="submenu-link" data-config="lo_hdr9_srch:wiki" data-test="wiki" data-component-init="AdobeLinkTracker">Research Wiki</a>
                </li>
              
            </ul>
          
        </div>
      
        <div class="">
          <div class="menuRow menuTrigger" data-config="lo_hdr9_photos" data-component-init="AdobeLinkTracker" aria-expanded="false">Memories</div>
          
            <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
              
                <li class="menuRow ">
                  <a href="/photos/" class="submenu-link" data-config="lo_hdr9_photos:overview" data-test="overview" data-component-init="AdobeLinkTracker">Overview</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/photos/gallery" class="submenu-link" data-config="lo_hdr9_photos:gallery" data-test="gallery" data-component-init="AdobeLinkTracker">Gallery</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/photos/people" class="submenu-link" data-config="lo_hdr9_photos:people" data-test="people" data-component-init="AdobeLinkTracker">People</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/photos/find" class="submenu-link" data-config="lo_hdr9_photos:find" data-test="find" data-component-init="AdobeLinkTracker">Find</a>
                </li>
              
            </ul>
          
        </div>
      
        <div class="">
          <div class="menuRow menuTrigger" data-config="lo_hdr9_indexing" data-component-init="AdobeLinkTracker" aria-expanded="false">Indexing</div>
          
            <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
              
                <li class="menuRow ">
                  <a href="/indexing/" class="submenu-link" data-config="lo_hdr9_indexing:overview" data-test="overview" data-component-init="AdobeLinkTracker">Overview</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/indexing/my-indexing" class="submenu-link" data-config="lo_hdr9_indexing:web_indexing" data-test="web_indexing" data-component-init="AdobeLinkTracker">Web Indexing</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/indexing/projects" class="submenu-link" data-config="lo_hdr9_indexing:find_a_project" data-test="find_a_project" data-component-init="AdobeLinkTracker">Find a Project</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/indexing/help" class="submenu-link" data-config="lo_hdr9_indexing:get_help" data-test="get_help" data-component-init="AdobeLinkTracker">Help Resources</a>
                </li>
              
            </ul>
          
        </div>
      
        <div class="">
          <div class="menuRow menuTrigger" data-config="lo_hdr9_activities" data-component-init="AdobeLinkTracker" aria-expanded="true">Activities</div>
          
            <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
              
                <li class="menuRow ">
                  <a href="/discovery/about" class="submenu-link" data-config="lo_hdr9_activities:allAboutMe" data-test="allAboutMe" data-component-init="AdobeLinkTracker">All About Me</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/discovery/compare" class="submenu-link" data-config="lo_hdr9_activities:compareAFace" data-test="compareAFace" data-component-init="AdobeLinkTracker">Compare-a-Face</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/discovery/record" class="submenu-link" data-config="lo_hdr9_activities:recordMyStory" data-test="recordMyStory" data-component-init="AdobeLinkTracker">Record My Story</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/discovery/picture" class="submenu-link" data-config="lo_hdr9_activities:pictureMyHeritage" data-test="pictureMyHeritage" data-component-init="AdobeLinkTracker">Picture My Heritage</a>
                </li>
              
                <li class="menuRow ">
                  <a href="/discovery/activities/" class="submenu-link" data-config="lo_hdr9_activities:inHomeActivities" data-test="inHomeActivities" data-component-init="AdobeLinkTracker">In-Home Activities</a>
                </li>
              
            </ul>
          
        </div>
      
    </div>
  </div>
</header>
<header id="main-header" data-height-onload="74" data-view-service="header" style="display:none;">
	<div class="container clearfix et_menu_container">
		<div id="primary-navigation">
         <!-- FamilySearch Logo at the top-left of the page -->
			<div class="logo_container">
				<span class="logo_helper"></span>
				<a href="https://www.familysearch.org/">
               <img src="/wiki/public_html/img/logo.png" alt="<?php $t ('header-fswiki');?>" id="logo" data-height-percentage="54">
            </a>
         </div>  <!-- end .logo_container -->
         <div id="et-top-navigation" data-height="66" data-fixed-height="40" class="noprint">
            <div id="header-right-section">
               <div id="secondary-navigation">
                  <div class="container clearfix">
                     <div id="et-secondary-menu">
                        <div class="menu-header-links-top-container">
                           <ul id="menu-header-links-top" class="menu">
								 <!-- 20190417 - added messages -->
								 <li class="upper-nav-item header-top-link menu-item menu-item-type-custom menu-item-object-custom messages">
									<a style="color:black!important;" href="https://www.familysearch.org/messaging/mailbox" target="_blank" data-test="header-nav-messages" data-component="AdobeLinkTracker" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;li_hdr_msgs&quot;}">
										<?php $t ('header-messages');?>
											<!--
												<span id="desktop-messages-badge" class="red-badge fs-messages-badge fs-badge hf-hide">
											</span>-->
									</a>
								</li>
                              <!-- Volunteer link - top-right of the page -->
                              <li id="menu-item-39416"
                                 class="header-top-link menu-item menu-item-type-custom menu-item-object-custom menu-item-39416">
                                 <a style="color:black!important;" href="https://www.familysearch.org/ask/volunteer"><?php $t ('header-volunteer');?></a>
                              </li>
                              <!-- Help menu at the top-right of the page -->
                              <li id="menu-item-39417"
                                 class="header-top-link menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-39417">
                                 <a style="color:black!important;" href="#"><?php $t ('header-help');?></a>
                                 <ul class="sub-menu">
                                    <!-- Create search box in Help dropdown menu -->
                                    <form class="search-form" method="get"
                                       action="https://www.familysearch.org/ask/landing?search=add+a+name&amp;show=all&amp;button=">
                                       <input type="hidden" name="show" value="all">
                                       <label>
                                          <span class="screen-reader-text"><?php $t ('header-searchfor');?>:
                                          </span>
                                          <input class="search-field" type="text" name="search"
                                             placeholder="<?php $t ('header-searchboxplaceholder');?>">
                                       </label>
                                       <input value="" class="search-submit" type="submit" name="button"
                                          data-component-init="AdobeLinkTracker">
                                    </form>
                                    <!-- Help Center -->
                                    <li id="menu-item-39418"
                                       class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39418">
                                       <a href="https://www.familysearch.org/ask/landing"><?php $t ('header-helpcenter');?></a>
                                    </li>
                                    <!-- Getting Started -->
                                    <li id="menu-item-39420"
                                       class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39420">
                                       <a href="https://www.familysearch.org/ask/gettingStarted"><?php $t ('header-gettingstarted');?></a>
                                    </li>
                                    <!-- Contact Us -->
                                    <li id="menu-item-39421"
                                       class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39421">
                                       <a href="https://www.familysearch.org/ask/help"><?php $t ('header-contactus');?></a>
                                    </li>
                                    <!-- Learning Center -->
                                    <li id="menu-item-39422"
                                       class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39422">
                                       <a href="https://www.familysearch.org/ask/landing?search=Getting%20Started&amp;show=lessons&amp;message=true"><?php $t ('header-learningcenter');?></a>
                                    </li>
                                    <!--Community -->
                                    <li id="menu-item-39423"
                                       class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39423">
                                       <a href="https://www.familysearch.org/ask/communities"><?php $t ('header-community');?></a>
                                    </li>
                                    <!-- My Cases -->
                                    <li id="menu-item-39424"
                                       class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39424">
                                       <a href="https://www.familysearch.org/ask/mycases#/"><?php $t ('header-mycases');?></a>
                                    </li>
                                    <!-- Research Wiki -->
                                    <li id="menu-item-39427"
                                       class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39427">
                                       <a href="/wiki/<?php $t ('header-language');?>"><?php $t ('header-researchwiki');?></a>
                                    </li>
                                    <!--What's New -->
                                    <li id="menu-item-39425"
                                       class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39425">
                                       <a href="https://www.familysearch.org/blog/en/category/about-familysearch/whats-new-at-familysearch"><?php $t ('header-whatsnew');?></a>
                                    </li>
                                    <!-- Consultant Resources -->
                                    <li id="menu-item-39426"
                                       class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39426">
                                       <a href="https://www.familysearch.org/ask/planner/calling"><?php $t ('header-consultantresources');?></a>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                     </div><!-- #et-secondary-menu -->
                  </div> <!-- .container -->
               </div><!-- #secondary-navigation -->
               <!-- Sign in and Register links -->
               <!-- The following lines of code create the Sign In and the Free Account button at the top right of the wiki page  -->
               <!--  It is important to be aware that the formatting has been hardcoded because of conflicts with flex coding that has been  -->
               <!--  Added to the header menu items.  This may cause issues at a later time, so I am flagging it here, just in case.  (Amie)-->
               <div class="menu-header-links-bottom-container">
                  <ul id="menu-header-links-bottom" class="menu">
                     <!-- Sign In link -->
                     <li id="menu-item-38439"
                        class="header-right-link menu-item menu-item-type-custom menu-item-object-custom menu-item-38439"
                        style="float:left; font-size:16px; color:#666662;">
                        <a href="/wiki/<?php $t ('header-language');?>/Special:UserLogin?returnto=<?php echo ( preg_replace (['%^/wiki/(de|en|es|fr|it|ja|ko|pt|ru|sv|zh)/%', '%\?.*$%'], '', $_SERVER['REQUEST_URI']) );?>"><?php $t ('header-signin');?></a>
                     </li>
                     <!-- Free Account button -->
                     <li id="menu-item-38440"
                        class="header-right-button menu-item menu-item-type-custom menu-item-object-custom menu-item-38440"
                        style="float:right; padding:10px;">
                        <a href="https://www.familysearch.org/register/"><?php $t ('header-freeaccount');?></a>
                     </li>
                     <!--20190325 - styled the sign out link -->
				      <li id="logout-link" style="display:none; float:left; font-size:1rem; color:#666662;" class="header-right-link menu-item menu-item-type-custom menu-item-object-custom">
					      <a href="/wiki/<?php $t ('header-language');?>/Special:UserLogout?returnto=<?php echo ( preg_replace (['%^/wiki/(de|en|es|fr|it|ja|ko|pt|ru|sv|zh)/%', '%\?.*$%' ], '', $_SERVER['REQUEST_URI']) );?>" class="user-submenu-link" data-test="NavigationLogOut" data-component="AdobeLinkTracker" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;li_hdr_signout&quot;}">
                    <?php $t ('header-signout');?>
					         </a>
				      </li>
                  </ul>
               </div><!-- end Sign In and Free Account section of header code -->
            </div>  <!-- end #header-right-section -->

			<!-- Mobile view menu, under the MORE Hamburger menu.-->
            <div id="et-mobile-nav-menu">
               <div class="mobile-nav closed">
                  <span class="mobile-menu-bar mobile-menu-bar-toggle"><?php $t ('header-more');?></span>

                  <ul id="top-menu" class="nav">
					<?php if ( $wgUser->mId == 0 ) { ?>
					<div class="mobile-account ">

					 <a href="/auth/familysearch/login?fhf=true" class="mobile-account-first fs-button fs-button--small fs-button--recommended" data-config="lo_hdr_login" data-component-init="AdobeLinkTracker"><?php $t ('header-signin');?></a>

					 <a href="/register/" class="mobile-account-last fs-button fs-button--small" data-config="lo_hdr_register" data-component-init="AdobeLinkTracker"><?php $t ('header-freeaccount');?></a>

	   				</div>
					<?php } ?>

                     <!-- Mobile view - Family Tree menu  with dropdown menu items -->
                     <li id="menu-item-39787" class="menu-item icon-tree menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-39787">
                        <a href="https://www.familysearch.org/tree/pedigree"><?php $t ('header-familytree');?></a>
                        <!-- begin dropdown menu items in Family Tree -->
                        <ul class="sub-menu"  rel="0" style="display: none;">
                           <!-- Family Tree -> Tree menu item -->
                           <li id="menu-item-39788"
                              class="menu-item icon-tree menu-item-type-custom menu-item-object-custom menu-item-39788">
                              <a href="https://www.familysearch.org/tree/pedigree"><?php $t ('header-tree');?></a>
                           </li>
                           <!-- Family Tree -> Person menu item -->
                           <li id="menu-item-39789"
                              class="menu-item icon-tree menu-item-type-custom menu-item-object-custom menu-item-39789">
                              <a href="https://www.familysearch.org/tree/person"><?php $t ('header-person');?></a>
                           </li>
                           <!-- Family Tree -> Find menu item -->
                           <li id="menu-item-39790"
                              class="menu-item icon-tree menu-item-type-custom menu-item-object-custom menu-item-39790">
                              <a href="https://www.familysearch.org/tree/find"><?php $t ('header-find');?></a>
                           </li>
                           <!-- Family Tree -> Lists menu item -->
                           <li id="menu-item-39791"
                              class="menu-item icon-tree menu-item-type-custom menu-item-object-custom menu-item-39791">
                              <a href="https://www.familysearch.org/tree/list/people"><?php $t ('header-lists');?></a>
                           </li>
                        </ul>
                     </li>  <!-- end of Family Tree menu item and dropdown menu -->
                     <!-- Mobile view - Search header item with dropdown menu items -->
                     <li id="menu-item-39793" class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-39793">
                        <a href="https://www.familysearch.org/search"><?php $t ('header-search');?></a>
                        <!-- begin Search dropdown menu -->
                        <ul class="sub-menu"  rel="0" style="display: none;">
                           <!-- Search -> Records -->
                           <li id="menu-item-39794"
                              class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39794">
                              <a href="https://www.familysearch.org/search"><?php $t ('header-records');?></a>
                           </li>
                           <!-- Search -> Family Tree -->
                           <li id="menu-item-39795"
                              class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39795">
                              <a href="https://www.familysearch.org/tree/find/name"><?php $t ('header-familytree');?></a>
                           </li>
                           <!-- Search -> Genealogies -->
                           <li id="menu-item-39796"
                              class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39796">
                              <a href="https://www.familysearch.org/search/family-trees"><?php $t ('header-genealogies');?></a>
                           </li>
                           <!-- Search -> Catalog -->
                           <li id="menu-item-39797"
                              class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39797">
                              <a href="https://www.familysearch.org/search/catalog"><?php $t ('header-catalog');?></a>
                           </li>
                           <!-- Search -> Books -->
                           <li id="menu-item-39798"
                              class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39798">
                              <a href="https://www.familysearch.org/library/books"><?php $t ('header-books');?></a>
                           </li>
                           <!-- Search -> Research Wiki -->
                           <li id="menu-item-39799"
                              class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39799">
                              <a href="/wiki/<?php $t ('header-language');?>"><?php $t ('header-researchwiki');?></a>
                           </li>
                        </ul>
                     </li>
                     <!-- Mobile view - Memories dropdown menu in header -->
                     <li id="menu-item-39800" class="menu-item icon-memories menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-39800">
                        <a href="https://www.familysearch.org/photos/"><?php $t ('header-memories');?></a>
                        <ul class="sub-menu"  rel="0" style="display: none;">
                           <!-- Memories -> Overview -->
                           <li id="menu-item-39801"
                              class="menu-item icon-memories menu-item-type-custom menu-item-object-custom menu-item-39801">
                              <a href="https://www.familysearch.org/photos/"><?php $t ('header-overview');?></a>
                           </li>
                           <!-- Memories -> Gallery -->
                           <li id="menu-item-39802"
                              class="menu-item icon-memories menu-item-type-custom menu-item-object-custom menu-item-39802">
                              <a href="https://www.familysearch.org/photos/gallery"><?php $t ('header-gallery');?></a>
                           </li>
                           <!-- Memories -> People -->
                           <li id="menu-item-39803"
                              class="menu-item icon-memories menu-item-type-custom menu-item-object-custom menu-item-39803">
                              <a href="https://www.familysearch.org/photos/people"><?php $t ('header-people');?></a>
                           </li>
                           <!-- Memories -> Find -->
                           <li id="menu-item-39804"
                              class="menu-item icon-memories menu-item-type-custom menu-item-object-custom menu-item-39804">
                              <a href="https://www.familysearch.org/photos/find"><?php $t ('header-find');?></a>
                           </li>
                        </ul>
                     </li><!-- end Memories menu item -->
                     <!-- Mobile view - Indexing dropdown menu in header -->
                     <li id="menu-item-39805"
                        class="menu-item icon-indexing menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-39805">
                        <a href="https://www.familysearch.org/indexing/"><?php $t ('header-indexing');?></a>
                        <ul class="sub-menu"  rel="0" style="display: none;">
                           <!-- Indexing -> Overview -->
                           <li id="menu-item-39806"
                              class="menu-item icon-indexing menu-item-type-custom menu-item-object-custom menu-item-39806">
                              <a href="https://www.familysearch.org/indexing/"><?php $t ('header-overview');?></a>
                           </li>
                           <!-- Memories -> Web Indexing -->
                           <li id="menu-item-39807"
                              class="menu-item icon-indexing menu-item-type-custom menu-item-object-custom menu-item-39807">
                              <a href="https://www.familysearch.org/indexing/my-indexing"><?php $t ('header-webindexing');?></a>
                           </li>
                           <!-- Memories -> Find A Project -->
                           <li id="menu-item-39808"
                              class="menu-item icon-indexing menu-item-type-custom menu-item-object-custom menu-item-39808">
                              <a href="https://www.familysearch.org/indexing/projects"><?php $t ('header-findaproject');?></a>
                           </li>
                           <!-- Memories -> Help Resources -->
                           <li id="menu-item-39809"
                              class="menu-item icon-indexing menu-item-type-custom menu-item-object-custom menu-item-39809">
                              <a href="https://www.familysearch.org/indexing/help/"><?php $t ('header-helpresources');?></a>
                           </li>
                        </ul>
                     </li> <!-- end Indexing menu item -->
                     <!-- Mobile view - Help menu dropdown -->
                     <li
                     class="header-top-link icon-help menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-39417">
                     <a href="#"><?php $t ('header-help');?></a>
                     <ul class="sub-menu" rel="0" style="display: none;">
                        <!-- Help -> Volunteer -->
                        <li
                           class="header-top-link menu-item menu-item-type-custom menu-item-object-custom menu-item-39416">
                           <a href="https://www.familysearch.org/ask/volunteer"><?php $t ('header-volunteer');?></a>
                        </li>
                        <!-- Help -> Help Center -->
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39418">
                           <a href="https://www.familysearch.org/ask/landing"><?php $t ('header-helpcenter');?></a>
                        </li>
                        <!-- Help -> Getting Started -->
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39420">
                           <a href="https://www.familysearch.org/ask/gettingStarted"><?php $t ('header-gettingstarted');?></a>
                        </li>
                        <!-- Help -> Contact Us -->
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39421">
                           <a href="https://www.familysearch.org/ask/help"><?php $t ('header-contactus');?></a>
                        </li>
                        <!-- Help -> Learning Center -->
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39422">
                           <a
                              href="https://www.familysearch.org/ask/landing?search=Getting%20Started&amp;show=lessons&amp;message=true"><?php $t ('header-learningcenter');?></a>
                        </li>
                        <!-- Help -> Community -->
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39423">
                           <a href="https://www.familysearch.org/ask/communities"><?php $t ('header-community');?></a>
                        </li>
                        <!-- Help -> My Cases -->
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39424">
                           <a href="https://www.familysearch.org/ask/mycases#/"><?php $t ('header-mycases');?></a>
                        </li>
                        <!-- Help -> Research Wiki -->
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39427">
                           <a href="/wiki/<?php $t ('header-language');?>"><?php $t ('header-researchwiki');?></a>
                        </li>
                        <!-- Help -> What's New -->
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39425">
                           <a href="https://www.familysearch.org/blog/en/category/about-familysearch/whats-new-at-familysearch"><?php $t ('header-whatsnew');?></a>
                        </li>
                        <!-- Help -> Consultant Resources -->
                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39426">
                           <a href="https://www.familysearch.org/ask/planner/calling"><?php $t ('header-consultantresources');?></a>
                        </li>
                     </ul>
                  </li>
               </ul><!-- end mobile-nav-view -->
               <div class="mobile-menu-overlay"></div>
            </div>
         </div>
         <!-- Top menu for full screen displays -->
         <nav id="top-menu-nav" class="noprint">
               <ul id="top-menu" class="nav">
                  <!-- Full display - Family Tree menu item with dropdown menu -->
                  <li
                     class="menu-item icon-tree menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-39787">
                     <a href="https://www.familysearch.org/tree/pedigree"><?php $t ('header-familytree');?></a>
                     <!-- start dropdown menu for Family Tree -->
                     <ul class="sub-menu">
                        <!-- Family Tree - Tree -->
                        <li class="menu-item icon-tree menu-item-type-custom menu-item-object-custom menu-item-39788">
                           <a href="https://www.familysearch.org/tree/pedigree"><?php $t ('header-tree');?></a>
                        </li>
                        <!-- Family Tree -> Person -->
                        <li class="menu-item icon-tree menu-item-type-custom menu-item-object-custom menu-item-39789">
                           <a href="https://www.familysearch.org/tree/person"><?php $t ('header-person');?></a>
                        </li>
                        <!-- Family Tree -> Find -->
                        <li class="menu-item icon-tree menu-item-type-custom menu-item-object-custom menu-item-39790">
                           <a href="https://www.familysearch.org/tree/find"><?php $t ('header-find');?></a>
                        </li>
                        <!-- Family Tree -> Lists -->
                        <li class="menu-item icon-tree menu-item-type-custom menu-item-object-custom menu-item-39791">
                           <a href="https://www.familysearch.org/tree/list/people"><?php $t ('header-lists');?></a>
                        </li>
                     </ul>
                  </li>  <!-- end Family Tree menu item in full display header -->
                  <!-- Full display - Search menu with dropdown menu -->
                  <li class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-39793">
                     <a href="https://www.familysearch.org/search"><?php $t ('header-search');?></a>
                     <!-- Create dropdown menu-->
                     <ul class="sub-menu">
                        <!-- Search -> Records -->
                        <li class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39794">
                           <a href="https://www.familysearch.org/search"><?php $t ('header-records');?></a>
                        </li>
                        <!-- Search -> Family Tree -->
                        <li class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39795">
                           <a href="https://www.familysearch.org/tree/find/name"><?php $t ('header-familytree');?></a>
                        </li>
                        <!-- Search -> Genealogies -->
                        <li class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39796">
                           <a href="https://www.familysearch.org/search/family-trees"><?php $t ('header-genealogies');?></a>
                        </li>
                        <!-- Search -> Catalog -->
                        <li class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39797">
                           <a href="https://www.familysearch.org/search/catalog"><?php $t ('header-catalog');?></a>
                        </li>
                        <!-- Search -> Books -->
                        <li class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39798">
                           <a href="https://www.familysearch.org/library/books"><?php $t ('header-books');?></a>
                        </li>
                        <!-- Search -> Research Wiki -->
                        <li class="menu-item icon-search menu-item-type-custom menu-item-object-custom menu-item-39799">
                           <a href="/wiki/<?php $t ('header-language');?>"><?php $t ('header-researchwiki');?></a>
                        </li>
                     </ul>
                  </li><!-- end Search menu and dropdown -->
                  <!-- Full display - Create Memories menu item and dropdown menu -->
                  <li class="menu-item icon-memories menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-39800">
                     <a href="https://www.familysearch.org/photos/"><?php $t ('header-memories');?></a>
                     <!-- Start dropdown menu -->
                     <ul class="sub-menu">
                        <!-- Memories -> Overview  -->
                        <li class="menu-item icon-memories menu-item-type-custom menu-item-object-custom menu-item-39801">
                           <a href="https://www.familysearch.org/photos/"><?php $t ('header-overview');?></a>
                        </li>
                        <!-- Memories -> Gallery  -->
                        <li class="menu-item icon-memories menu-item-type-custom menu-item-object-custom menu-item-39802">
                           <a href="https://www.familysearch.org/photos/gallery"><?php $t ('header-gallery');?></a>
                        </li>
                        <!-- Memories -> People -->
                        <li class="menu-item icon-memories menu-item-type-custom menu-item-object-custom menu-item-39803">
                           <a href="https://www.familysearch.org/photos/people"><?php $t ('header-people');?></a>
                        </li>
                        <!-- Memories -> Find -->
                        <li class="menu-item icon-memories menu-item-type-custom menu-item-object-custom menu-item-39804">
                           <a href="https://www.familysearch.org/photos/find"><?php $t ('header-find');?></a>
                        </li>
                     </ul>
                  </li><!-- end Memories menu item and dropdown menu -->
                  <!-- Full display - Start Indexing header menu item, with dropdown menu -->
                  <li class="menu-item icon-indexing menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-39805">
                     <a href="https://www.familysearch.org/indexing/"><?php $t ('header-indexing');?></a>
                     <!-- Start dropdown menu -->
                     <ul class="sub-menu">
                        <!-- Indexing -> Overview -->
                        <li class="menu-item icon-indexing menu-item-type-custom menu-item-object-custom menu-item-39806">
                           <a href="https://www.familysearch.org/indexing/"><?php $t ('header-overview');?></a>
                        </li>
                        <!-- Indexing -> Web Indexing -->
                        <li class="menu-item icon-indexing menu-item-type-custom menu-item-object-custom menu-item-39807">
                           <a href="https://www.familysearch.org/indexing/my-indexing"><?php $t ('header-webindexing');?></a>
                        </li>
                        <!-- Indexing -> Find a Project -->
                        <li class="menu-item icon-indexing menu-item-type-custom menu-item-object-custom menu-item-39808">
                           <a href="https://www.familysearch.org/indexing/projects"><?php $t ('header-findaproject');?></a>
                        </li>
                        <!-- Indexing -> Help Resources -->
                        <li class="menu-item icon-indexing menu-item-type-custom menu-item-object-custom menu-item-39809">
                           <a href="https://www.familysearch.org/indexing/help/"><?php $t ('header-helpresources');?></a>
                        </li>
                     </ul> <!-- end Indexing menu item and dropdown -->
                  </li>
<?php
// Show the Temple Menu
$sessionId = getSessionIdFromCookie();
if ( $sessionId ) {
	$hasPermission = checkTemplePermission ($sessionId);
	$hasPref = hasPref($sessionId);
	if ($hasPermission && $hasPref) {
		include ('templeMenu.php');
	}
}

?>
               </ul>
		   </nav> <!-- end Full display top menu -->
         </div><!-- #et-top-navigation -->
      </div><!-- #primary-navigation -->
   </div><!-- .container -->
   <div class="et_search_outer">
      <div class="container et_search_form_container">
         <!-- The search form seems to function (ajax?) regardless of what the form action is -->
         <form role="search" method="get" class="et-search-form" action="index.php">
            <input type="search" class="et-search-field" placeholder="<?php $t ('header-searchboxplaceholder');?>" value="" name="s"
               title="<?php $t ('header-searchfor');?>:">
         </form>
         <span class="et_close_search_field"></span>
      </div> <!-- end .container -->
     </div>  <!-- end .et_search_outer -->
</header>