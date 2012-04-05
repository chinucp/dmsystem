<?php
//=======================================================================
// File:        JPG-CONFIG.INC
// Description: Configuration file for JpGraph library
// Created:     2004-03-27
// Ver:         $Id: jpg-config.inc.php 1871 2009-09-29 05:56:39Z ljp $
//
// Copyright (c) Asial Corporation. All rights reserved.
//========================================================================


//------------------------------------------------------------------------
// Directories for cache and font directory.
//
// CACHE_DIR:
// The full absolute name of the directory to be used to store the
// cached image files. This directory will not be used if the USE_CACHE
// define (further down) is false. If you enable the cache please note that
// this directory MUST be readable and writable for the process running PHP.
// Must end with '/'
//
// TTF_DIR:
// Directory where TTF fonts can be found. Must end with '/'
//
// The default values used if these defines are left commented out are:
//
// UNIX:
//   CACHE_DIR /tmp/jpgraph_cache/
//   TTF_DIR   /usr/share/fonts/truetype/
//   MBTTF_DIR /usr/share/fonts/truetype/
//
// WINDOWS:
//   CACHE_DIR $SERVER_TEMP/jpgraph_cache/
//   TTF_DIR   $SERVER_SYSTEMROOT/fonts/
//   MBTTF_DIR $SERVER_SYSTEMROOT/fonts/
//
//------------------------------------------------------------------------
// define('CACHE_DIR','/tmp/jpgraph_cache/');
// define('TTF_DIR','/usr/share/fonts/TrueType/');
// define('MBTTF_DIR','/usr/share/fonts/TrueType/');

//-------------------------------------------------------------------------
// Cache directory specification for use with CSIM graphs that are
// using the cache.
// The directory must be the filesysystem name as seen by PHP
// and the 'http' version must be the same directory but as
// seen by the HTTP server relative to the 'htdocs' ddirectory.
// If a relative path is specified it is taken to be relative from where
// the image script is executed.
// Note: The default setting is to create a subdirectory in the
// directory from where the image script is executed and store all files
// there. As ususal this directory must be writeable by the PHP process.
define('CSIMCACHE_DIR','csimcache/');
define('CSIMCACHE_HTTP_DIR','csimcache/');

//------------------------------------------------------------------------
// Various JpGraph Settings. Adjust accordingly to your
// preferences. Note that cache functionality is turned off by
// default (Enable by setting USE_CACHE to true)
//------------------------------------------------------------------------

// Deafult locale for error messages.
// This defaults to English = 'en'
define('DEFAULT_ERR_LOCALE','en');

// Deafult graphic format set to 'auto' which will automatically
// choose the best available format in the order png,gif,jpeg
// (The supported format depends on what your PHP installation supports)
define('DEFAULT_GFORMAT','auto');

// Should the cache be used at all? By setting this to false no
// files will be generated in the cache directory.
// The difference from READ_CACHE being that setting READ_CACHE to
// false will still create the image in the cache directory
// just not use it. By setting USE_CACHE=false no files will even
// be generated in the cache directory.
define('USE_CACHE',false);

// Should we try to find an image in the cache before generating it?
// Set this define to false to bypass the reading of the cache and always
// regenerate the image. Note that even if reading the cache is
// disabled the cached will still be updated with the newly generated
// image. Set also 'USE_CACHE' below.
define('READ_CACHE',true);

// Determine if the error handler should be image based or purely
// text based. Image based makes it easier since the script will
// always return an image even in case of errors.
define('USE_IMAGE_ERROR_HANDLER',true);

// Should the library examine the global php_errmsg string and convert
// any error in it to a graphical representation. This is handy for the
// occasions when, for example, header files cannot be found and this results
// in the graph not being created and just a 'red-cross' image would be seen.
// This should be turned off for a production site.
define('CATCH_PHPERRMSG',true);

// Determine if the library should also setup the default PHP
// error handler to generate a graphic error mesage. This is useful
// during development to be able to see the error message as an image
// instead as a 'red-cross' in a page where an image is expected.
define('INSTALL_PHP_ERR_HANDLER',false);

// Should usage of deprecated functions and parameters give a fatal error?
// (Useful to check if code is future proof.)
define('ERR_DEPRECATED',true);

// The builtin GD function imagettfbbox() fuction which calculates the bounding box for
// text using TTF fonts is buggy. By setting this define to true the library
// uses its own compensation for this bug. However this will give a
// slightly different visual apparance than not using this compensation.
// Enabling this compensation will in general give text a bit more space to more
// truly reflect the actual bounding box which is a bit larger than what the
// GD function thinks.
define('USE_LIBRARY_IMAGETTFBBOX',true);

//------------------------------------------------------------------------
// The following constants should rarely have to be changed !
//------------------------------------------------------------------------

// What group should the cached file belong to
// (Set to '' will give the default group for the 'PHP-user')
// Please note that the Apache user must be a member of the
// specified group since otherwise it is impossible for Apache
// to set the specified group.
define('CACHE_FILE_GROUP','www');

// What permissions should the cached file have
// (Set to '' will give the default persmissions for the 'PHP-user')
define('CACHE_FILE_MOD',0664);

// Default theme class name
define('DEFAULT_THEME_CLASS', 'UniversalTheme');

define('SUPERSAMPLING', true);
define('SUPERSAMPLING_SCALE', 1);


////FROM JPG GRAPH

// Version info
define('JPG_VERSION','3.5.0b1');

// Minimum required PHP version
define('MIN_PHPVERSION','5.1.0');

// Special file name to indicate that we only want to calc
// the image map in the call to Graph::Stroke() used
// internally from the GetHTMLCSIM() method.
define('_CSIM_SPECIALFILE','_csim_special_');

// HTTP GET argument that is used with image map
// to indicate to the script to just generate the image
// and not the full CSIM HTML page.
define('_CSIM_DISPLAY','_jpg_csimd');

// Special filename for Graph::Stroke(). If this filename is given
// then the image will NOT be streamed to browser of file. Instead the
// Stroke call will return the handler for the created GD image.
define('_IMG_HANDLER','__handle');

// Special filename for Graph::Stroke(). If this filename is given
// the image will be stroked to a file with a name based on the script name.
define('_IMG_AUTO','auto');

// Tick density
define("TICKD_DENSE",1);
define("TICKD_NORMAL",2);
define("TICKD_SPARSE",3);
define("TICKD_VERYSPARSE",4);

// Side for ticks and labels.
define("SIDE_LEFT",-1);
define("SIDE_RIGHT",1);
define("SIDE_DOWN",-1);
define("SIDE_BOTTOM",-1);
define("SIDE_UP",1);
define("SIDE_TOP",1);

// Legend type stacked vertical or horizontal
define("LEGEND_VERT",0);
define("LEGEND_HOR",1);

// Mark types for plot marks
define("MARK_SQUARE",1);
define("MARK_UTRIANGLE",2);
define("MARK_DTRIANGLE",3);
define("MARK_DIAMOND",4);
define("MARK_CIRCLE",5);
define("MARK_FILLEDCIRCLE",6);
define("MARK_CROSS",7);
define("MARK_STAR",8);
define("MARK_X",9);
define("MARK_LEFTTRIANGLE",10);
define("MARK_RIGHTTRIANGLE",11);
define("MARK_FLASH",12);
define("MARK_IMG",13);
define("MARK_FLAG1",14);
define("MARK_FLAG2",15);
define("MARK_FLAG3",16);
define("MARK_FLAG4",17);

// Builtin images
define("MARK_IMG_PUSHPIN",50);
define("MARK_IMG_SPUSHPIN",50);
define("MARK_IMG_LPUSHPIN",51);
define("MARK_IMG_DIAMOND",52);
define("MARK_IMG_SQUARE",53);
define("MARK_IMG_STAR",54);
define("MARK_IMG_BALL",55);
define("MARK_IMG_SBALL",55);
define("MARK_IMG_MBALL",56);
define("MARK_IMG_LBALL",57);
define("MARK_IMG_BEVEL",58);

// Inline defines
define("INLINE_YES",1);
define("INLINE_NO",0);

// Format for background images
define("BGIMG_FILLPLOT",1);
define("BGIMG_FILLFRAME",2);
define("BGIMG_COPY",3);
define("BGIMG_CENTER",4);
define("BGIMG_FREE",5);

// Depth of objects
define("DEPTH_BACK",0);
define("DEPTH_FRONT",1);

// Direction
define("VERTICAL",1);
define("HORIZONTAL",0);

// Axis styles for scientific style axis
define('AXSTYLE_SIMPLE',1);
define('AXSTYLE_BOXIN',2);
define('AXSTYLE_BOXOUT',3);
define('AXSTYLE_YBOXIN',4);
define('AXSTYLE_YBOXOUT',5);

// Style for title backgrounds
define('TITLEBKG_STYLE1',1);
define('TITLEBKG_STYLE2',2);
define('TITLEBKG_STYLE3',3);
define('TITLEBKG_FRAME_NONE',0);
define('TITLEBKG_FRAME_FULL',1);
define('TITLEBKG_FRAME_BOTTOM',2);
define('TITLEBKG_FRAME_BEVEL',3);
define('TITLEBKG_FILLSTYLE_HSTRIPED',1);
define('TITLEBKG_FILLSTYLE_VSTRIPED',2);
define('TITLEBKG_FILLSTYLE_SOLID',3);

// Styles for axis labels background
define('LABELBKG_NONE',0);
define('LABELBKG_XAXIS',1);
define('LABELBKG_YAXIS',2);
define('LABELBKG_XAXISFULL',3);
define('LABELBKG_YAXISFULL',4);
define('LABELBKG_XYFULL',5);
define('LABELBKG_XY',6);


// Style for background gradient fills
define('BGRAD_FRAME',1);
define('BGRAD_MARGIN',2);
define('BGRAD_PLOT',3);

// Width of tab titles
define('TABTITLE_WIDTHFIT',0);
define('TABTITLE_WIDTHFULL',-1);

// Defines for 3D skew directions
define('SKEW3D_UP',0);
define('SKEW3D_DOWN',1);
define('SKEW3D_LEFT',2);
define('SKEW3D_RIGHT',3);

// For internal use only
define("_JPG_DEBUG",false);
define("_FORCE_IMGTOFILE",false);
define("_FORCE_IMGDIR",'/tmp/jpgimg/');



?>
