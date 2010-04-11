<?php
/**
 * @version $Id$
 * Kunena Component
 * @package Kunena
 *
 * @Copyright (C) 2008 - 2010 Kunena Team All rights reserved
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.com
 *
 **/
//
// Dont allow direct linking
defined( '_JEXEC' ) or die('');

class KunenaAvatarKunena extends KunenaAvatar
{
	public function __construct() {
		$this->priority = 25;
	}

	public function getEditURL()
	{
		return KunenaRoute::_('index.php?option=com_kunena&func=profile&do=edit');
	}

	public function getURL($user, $size='thumb')
	{
		$user = KunenaFactory::getUser($user);
		$avatar = $user->avatar;

		if ($size=='thumb' && file_exists( KPATH_MEDIA_LEGACY ."/avatars/s_{$avatar}" )){
			$avatar = 's_' . $avatar;
			$avatar = KURL_MEDIA_LEGACY . "avatars/{$avatar}";
		} else if (!file_exists( KPATH_MEDIA_LEGACY ."/avatars/{$avatar}" ) && !file_exists(KPATH_MEDIA ."/avatars/{$avatar}" ) ) {
			// If avatar does not exist use default image
			if ($size=='thumb') $avatar = 's_nophoto.jpg';
			else $avatar = 'nophoto.jpg';

			$avatar = KURL_MEDIA_LEGACY . "avatars/{$avatar}";
		} else if ( file_exists(KPATH_MEDIA ."/avatars/{$avatar}" ) && $avatar != '' ) {
			if (!preg_match('`gallery`',$avatar)) {
				$avatar = 'thumb/'.$avatar;
			}

			$avatar = KURL_MEDIA . "avatars/{$avatar}";
		} else {
			if ($size=='thumb') $avatar = 's_nophoto.jpg';
			else $avatar = 'nophoto.jpg';
			$avatar = KURL_MEDIA . "avatars/{$avatar}";
		}

		return $avatar;
	}
}
