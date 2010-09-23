<?php
/* {{{ vim:ts=4:sw=4:et

   About: This file checks your PHP version
   Documentation: http://atk4.pbworks.com/doc/static.html

   ---------------------------------------------------------------------

   Agile Toolkit 4

   (c) 1999-2010 Agile Technologies Limited

   See COPYRIGHT for details

   ---------------------------------------------------------------------

   Authors:

    Romans

   ---------------------------------------------------------------------

	}}} */

if(version_compare(PHP_VERSION, '5.2.0') < 0) {
    die('Agile Toolkit Requires PHP 5.2.0. You are running: '.PHP_VERSION."\n");
}
