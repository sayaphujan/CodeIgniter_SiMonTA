<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('menu'))
{
	function menu($params = array(),$style){

		$list = $params['list'];

		$menu = '<ul class="'.$style.'">';
		foreach($list as $row):
			$menu .= '<li><a href="'.site_url($row->menu_path).'">'.$row->menu_description.'</a></li>';
		endforeach;
		$menu .= '</ul>';

		return $menu;

	}
}