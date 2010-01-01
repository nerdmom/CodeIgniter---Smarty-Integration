// Makes it extremely easy to integrate code igniter and smarty as well as provide layout capabilites
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require "smarty/Smarty.class.php";

class Template extends Smarty {

     /* This is the theme that will load by default, unless you
     * manually change it
     */
    var $theme = "default";

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
     *
     */
    function assign($key,$value)
    {
        $this->tpl->assign($key,$value);
    }

    function display($template)
    {
        $this->tpl->display($template);
    }

    function fetch($template)
    {
        $this->tpl->fetch($template);
    }

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
