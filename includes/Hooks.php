<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 * @file
 */

namespace MediaWiki\Extension\FsHeader;

use OutputPage;
use QuickTemplate;
use Skin;
use SkinTemplate;

class Hooks {

	/**
	 * @see https://www.mediawiki.org/wiki/Manual:Hooks/BeforePageDisplay
	 * @param OutputPage $out the OutputPage object
	 * @param Skin $skin Skin object that will be used to generate the page
	 */
	public static function onBeforePageDisplay( OutputPage $out, Skin $skin ) {
		$out->addModuleStyles( "z.ext.FsHeader.styles" );
		$out->addModules( "ext.FsHeader.maps" );
		$out->addModules( "ext.FsHeader.scripts" );
		global $wgUser;

		// modify the login links
		if ( $wgUser->isLoggedIn() ) {
			$out->addInlineStyle('#signinLink {display:none !important;}');
			$out->addInlineStyle('#registerLink {display:none !important;}');
			$out->addInlineStyle('#messagesLink {display:block !important;}');
			$out->addInlineStyle('#logoutLink {display:block !important;}');
		}
		return true;
	}

	public static function onSkinAfterBottomScripts( Skin $skin, &$text ) {
		$out = $skin->getOutput();
		$t = function ( $key ) use ( $out ) {
			echo $out->msg( $key )->inContentLanguage()->escaped();
		};

		ob_start();
		require "footer.php";
		$html = ob_get_contents();
		ob_end_clean();

		$text .= $html;
	}

	public static function onVectorGeneratedSkinData( Skin $skin, &$commonSkinData ) {
		$out = $skin->getOutput();
		$t = function ( $key ) use ( $out ) {
			echo $out->msg( $key )->inContentLanguage()->escaped();
		};

		ob_start();
		require "header.php";
		$html = ob_get_contents();
		// get rid of the output buffer so it isn't flushed automatically
		ob_end_clean();

		$commonSkinData['html-headelement'] .= $html;
	}
}
