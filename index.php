<?php
//edit
function the_debug_backtrace($stacktrace=null) {
    if(!isset($stacktrace)){
        //What do you think about using debug_backtrace with DEBUG_BACKTRACE_IGNORE_ARGS? This could save some memory when looking for the call location info
        $stacktrace = version_compare(PHP_VERSION, '5.3.6', '>=') ? debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS) : debug_backtrace();
        unset($stacktrace[0]); //첫번째는 이 함수명인 the_debug_backtrace 이라서 제거함
    }
    print "<pre>";
    //print str_repeat("=", 50)."\n";
    $i = 1;
    foreach($stacktrace as $node) {
        $filepath = str_replace($_SERVER['DOCUMENT_ROOT'], "", str_replace("\\","/",$node['file']));
        print "$i. ".$filepath."(".$node['line']."): ";
        if(isset($node['class'])) {
            print $node['class'] . "->";
        }
        print ($i==1?"(".basename(__FILE__).")":"").$node['function']."()" . PHP_EOL;
        $i++;
    }
    print "</pre>";
}
function get_debug_backtrace($stacktrace=null) {
    if(!isset($stacktrace)){
        //What do you think about using debug_backtrace with DEBUG_BACKTRACE_IGNORE_ARGS? This could save some memory when looking for the call location info
        $stacktrace = version_compare(PHP_VERSION, '5.3.6', '>=') ? debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS) : debug_backtrace();
        unset($stacktrace[0]); //첫번째는 이 함수명인 the_debug_backtrace 이라서 제거함
    }
    $stack = '<pre>';
    $i = 1;
    foreach($stacktrace as $node) {
        $filepath = str_replace($_SERVER['DOCUMENT_ROOT'], "", str_replace("\\","/",$node['file']));
        $stack .= "#$i ".$filepath ."(" .$node['line']."): ";
        if(isset($node['class'])) {
            $stack .= $node['class'] . "->";
        }
        $stack .= ($i==1?"(".basename(__FILE__).")":"").$node['function'] . "()" . PHP_EOL;
        $i++;
    }
    $stack .= "</pre>";
    return $stack;
}
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
