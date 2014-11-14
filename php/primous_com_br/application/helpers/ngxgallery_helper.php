<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 2.2
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter NextGem Gallery Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link
 */

// ------------------------------------------------------------------------

if ( ! function_exists('my_site_url'))
{
  	function my_site_url($uri = '')
	{
  //*     $return = '';
       $CI =& get_instance();
       $return = $CI->config->slash_item('base_url');
   /*
       if($uri<>''){
         if ($uri{0} <> '/') {
           $return = $return.$uri;
         }else{
           $return = $return.'/'.$uri;
         }
       }
    */

      //  return $return;//$CI->config->slash_item('base_url').'/'.$url;
        return $CI->config->site_url($uri);
   	}
}


/* End of file url_helper.php */
/* Location: ./system/helpers/url_helper.php */