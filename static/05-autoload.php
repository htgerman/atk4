<?php
/* {{{ vim:ts=4:sw=4:et

   About: Implements automatic loading of PHP classes
   Documentation: http://atk4.info/doc/pathfinder.html

   ---------------------------------------------------------------------

   Agile Toolkit 4

   (c) 1999-2010 Agile Technologies Limited

   See COPYRIGHT for details

   ---------------------------------------------------------------------

   Authors:

    Romans

   ---------------------------------------------------------------------

	}}} */


if(!function_exists('__autoload')){
    function loadClass($class){
        $file = str_replace('_',DIRECTORY_SEPARATOR,$class).'.php';

        if(isset($GLOBALS['atk_pathfinder'])){
            // If PathFinder is loaded, we will rather use that for loading our classes
            if(substr($class,0,5)=='page_'){
                return $GLOBALS['atk_pathfinder']->locate('page',substr($file,5),'path');
            }
            return $GLOBALS['atk_pathfinder']->locate('php',$file,'path');
        }

        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path){
            $fullpath = $path . DIRECTORY_SEPARATOR . $file;
            if (file_exists($fullpath)) {
                return $fullpath;
            }
        }
        return false;
    }
    function __autoload($class){
        if(!$fullpath=loadClass($class)){
            lowlevel_error("Class is not defined and couldn't be loaded: $class. Consult documentation on __autoload()");
        }
        include_once($fullpath);
        if(class_exists($class))return;

        lowlevel_error("Class $class is not defined in included file");
    }
}
