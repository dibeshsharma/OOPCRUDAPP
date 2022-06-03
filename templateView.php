<?php

/**
 * This is a templating class
 */

namespace Console;

class templateView{
    /**
     * Templating function
     *
     * @param $name   - Name of the template PHP file.
     * @param $array   - Array to pass to the template file.
     * @return string - Output of the template file. i.e. HTML.
     */
    public function template($name, $array = []){  
        $config = "none";
        $dirname = dirname($name);
        $filename = basename($name.'.php');
        $file = __DIR__ .'/views/'.$dirname.'/'.$filename;
                
        if (!file_exists($file)) {
          return '';
        }
        
        echo $file;
        include $file;

        // ob_start();
        // include $file;
        // return ob_get_clean();
    }  
  
}
?>
