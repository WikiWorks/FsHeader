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


// Show the Temple Menu?
$showTempleMenu = false;
$sessionId = getSessionIdFromCookie();
if ( $sessionId ) {
	$hasPermission = checkTemplePermission ($sessionId);
	$hasPref = hasPref($sessionId);
	if ($hasPermission && $hasPref) {
    $showTempleMenu = true;
  }
}

?>

<header id="header2019" class="logged-out">
  <div class="top">
    <div class="left">
      <h1>
        <a class="logo" href="/" data-test="header-logo" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_logo&quot;}" data-component-init="AdobeLinkTracker"><span class="sr-only">Family Search</span></a></h1>
      <nav id="primaryNav">
        
        <div class="primary-nav-item nav-menu-parent ">
          <button class="primary-nav-text nav-menu-trigger" data-config="lo_hdr9_tree" data-component-init="AdobeLinkTracker" aria-expanded="false"><?php $t ('header-familytree');?></button>
          <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu" style="">
            <li class="submenu-item">
              <a href="/tree/overview" class="submenu-link" data-config="lo_hdr9_tree:overview" data-test="overview" data-component-init="AdobeLinkTracker"><?php $t ('header-overview');?></a>
            </li>
            <li class="submenu-item">
              <a href="/tree/pedigree" class="submenu-link" data-config="lo_hdr9_tree:pedigree" data-test="pedigree" data-component-init="AdobeLinkTracker"><?php $t ('header-tree');?></a>
            </li>
            <li class="submenu-item">
              <a href="/tree/person" class="submenu-link" data-config="lo_hdr9_tree:person" data-test="person" data-component-init="AdobeLinkTracker"><?php $t ('header-person');?></a>
            </li>
            <li class="submenu-item">
              <a href="/tree/find" class="submenu-link" data-config="lo_hdr9_tree:findinTree" data-test="findinTree" data-component-init="AdobeLinkTracker"><?php $t ('header-find');?></a>
            </li>
            <li class="submenu-item">
              <a href="/tree/following" class="submenu-link" data-config="lo_hdr9_tree:following" data-test="following" data-component-init="AdobeLinkTracker"><?php $t ('header-following');?></a>
            </li>
            <li class="submenu-item">
              <a href="/tree/contributions" class="submenu-link" data-config="lo_hdr9_tree:contributions" data-test="contributions" data-component-init="AdobeLinkTracker"><?php $t ('header-contributions');?></a>
            </li>
          </ul>
        </div>
      
        <div class="primary-nav-item nav-menu-parent ">
          <button class="primary-nav-text nav-menu-trigger" data-config="lo_hdr9_srch" data-component-init="AdobeLinkTracker"><?php $t ('header-search');?></button>
          <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
            <li class="submenu-item">
              <a href="/search/" class="submenu-link" data-config="lo_hdr9_srch:records" data-test="records" data-component-init="AdobeLinkTracker"><?php $t ('header-records');?></a>
            </li>
            <li class="submenu-item">
              <a href="/records/images/" class="submenu-link" data-config="lo_hdr9_srch:images" data-test="images" data-component-init="AdobeLinkTracker"><?php $t ('header-images');?></a>
            </li>
            <li class="submenu-item">
              <a href="/tree/find/name" class="submenu-link" data-config="lo_hdr9_srch:findInFamilyTree" data-test="findInFamilyTree" data-component-init="AdobeLinkTracker"><?php $t ('header-familytree');?></a>
            </li>
            <li class="submenu-item">
              <a href="/search/family-trees" class="submenu-link" data-config="lo_hdr9_srch:genealogies" data-test="genealogies" data-component-init="AdobeLinkTracker"><?php $t ('header-genealogies');?></a>
            </li>
            <li class="submenu-item">
              <a href="/search/catalog" class="submenu-link" data-config="lo_hdr9_srch:catalog" data-test="catalog" data-component-init="AdobeLinkTracker"><?php $t ('header-catalog');?></a>
            </li>
            <li class="submenu-item books">
              <a href="https://www.familysearch.org/library/books/" class="submenu-link" data-config="lo_hdr9_srch:books" data-test="books" data-component-init="AdobeLinkTracker"><?php $t ('header-books');?></a>
            </li>
            <li class="submenu-item">
              <a href="/wiki/en/Main_Page" class="submenu-link" data-config="lo_hdr9_srch:wiki" data-test="wiki" data-component-init="AdobeLinkTracker"><?php $t ('header-researchwiki');?></a>
            </li>
          </ul>
        </div>
        
        <div class="primary-nav-item nav-menu-parent ">
          <button class="primary-nav-text nav-menu-trigger" data-config="lo_hdr9_photos" data-component-init="AdobeLinkTracker"><?php $t ('header-memories');?></button>
          <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
            <li class="submenu-item">
              <a href="/photos/" class="submenu-link" data-config="lo_hdr9_photos:overview" data-test="overview" data-component-init="AdobeLinkTracker"><?php $t ('header-overview');?></a>
            </li>
            <li class="submenu-item">
              <a href="/photos/gallery" class="submenu-link" data-config="lo_hdr9_photos:gallery" data-test="gallery" data-component-init="AdobeLinkTracker"><?php $t ('header-gallery');?></a>
            </li>
            <li class="submenu-item">
              <a href="/photos/people" class="submenu-link" data-config="lo_hdr9_photos:people" data-test="people" data-component-init="AdobeLinkTracker"><?php $t ('header-people');?></a>
            </li>
            <li class="submenu-item">
              <a href="/photos/find" class="submenu-link" data-config="lo_hdr9_photos:find" data-test="find" data-component-init="AdobeLinkTracker"><?php $t ('header-find');?></a>
            </li>
          </ul>            
        </div>
        
        <div class="primary-nav-item nav-menu-parent ">
          <button class="primary-nav-text nav-menu-trigger" data-config="lo_hdr9_indexing" data-component-init="AdobeLinkTracker" aria-expanded="false"><?php $t ('header-indexing');?></button>
          <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
            <li class="submenu-item">
              <a href="/indexing/" class="submenu-link" data-config="lo_hdr9_indexing:overview" data-test="overview" data-component-init="AdobeLinkTracker"><?php $t ('header-overview');?></a>
            </li>
            <li class="submenu-item">
              <a href="/indexing/my-indexing" class="submenu-link" data-config="lo_hdr9_indexing:web_indexing" data-test="web_indexing" data-component-init="AdobeLinkTracker"><?php $t ('header-webindexing');?></a>
            </li>
            <li class="submenu-item">
              <a href="/indexing/projects" class="submenu-link" data-config="lo_hdr9_indexing:find_a_project" data-test="find_a_project" data-component-init="AdobeLinkTracker"><?php $t ('header-findaproject');?></a>
            </li>
            <li class="submenu-item">
              <a href="/indexing/help" class="submenu-link" data-config="lo_hdr9_indexing:get_help" data-test="get_help" data-component-init="AdobeLinkTracker"><?php $t ('header-helpresources');?></a>
            </li>
          </ul>
        </div>
        
        <div class="primary-nav-item nav-menu-parent ">
          <button class="primary-nav-text nav-menu-trigger" data-config="lo_hdr9_activities" data-component-init="AdobeLinkTracker" aria-expanded="false"><?php $t ('header-activities');?></button>
          <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu" style="">
            <li class="submenu-item">
              <a href="/discovery/" class="submenu-link" data-config="lo_hdr9_activities:allActivities" data-test="allActivities" data-component-init="AdobeLinkTracker"><?php $t ('header-allactivities');?></a>
            </li>
            <li class="submenu-item">
              <a href="/discovery/explore" class="submenu-link" data-config="lo_hdr9_activities:whereamifrom" data-test="whereamifrom" data-component-init="AdobeLinkTracker"><?php $t ('header-whereamifrom');?></a>
            </li>
            <li class="submenu-item">
              <a href="/discovery/about" class="submenu-link" data-config="lo_hdr9_activities:allAboutMe" data-test="allAboutMe" data-component-init="AdobeLinkTracker"><?php $t ('header-allaboutme');?></a>
            </li>
            <li class="submenu-item">
              <a href="/discovery/compare" class="submenu-link" data-config="lo_hdr9_activities:compareAFace" data-test="compareAFace" data-component-init="AdobeLinkTracker"><?php $t ('header-compareaface');?></a>
            </li>
            <li class="submenu-item">
              <a href="/discovery/record" class="submenu-link" data-config="lo_hdr9_activities:recordMyStory" data-test="recordMyStory" data-component-init="AdobeLinkTracker"><?php $t ('header-recordmystory');?></a>
            </li>
            <li class="submenu-item">
              <a href="/discovery/picture" class="submenu-link" data-config="lo_hdr9_activities:pictureMyHeritage" data-test="pictureMyHeritage" data-component-init="AdobeLinkTracker"><?php $t ('header-picturemyheritage');?></a>
            </li>
            <li class="submenu-item">
              <a href="/discovery/activities/" class="submenu-link" data-config="lo_hdr9_activities:inHomeActivities" data-test="inHomeActivities" data-component-init="AdobeLinkTracker"><?php $t ('header-inhomeactivities');?></a>
            </li>
          </ul>
        </div>

<?php
if ($showTempleMenu) {
?>
        <div class="primary-nav-item nav-menu-parent nav-temple-link">
          <button type="button" class="primary-nav-text nav-menu-trigger" data-component="AdobeLinkTracker" data-config="li_hdr9_temple" aria-haspopup="true" aria-expanded="false" aria-controls="temple" aria-owns="temple"><?php $t ('header-temple');?></button>
          <ul id="temple" class="submenu" aria-hidden="true" data-submenu aria-label="Submenu">
            <li class="submenu-item">
              <a href="/temple/reservations" class="submenu-link" data-component="AdobeLinkTracker"
              data-config="li_hdr9_temple:all" data-test="all"><?php $t ('header-allreserved');?></a>
            </li>
            <li class="submenu-item">
              <a href="/temple/shared" class="submenu-link" data-component="AdobeLinkTracker"
              data-config="li_hdr9_temple:shared" data-test="shared"><?php $t ('header-shared');?></a>
            </li>
            <li class="submenu-item">
              <a href="/temple/ordinancesready" class="submenu-link" data-component="AdobeLinkTracker"
              data-config="li_hdr9_temple:ordinancesReady" data-test="ordinancesReady"><?php $t ('header-ordinancesready');?></a>
            </li>
          </ul>   
        </div>

<?php
}
?>
    
      </nav>
    </div>

    <div class="right">
      <nav id="secondaryNav">
        <div class="nav-menu-parent">
          <button id="helpLink" class="nav-menu-trigger" aria-haspopup="true" aria-expanded="false" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help&quot;}" data-component-init="AdobeLinkTracker">
            <img src="https://edge.fscdn.org/assets/components/hf/assets/img/icons/header-help-c9bf91771596fb21d30797738c2aa37a.svg">
            <span class="nav-trigger-text"><?php $t ('header-help');?></span>
          </button>
          <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu" style="">
            <li class="submenu-item"><a href="/home/etb_gettingstarted" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:gettingStarted&quot;}" data-component-init="AdobeLinkTracker"><?php $t ('header-gettingstarted');?></a></li>
            <li class="submenu-item"><a href="/ask/landing" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:helpCenter&quot;}" data-component-init="AdobeLinkTracker"><?php $t ('header-helpcenter');?></a></li>
            <li class="submenu-item"><a href="/help/" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:contactUs&quot;}" data-component-init="AdobeLinkTracker"><?php $t ('header-contactus');?></a></li>
            <li class="submenu-item"><a href="/help/communities" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:community&quot;}" data-component-init="AdobeLinkTracker"><?php $t ('header-community');?></a></li>
            <li class="submenu-item"><a href="/ask/mycases#/" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:myCases&quot;}" data-component-init="AdobeLinkTracker"><?php $t ('header-mycases');?></a></li>
            <li class="submenu-item"><a href="/wiki/en/Main_Page" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:researchWiki&quot;}" data-component-init="AdobeLinkTracker"><?php $t ('header-researchwiki');?></a></li>
            <li class="submenu-item"><a href="/help/helper" class="submenu-link" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_help:helperResources&quot;}" data-component-init="AdobeLinkTracker"><?php $t ('header-consultantresources');?></a></li>
          </ul>
        </div>
        
         <a href="/messaging/mailbox" id="messagesLink" style="display:none;" target="_blank" data-test="header-nav-messages" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;li_hdr9_msgs&quot;}" data-component-init="AdobeLinkTracker">
            <img src="https://edge.fscdn.org/assets/components/hf/assets/img/icons/header-messages-f81399c87551f2691dd276a77bc31216.svg">
            <span class="unread-message-badge"></span>
            <span class="nav-trigger-text"><?php $t ('header-messages');?></span>
         </a>  
         <a class="highlight" id="signinLink" href="/wiki/<?php $t ('header-language');?>/Special:UserLogin?returnto=<?php echo ( preg_replace (['%^/wiki/(de|en|es|fr|it|ja|ko|pt|ru|sv|zh)/%', '%\?.*$%'], '', $_SERVER['REQUEST_URI']) );?>"><?php $t ('header-signin');?></a>
         <a href="/register/" id="registerLink" class="highlight border" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_register&quot;}" data-component-init="AdobeLinkTracker"><?php $t ('header-createaccount');?></a>
         
         <a id="logoutLink" style="display:none; float:left;" class="highlight" href="/wiki/<?php $t ('header-language');?>/Special:UserLogout?returnto=<?php echo ( preg_replace (['%^/wiki/(de|en|es|fr|it|ja|ko|pt|ru|sv|zh)/%', '%\?.*$%' ], '', $_SERVER['REQUEST_URI']) );?>" class="user-submenu-link" data-test="NavigationLogOut" data-component="AdobeLinkTracker" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;li_hdr_signout&quot;}"><?php $t ('header-signout');?></a>
        
        <button id="hamburgerLink">
          <img src="https://edge.fscdn.org/assets/components/hf/assets/img/icons/header-hamburger-5eccc4487e684c3f2bdb4f6810d56851.svg">
        </button>
      </nav>
    </div>

  </div><!-- end top -->

  <div id="mobileDrawerContainer" class="">

    <div id="mobileDrawer">
      <button id="closeDrawer">
        <img src="https://edge.fscdn.org/assets/components/hf/assets/img/icons/close-934062c39475a612a1ac8d6bae631b56.svg">
      </button>
      <div id="loAccount">
        <a class="highlight" id="signinLink" href="/wiki/<?php $t ('header-language');?>/Special:UserLogin?returnto=<?php echo ( preg_replace (['%^/wiki/(de|en|es|fr|it|ja|ko|pt|ru|sv|zh)/%', '%\?.*$%'], '', $_SERVER['REQUEST_URI']) );?>"><?php $t ('header-signin');?></a>
        <a href="/register/" id="registerLink" class="highlight border" data-config="{&quot;type&quot;: &quot;o&quot;, &quot;name&quot;: &quot;lo_hdr9_register&quot;}" data-component-init="AdobeLinkTracker"><?php $t ('header-createaccount');?></a>    
      </div>
      
      <div class="">
        <div class="menuRow menuTrigger" data-config="lo_hdr9_tree" data-component-init="AdobeLinkTracker" aria-expanded="false"><?php $t ('header-familytree');?></div>
        <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
          <li class="menuRow">
            <a href="/tree/pedigree" class="submenu-link" data-config="lo_hdr9_tree:pedigree" data-test="pedigree" data-component-init="AdobeLinkTracker"><?php $t ('header-familytree');?></a>
          </li>
          <li class="menuRow">
            <a href="/tree/person" class="submenu-link" data-config="lo_hdr9_tree:person" data-test="person" data-component-init="AdobeLinkTracker"><?php $t ('header-person');?></a>
          </li>
          <li class="menuRow">
            <a href="/tree/find" class="submenu-link" data-config="lo_hdr9_tree:findinTree" data-test="findinTree" data-component-init="AdobeLinkTracker"><?php $t ('header-find');?></a>
          </li>
          <li class="menuRow">
            <a href="/tree/following" class="submenu-link" data-config="lo_hdr9_tree:following" data-test="following" data-component-init="AdobeLinkTracker"><?php $t ('header-following');?></a>
          </li>
          <li class="menuRow">
            <a href="/tree/contributions" class="submenu-link" data-config="lo_hdr9_tree:contributions" data-test="contributions" data-component-init="AdobeLinkTracker"><?php $t ('header-contributions');?></a>
          </li>
        </ul>          
      </div>
      
      <div class="">
        <div class="menuRow menuTrigger" data-config="lo_hdr9_srch" data-component-init="AdobeLinkTracker" aria-expanded="false"><?php $t ('header-search');?></div>
        <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
          <li class="menuRow">
            <a href="/search/" class="submenu-link" data-config="lo_hdr9_srch:records" data-test="records" data-component-init="AdobeLinkTracker"><?php $t ('header-records');?></a>
          </li>
          <li class="menuRow">
            <a href="/records/images/" class="submenu-link" data-config="lo_hdr9_srch:images" data-test="images" data-component-init="AdobeLinkTracker"><?php $t ('header-images');?></a>
          </li>
          <li class="menuRow">
            <a href="/tree/find/name" class="submenu-link" data-config="lo_hdr9_srch:findInFamilyTree" data-test="findInFamilyTree" data-component-init="AdobeLinkTracker"><?php $t ('header-familytree');?></a>
          </li>
          <li class="menuRow">
            <a href="/search/family-trees" class="submenu-link" data-config="lo_hdr9_srch:genealogies" data-test="genealogies" data-component-init="AdobeLinkTracker"><?php $t ('header-genealogies');?></a>
          </li>
          <li class="menuRow">
            <a href="/search/catalog" class="submenu-link" data-config="lo_hdr9_srch:catalog" data-test="catalog" data-component-init="AdobeLinkTracker"><?php $t ('header-catalog');?></a>
          </li>
          <li class="menuRow books">
            <a href="https://www.familysearch.org/library/books/" class="submenu-link" data-config="lo_hdr9_srch:books" data-test="books" data-component-init="AdobeLinkTracker"><?php $t ('header-books');?></a>
          </li>
          <li class="menuRow">
            <a href="/wiki/en/Main_Page" class="submenu-link" data-config="lo_hdr9_srch:wiki" data-test="wiki" data-component-init="AdobeLinkTracker"><?php $t ('header-researchwiki');?></a>
          </li>
        </ul>
      </div>
      
      <div class="">
        <div class="menuRow menuTrigger" data-config="lo_hdr9_photos" data-component-init="AdobeLinkTracker" aria-expanded="false"><?php $t ('header-memories');?></div>
        <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
          <li class="menuRow">
            <a href="/photos/" class="submenu-link" data-config="lo_hdr9_photos:overview" data-test="overview" data-component-init="AdobeLinkTracker"><?php $t ('header-overview');?></a>
          </li>
          <li class="menuRow">
            <a href="/photos/gallery" class="submenu-link" data-config="lo_hdr9_photos:gallery" data-test="gallery" data-component-init="AdobeLinkTracker"><?php $t ('header-gallery');?></a>
          </li>
          <li class="menuRow">
            <a href="/photos/people" class="submenu-link" data-config="lo_hdr9_photos:people" data-test="people" data-component-init="AdobeLinkTracker"><?php $t ('header-people');?></a>
          </li>
          <li class="menuRow">
            <a href="/photos/find" class="submenu-link" data-config="lo_hdr9_photos:find" data-test="find" data-component-init="AdobeLinkTracker"><?php $t ('header-find');?></a>
          </li>
        </ul>
      </div>
    
      <div class="">
        <div class="menuRow menuTrigger" data-config="lo_hdr9_indexing" data-component-init="AdobeLinkTracker" aria-expanded="false"><?php $t ('header-indexing');?></div>
        <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
          <li class="menuRow">
            <a href="/indexing/" class="submenu-link" data-config="lo_hdr9_indexing:overview" data-test="overview" data-component-init="AdobeLinkTracker"><?php $t ('header-overview');?></a>
          </li>
          <li class="menuRow">
            <a href="/indexing/my-indexing" class="submenu-link" data-config="lo_hdr9_indexing:web_indexing" data-test="web_indexing" data-component-init="AdobeLinkTracker"><?php $t ('header-webindexing');?></a>
          </li>
          <li class="menuRow">
            <a href="/indexing/projects" class="submenu-link" data-config="lo_hdr9_indexing:find_a_project" data-test="find_a_project" data-component-init="AdobeLinkTracker"><?php $t ('header-findaproject');?></a>
          </li>
          <li class="menuRow">
            <a href="/indexing/help" class="submenu-link" data-config="lo_hdr9_indexing:get_help" data-test="get_help" data-component-init="AdobeLinkTracker"><?php $t ('header-helpresources');?></a>
          </li>
        </ul>
      </div>
      
      <div class="">
        <div class="menuRow menuTrigger" data-config="lo_hdr9_activities" data-component-init="AdobeLinkTracker" aria-expanded="false"><?php $t ('header-activities');?></div>
        <ul class="submenu" aria-hidden="true" data-submenu="" aria-label="Submenu">
          <li class="menuRow">
            <a href="/discovery/" class="submenu-link" data-config="lo_hdr9_activities:allActivities" data-test="allActivities" data-component-init="AdobeLinkTracker"><?php $t ('header-allactivities');?></a>
          </li>
          <li class="menuRow">
            <a href="/discovery/explore/" class="submenu-link" data-config="lo_hdr9_activities:whereAmIFrom" data-test="whereAmIFrom" data-component-init="AdobeLinkTracker"><?php $t ('header-whereamifrom');?></a>
          </li>
          <li class="menuRow">
            <a href="/discovery/about" class="submenu-link" data-config="lo_hdr9_activities:allAboutMe" data-test="allAboutMe" data-component-init="AdobeLinkTracker"><?php $t ('header-allaboutme');?></a>
          </li>
          <li class="menuRow">
            <a href="/discovery/compare" class="submenu-link" data-config="lo_hdr9_activities:compareAFace" data-test="compareAFace" data-component-init="AdobeLinkTracker"><?php $t ('header-compareaface');?></a>
          </li>
          <li class="menuRow">
            <a href="/discovery/record" class="submenu-link" data-config="lo_hdr9_activities:recordMyStory" data-test="recordMyStory" data-component-init="AdobeLinkTracker"><?php $t ('header-recordmystory');?></a>
          </li>
          <li class="menuRow">
            <a href="/discovery/picture" class="submenu-link" data-config="lo_hdr9_activities:pictureMyHeritage" data-test="pictureMyHeritage" data-component-init="AdobeLinkTracker"><?php $t ('header-picturemyheritage');?></a>
          </li>
          <li class="menuRow">
            <a href="/discovery/activities/" class="submenu-link" data-config="lo_hdr9_activities:inHomeActivities" data-test="inHomeActivities" data-component-init="AdobeLinkTracker"><?php $t ('header-inhomeactivities');?></a>
          </li>
        </ul>
      </div>

<?php
if ($showTempleMenu) {
?>

    <div class="">
      <div class="menuRow menuTrigger" aria-haspopup="true" aria-expanded="false" aria-controls="temple-mobile" aria-owns="temple-mobile" data-component="AdobeLinkTracker" data-config="li_hdr9_temple"><?php $t ('header-temple');?></div>
      <ul id="temple-mobile" class="submenu" aria-hidden="true" data-submenu aria-label="Submenu">
        <li class="menuRow">
          <a href="/temple/all" class="submenu-link" data-component="AdobeLinkTracker"
          data-config="li_hdr9_temple:all" data-test="all"><?php $t ('header-allreserved');?></a>
        </li>
        <li class="menuRow">
          <a href="/temple/shared" class="submenu-link" data-component="AdobeLinkTracker"
          data-config="li_hdr9_temple:shared" data-test="shared"><?php $t ('header-shared');?></a>
        </li>      
        <li class="menuRow">
          <a href="/temple/ordinancesready" class="submenu-link" data-component="AdobeLinkTracker"
          data-config="li_hdr9_temple:ordinancesReady" data-test="ordinancesReady"><?php $t ('header-ordinancesready');?></a>
        </li>
      </ul>
    </div>

<?php
}
?>

    </div><!-- end MobileDrawer -->

  </div><!-- end mobileDrawerContainer -->
</header>
