<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * CODEIGNITER template library
 *
 */
 
class Template
{
    var $template_data = array();
       
    function set($name, $value)
    {
       $this->template_data[$name] = $value;
    }
	  
	  function title($title)
	  {
            $this->template_data['title'] = $title;
	  }
	  
    function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
    {               
        $this->CI =& get_instance();
        //$this->set('navbar',$this->CI->load->view('theme/awal-navbar','',TRUE));
        $this->set('content', $this->CI->load->view($view, $view_data, TRUE));
        return $this->CI->load->view($template, $this->template_data, $return);
    }

    function load2($template = '', $view = '' , $view_data = array(), $return = FALSE)
    {               
        $this->CI =& get_instance();
        $this->set('navbar',$this->CI->load->view('theme-admin/navbar','',TRUE));
        $this->set('content', $this->CI->load->view($view, $view_data, TRUE));
        $this->set('sidebar',$this->CI->load->view('theme-admin/sidebar','',TRUE));
		return $this->CI->load->view($template, $this->template_data, $return);
    }


}
 
/* End of file Template.php */
/* Location: ./application/libraries/Template.php */