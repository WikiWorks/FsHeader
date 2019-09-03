
<!-- Create the menu items in the appropriate language for the footer : "About   Blog   Site Map    Solutions Gallery   Cookie Preferences"-->
<div id="fs-footer" style="width:100%; z-index:2; left:-0.25rem; padding-bottom:1.5rem;">
	<!-- when > = 992px -->
	<div class="footer-container">
		<div class="footer-nav">
			<div class="menu-footer-menu-container">
				<ul id="menu-footer-menu" class="menu" style="margin:0!important;">
					<!-- About -->
					<li id="menu-item-39483" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39483">
						<a href="https://www.familysearch.org/home/about"><?php $t ('footer-about');?></a>
					</li>
					<!-- Blog -->
					<li id="menu-item-39484"
						class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-39484">
						<a href="https://familysearch.org/blog/<?php $t ('header-language');?>"><?php $t ('footer-blog');?></a>
					</li>
					<!-- Site Map -->
					<li id="menu-item-39485" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39485">
						<a href="https://www.familysearch.org/site-map"><?php $t ('footer-sitemap');?></a>
					</li>
					<!-- Solutions Gallery -->
					<li id="menu-item-39486" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39486">
						<a href="https://partners.familysearch.org/solutionsgallery"><?php $t ('footer-solutionsgallery');?></a>
					</li>
				</ul>
			</div>

			<!-- create Cookie Preferences in footer -->

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



		</div> <!-- end class="footer-nav" -->

		<div class="copyright-notice">
			<!-- Create FamilySearch Terms of Use (Updated 'date') | Privacy Notice (Updated 'date') -->
			<div class="privacy_usage">
				<a href="https://www.familysearch.org/terms" data-test="footer-rights-of-use" data-component="AdobeLinkTracker"
					data-config="ftr_rights"><?php $t ('footer-termsofuse');?></a> <?php $t ('footer-termsupdated');?>&nbsp;|&nbsp;<a href="https://www.familysearch.org/privacy" data-test="footer-privacy_policy"
					data-component="AdobeLinkTracker" data-config="ftr_privacy"><?php $t ('footer-privacynotice');?>
				</a> <?php $t ('footer-privacyupdated');?>
			</div>
			<!-- Create Ⓒ 2019 by Intellectual Reserve, Inc. -->
			<span>&#x24B8; <?php $t ('footer-intellectualreserve');?></span>
			<span
				class="service-by-link">
				<a href="<?php $t ('footer-mormondotcomurl');?>" data-component="AdobeLinkTracker" data-test="footer-service-by-link"
					data-config="{&quot;type&quot;: &quot;e&quot;, &quot;name&quot;: &quot;ftr_srvcby&quot;}"><?php $t ('footer-ldschurch');?></a>
			</span>
		</div> <!-- end class="copyright-notice" -->

		<!-- Display the correct logo in the footer, based on the language.  See /i18n/*.json file for language specific information -->
		<span class="church-logo-container">
			<a class="church-logo locale-en" href="<?php $t ('footer-mormondotcomurl');?>">
				<img src="<?php $t ('footer-logourl');?>"
					alt="<?php $t ('footer-footerchurchlogo');?>" title="<?php $t ('footer-serviceprovidedby');?>"
					style="margin:1rem 0;"/>
			</a>
		</span> <!-- end class="church-logo-container"  -->
	</div> <!-- end class="footer-container" -->

</div> <!-- end id="fs-footer" -->
