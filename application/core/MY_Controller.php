<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class SuperController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	}
 
	public function removeCache()
	{
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}

	   public function delete_cache_path($uri = '')
    {
        $CI =& get_instance();
        $cache_path = $CI->config->item('cache_path');
        if ($cache_path === '')
        {
            $cache_path = APPPATH.'cache/';
        }

        if ( ! is_dir($cache_path))
        {
            log_message('error', 'Unable to find cache path: '.$cache_path);
            return FALSE;
        }

        $cache_path .= md5($uri);

        if ( ! @unlink($cache_path))
        {
            log_message('error', 'Unable to delete cache file for '.$uri);
            return FALSE;
        }

        return TRUE;
    }

}
//Location: application/core/MY_Controller.php