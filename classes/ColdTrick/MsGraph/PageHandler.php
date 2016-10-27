<?php

namespace ColdTrick\MsGraph;

class PageHandler {
	
	/**
	 * Handle /msgraph URLs
	 *
	 * @param array $page URL segments
	 *
	 * @return bool
	 */
	public static function msgraph($page) {
		
		switch (elgg_extract(0, $page)) {
			case 'authorize':
				
				echo elgg_view_resource('msgraph/authorize');
				return true;
				break;
		}
		
		return false;
	}
}
