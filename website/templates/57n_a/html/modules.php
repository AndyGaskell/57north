<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the submenu style, you would use the following include:
 * <jdoc:include type="module" name="test" style="submenu" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */

/*
 * Module chrome for rendering the module in a submenu
 */
function modChrome_no($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo $module->content;
	}
}

# module in a well
function modChrome_well($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo "<div class=\"well " . htmlspecialchars($params->get('moduleclass_sfx')) . "\">";
		if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h3>";
		}
		echo $module->content;
		echo "</div>";
	}
}

# module in a span 12
function modChrome_span12($module, &$params, &$attribs){
	if ($module->content)
	{
		echo "<div class=\"span12\">";
        echo "    <div class=\"module_content\">";        
		if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h2>";
		}
		echo $module->content;
        echo "    </div>";
		echo "</div>";
	}
}

# module in a span 6
function modChrome_span6($module, &$params, &$attribs){
	if ($module->content)
	{
		echo "<div class=\"span6\">";
        echo "    <div class=\"module_content\">";
		if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h2>";
		}
        
		echo $module->content;
        echo "    </div>";
		echo "</div>";
	}
}

# module in a span 4
function modChrome_span4($module, &$params, &$attribs){
	if ($module->content)
	{
		echo "<div class=\"span4\">";
        echo "    <div class=\"module_content\">";
		if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h2>";
		}
		echo $module->content;
        echo "    </div>";
		echo "</div>";
	}
}

# module in a span 3
function modChrome_span3($module, &$params, &$attribs){
	if ($module->content)
	{
		echo "<div class=\"span3\">";
        echo "    <div class=\"module_content\">";
		if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h2>";
		}
		echo $module->content;
        echo "    </div>";
		echo "</div>";
	}
}

# module in a span 2
function modChrome_span2($module, &$params, &$attribs){
	if ($module->content)
	{
		echo "<div class=\"span2\">";
        echo "    <div class=\"module_content\">";
		if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h2>";
		}
		echo $module->content;
        echo "    </div>";
		echo "</div>";
	}
}

# module in a span 1
function modChrome_span1($module, &$params, &$attribs){
	if ($module->content)
	{
		echo "<div class=\"span1\">";
        echo "    <div class=\"module_content\">";
		if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h2>";
		}
		echo $module->content;
        echo "    </div>";
		echo "</div>";
	}
}

# plain module
function modChrome_plain($module, &$params, &$attribs){
	if ($module->content)
	{
        echo "<div class=\"module_content\">";
		if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h2>";
		}
		echo $module->content;
        echo "</div>";
	}
}

# plain module
function modChrome_plainsocial($module, &$params, &$attribs){
	if ($module->content)
	{
        echo "<div class=\"module_content social_share\" >";
		if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h2>";
		}
		echo $module->content;
        echo "</div>";
	}
}

# module in a row-fluid
function modChrome_rowfluid($module, &$params, &$attribs){
	if ($module->content)
	{
        echo "<div class=\"row-fluid\">";
		echo "    <div class=\"module_content span12_module\">";
        if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h2>";
		}
		echo $module->content;
        echo "    </div>";
        echo "</div>";
	}
}



# module in a row-fluid
function modChrome_rowfluid_plain($module, &$params, &$attribs){
	if ($module->content)
	{
        echo "<div class=\"row-fluid\">";
		echo "    <div class=\"module_content_plain span12_module\">";
        if ($module->showtitle)
		{
			echo "<h2>" . $module->title . "</h2>";
		}
		echo $module->content;
        echo "    </div>";
        echo "</div>";
	}
}



# module in a row-fluid
function modChrome_blue_white($module, &$params, &$attribs){
	if ($module->content)
	{
        echo "<div class=\"blue_white\">";
        if ($module->showtitle)
		{
			echo "<h4>" . $module->title . "</h4>";
		}
		echo $module->content;
        echo "</div>";
	}
}

?>
