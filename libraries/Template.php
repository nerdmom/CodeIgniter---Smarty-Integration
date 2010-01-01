// Makes it extremely easy to integrate code igniter and smarty as well as provide layout capabilites
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require "smarty/Smarty.class.php";

/**
 * Template
 * 
 * @package   
 * @author nerdmom
 * @copyright nerdmom
 * @version 2010
 * @access public
 */
class Template extends Smarty {

     /* This is the theme that will load by default, unless you
     * manually change it
     */
    var $theme = "default";

    /**
     * Template::__construct()
     * 
     * @return
     */
    function __construct()
    {
          // Define some Smarty paths
        $this->tpl = new Smarty();
        $this->tpl->template_dir = ROOTPATH . "templates/";
        $this->tpl->compile_dir = APPPATH . "libraries/smarty/templates_c/";
        $this->tpl->config_dir = APPPATH . "libraries/smarty/config/";
        $this->tpl->plugins_dir = APPPATH . "libraries/smarty/plugins/";
    }

    /**
     * Template::assign()
     * Assigns values to be parsed by Smarty
     * If key is an array, we can loop through to assign multiple values at once
     * @param mixed $key - can be associative array
     * @param mixed $value - optional unless key is a string
     * @return
     */
    function assign($key, $value = "")
    {
    		if( is_array($key) ) {
    			foreach($key as $var => $val) {
    				$this->tpl->assign($var, $val);    			
    			}    		    		    		    		
    		} else {
    			if( empty($value) ) {
    				throw new Exception("Value must be set when key is a string!");    			
    			}
			    
			$this->tpl->assign($key,$value);    		    		    		    		
    		}        
    }

    /**
     * Template::display()
     * 
     * @param mixed $template
     * @return
     */
    function display($template)
    {
        $this->tpl->display($template);
    }

    /**
     * Template::fetch()
     * 
     * @param mixed $template
     * @return
     */
    function fetch($template)
    {
        $this->tpl->fetch($template);
    }

    /**
     * Template::layout()
     * 
     * @param mixed $inner_template
     * @param mixed $array
     * @return
     */
    function layout($inner_template,$array)
    {
          foreach($array as $key=>$val) {
               $this->assign($key,$val);
          }

          $this->assign("inner_template",$inner_template);

          $this->display($this->theme.".tpl");
          exit;
    }

}
