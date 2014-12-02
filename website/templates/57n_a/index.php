<?php
/**
 * 57 North
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript('templates/' .$this->template. '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Add current user information
$user = JFactory::getUser();

// Adjusting content width
if ( $this->countModules('right') ){
	# got right
    $span = "span9";
}else{
	$span = "span12";
}

unset($doc->_scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
unset($doc->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
    <link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />    
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/apple-touch-icon-57-precomposed.png">
    
    <script type="text/javascript" language="javascript">jQuery.noConflict();</script>
    <script type="text/javascript" language="javascript" src="<?php echo JURI::base(); ?>templates/<?php echo $this->template ?>/js/jquery.colorbox-min.js"></script>
    
    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'> 	
	<!--[if lt IE 9]>
		<script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">

	<?php # header ?>
    <div class="header_wide_blue">
        <div class="container">
            <div class="row-fluid header-row">
                <?php # logo ?>
                <div class="span2">
                    <a id="top"></a> 
                    <a href="<?php echo $this->baseurl ?>" title="<?php echo $sitename; ?> - Home" class="logo"><img src="templates/ssofb.co.uk_agricar/images/agricar_logo.png" alt="<?php echo $sitename; ?> - Logo" /></a>
                </div>            
            
                <?php # header_left ?>
                <div class="span7">
                    <div class="header_left_blue">
                        <jdoc:include type="modules" name="header_left_blue" style="none" />
                    </div>
                    <div class="header_left_white">
                        <jdoc:include type="modules" name="header_left_white" style="none" />
                    </div>                    
                </div>
                <?php # header_right ?>
                <div class="span3">
                    <div class="header_right">
                        <jdoc:include type="modules" name="header_right" style="none" />
                    </div>
                </div>
            </div>    
            
            <div class="row-fluid">
                <?php # menu ?>
                <div class="span12">
                    <jdoc:include type="modules" name="menu" style="none" />
                </div>
            </div>  
            
        </div>
	</div>
        

        
        
    <?php # main white portion ?>
    <div class="container">
        <?php
        /*
        top_wide modules, modules full width in a row each
        */            
        # do we have any top_wide modules?
        if ( $this->countModules('top_wide') ) {
            ?>
            <jdoc:include type="modules" name="top_wide" style="rowfluid_plain" />
            <?php                      
        } 
        ?>         
    
    
        <?php
        /*
        top_auto modules, modules in a row, with a flexible number of modules that'll be evenly placed
        */            
        # do we have any top_auto modules?
        $top_auto_count = $this->countModules('top_auto');
        if ( $top_auto_count ) {
            ?>
            <div class="row-fluid top_auto">
            <?php
            # we've got content_top_count 1 modules, now we need to work out how many, to see about what span to use
            if ($top_auto_count == 1) {
                ?>
                <jdoc:include type="modules" name="top_auto" style="span12" />
                <?php
            } elseif ($top_auto_count == 2) {
                ?>
                <jdoc:include type="modules" name="top_auto" style="span6" />
                <?php
            } elseif ($top_auto_count == 3) {
                ?>
                <jdoc:include type="modules" name="top_auto" style="span4" />
                <?php      
            } elseif ($top_auto_count == 4) {
                ?>
                <jdoc:include type="modules" name="top_auto" style="span3" />
                <?php     
            } elseif ($top_auto_count == 6) {
                ?>
                <jdoc:include type="modules" name="top_auto" style="span2" />
                <?php     
            } elseif ($top_auto_count == 12) {
                ?>
                <jdoc:include type="modules" name="top_auto" style="span1" />
                <?php                           
            } else {
                # let's be intolerant, if 12 is not divisble by the number of modules, then show a warning
                echo "<p>For the top_auto please place only 1, 2, 3, 4, 6 or 12 modules here</p>";          
            }
            ?>
            </div>
            <?php                      
        } 
        ?>  


                    
        <div class="row-fluid">
        
            
            <main id="content" role="main" class="<?php echo $span;?>">
                <div class="main_body">
                    <?php # Begin Content ?>
                    <jdoc:include type="modules" name="above_content" style="none" />
                    <jdoc:include type="message" />
                    <jdoc:include type="component" />
                    <jdoc:include type="modules" name="below_content" style="none" />
                    <?php # End Content ?>
                </div>
            </main>
            
            
            <?php 
            if ($this->countModules('right')) {
            # Begin left 
            ?>
            <div class="span4">
                <div class="right">
                    <jdoc:include type="modules" name="right" style="plain" />
                </div>
            </div>
            <?php 
            # End left 
            } 
            ?>
            
        </div>


    
        <?php
        /*
        bottom_auto modules, modules in a row, with a flexible number of modules that'll be evenly placed
        */            
        # do we have any bottom_auto modules?
        $bottom_auto_count = $this->countModules('bottom_auto');
        if ( $bottom_auto_count ) {
            ?>
            <div class="row-fluid bottom_auto">
            <?php
            # we've got content_bottom_count 1 modules, now we need to work out how many, to see about what span to use
            if ($bottom_auto_count == 1) {
                ?>
                <jdoc:include type="modules" name="bottom_auto" style="span12" />
                <?php
            } elseif ($bottom_auto_count == 2) {
                ?>
                <jdoc:include type="modules" name="bottom_auto" style="span6" />
                <?php
            } elseif ($bottom_auto_count == 3) {
                ?>
                <jdoc:include type="modules" name="bottom_auto" style="span4" />
                <?php      
            } elseif ($bottom_auto_count == 4) {
                ?>
                <jdoc:include type="modules" name="bottom_auto" style="span3" />
                <?php     
            } elseif ($bottom_auto_count == 6) {
                ?>
                <jdoc:include type="modules" name="bottom_auto" style="span2" />
                <?php     
            } elseif ($bottom_auto_count == 12) {
                ?>
                <jdoc:include type="modules" name="bottom_auto" style="span1" />
                <?php                           
            } else {
                # let's be intolerant, if 12 is not divisble by the number of modules, then show a warning
                echo "<p>For the bottom_auto please place only 1, 2, 3, 4, 6 or 12 modules here</p>";          
            }
            ?>
            </div>
            <?php                      
        } 
        ?>      


        


        
        <?php
        /*
        bottom_wide modules, modules full width in a row each
        */            
        # do we have any bottom_wide modules?
        if ( $this->countModules('bottom_wide') ) {
            ?>
            <jdoc:include type="modules" name="bottom_wide" style="rowfluid_plain" />
            <?php                      
        } 
        ?>            

    </div>

	


	
	<?php # Footer ?>
	<div class="footer_wide">
	    <div class="container">
	
            <div class="row-fluid">
		        <div class="span2 footer_1">
			        <jdoc:include type="modules" name="footer_1" />                 
		        </div>
                <div class="span3 footer_2">
			        <jdoc:include type="modules" name="footer_2" />       
                </div>
                <div class="span3 footer_3">
			        <jdoc:include type="modules" name="footer_3" />       
                </div>
                <div class="span4 footer_4">
			        <jdoc:include type="modules" name="footer_4" />  
                    <div class="copyright_footer">&copy; <?php echo $sitename; ?> <?php echo date('Y'); ?></div>
                    <div class="credit_footer">


                    </div>
                </div>                                
            </div>    
                       	
        </div>
    </div>    		
	
	<jdoc:include type="modules" name="debug" style="none" />
	
    <!-- Start Google Analytics tag, from agricar.co.uk -->
    <script type="text/javascript">
	    var _gaq = _gaq || [];
	    _gaq.push(['_setAccount', 'UA-20594796-1']);
	    _gaq.push(['_trackPageview']);

	    (function() {

	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    </script>
    <!-- End Google Analytics tag -->

</body>
</html>
