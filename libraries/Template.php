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
 * @description Makes it extremely easy to integrate code igniter and smarty as well as provide layout capabilites
 */
class Template extends Smarty {

    /**
	* This is the layout that will load by default, unless you manually change it
     */
    var $layout_template = "default";
    
    /**
	* The default extension to use for our templates
     */    
    var $ext = ".tpl";

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
     * @return object
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
		    
		return $this;        
    }

    /**
     * Template::display()
     * Wrapper function for smarty->display().
     * Displays just one template
     * @param mixed $template
     * @return
     */
    function display($template)
    {
        $this->tpl->display($template);
    }

    /**
     * Template::fetch()
     * Wrapper function for smarty->fetch()
     * Grabs just one template
     * @param mixed $template
     * @return
     */
    function fetch($template)
    {
        $this->tpl->fetch($template);
    }

    /**
     * Template::layout()
     * Where the magic happens!
     * @param mixed $inner_template - The template to display within our layout
     * @param mixed $array - Any last-minute data to add to the template output
     * @return template
     */
    function layout($inner_template,$array = array())
    {
    		if( !empty($array) ) {
    			$this->assign($array);    		
    		}

          $this->assign("inner_template", $inner_template);

          $this->display($this->layout_template.$this->ext);
          
          // If we do not exit, CI will throw an error
          exit;
    }

}
