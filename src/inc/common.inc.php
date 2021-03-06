<?php

    require('gui.inc.php');

    function dec_to_dms($dec)
    {
        // Converts decimal longitude / latitude to DMS
        // ( Degrees / minutes / seconds ) 
        // This is the piece of code which may appear to 
        // be inefficient, but to avoid issues with floating
        // point math we extract the integer part and the float
        // part by using a string function.

        $vars = explode(".", $dec);
        $deg = $vars[0];
        $tempma = "0." . $vars[1];

        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = $tempma - ($min * 60);

        return array("deg" => $deg, "min" => $min, "sec" => $sec);
    }

    
    /**
     * Get application path relative to $_SERVER['SERVER_NAME'];
     * 
     * @return string URI
     * 
     */
    function get_rescueme_uri()
    {
        // Get current path
        $name = substr(strrchr($_SERVER['PHP_SELF'], "/"), 1);
        $path = str_replace($name, '', $_SERVER['PHP_SELF']);
        
        // Get root folders
        $folders = array();
        foreach(scandir(APP_PATH) as $file) {            
            if($file === '.' || $file === '..') {
                continue;
            }
            if(is_dir(APP_PATH . '/' . $file)) { 
                $folders[] = $file;
            }
        }
        
        // Check if script is running from one of these folders
        foreach($folders as $folder){
            $match = strstr($path, $folder);
            if($match){
                return str_replace($match, '', $path);
            }
        }

        // Finished
        return $path;
        
    }// get_rescueme_uri
    
    
    /**
     * Get application URL
     * 
     * @return string URL
     */
    function get_rescueme_url() 
    {
        $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
        $sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
        $protocol = substr($sp, 0, strpos($sp, "/")) . $s;
        return $protocol . "://" . $_SERVER['SERVER_NAME'] . get_rescueme_uri();
    }// get_rescueme_url
    

    /**
     * Get js install object as json string.
     */
    function get_rescueme_install()
    {
        $app = array("url" => APP_URI);
        $admin = array("url" => ADMIN_URI);
        
        return str_replace('\\/', '/',json_encode(array("app" => $app, "admin" => $admin)));        

    }// get_rescueme_install
    
    
    /**
     * Get js wrapped inside self-invoking function.
     * 
     * @param string $content Script content
     * 
     * @return string
     */
    function get_rescueme_js($content)
    {
        $install = get_rescueme_install();
        
        return "(function(window,document,install,undefined){".$content."}(window,document,$install));";
    }// get_rescueme_js    
    

    function assert_types($values)
    {
        foreach($values as $type => $value)
        {
            assert_type($type, $value);
        }
    }
    
    function assert_type($expected, $actual)
    {
        if(call_user_func("is_$expected", $actual))
        {
            throw new Exception("[$actual] is not of type '$actual'.");
        }
    }

    function prepare_values($fields, $values) 
    {
        reset($values);
        reset($fields);
        $prepared = array();
        foreach($fields as $field) {
            $value = current($values);
            if($value === FALSE) break;
            $prepared[$field] = $value;
            next($values);
        }
        return $prepared;
    }    
    
    function isset_get($array, $key, $default=null) {
        return isset($array[$key]) ? $array[$key] : $default;
    }
    
    function array_pick($array, $key) {
        $values = array();
        foreach($array as $name => $value) {
            if($key === $name || is_string($key) && strstr($name, $key) !== false) {
                $values[] = $value;
            }
        }
        return $values;
    }
    
    function modules_exists($module, $_ = null) {
        
        $missing = array();
        
        foreach(func_get_args() as $module) {
            if(!\RescueMe\Module::exists($module))
            {
                $missing[] = $module;
            }
        }    
        
        if(!empty($missing)) {
            insert_errors("Missing module: ", $missing);
        }
        
        return empty($missing);
    }    