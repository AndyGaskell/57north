<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
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
    
    <link rel="stylesheet" href="<?php echo JURI::base(); ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
    
    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css' /> 	
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
                                <div class="span2">
                    <a id="top"></a> 
                    <a class="logo" title="Agricar - Home" href="/"><img alt="Agricar - Logo" src="/templates/ssofb.co.uk_agricar/images/agricar_logo.png"></a>
                </div>            
            
                                <div class="span7">
                    <div class="header_left_blue">
                        

<div class="custom">
	<h6>Suppliers of premier agricultural and construction machinery throughout Scotland</h6></div>

                    </div>
                    <div class="header_left_white">
                        

<div class="custom">
	<p><img alt="" src="/images/new_holland_agriculture_logo_header.png">&nbsp; <img alt="" src="/images/grimme_logo_header.png"></p></div>

                    </div>                    
                </div>
                                <div class="span3">
                    <div class="header_right">
                        

<div class="custom">
    <div class="google_translate_container">
        
        <div id="google_translate_element"><div class="skiptranslate goog-te-gadget" dir="ltr" style=""><div id=":0.targetLanguage" style="white-space: nowrap;" class="goog-te-gadget-simple"><img src="https://www.google.com/images/cleardot.gif" class="goog-te-gadget-icon" style="background-image: url(&quot;https://translate.googleapis.com/translate_static/img/te_ctrl3.gif&quot;); background-position: -65px 0px;"><span style="vertical-align: middle;"><a class="goog-te-menu-value" href="javascript:void(0)"><span>Select Language</span><img width="1" height="1" src="https://www.google.com/images/cleardot.gif"><span style="border-left: 1px solid rgb(187, 187, 187);">&#8203;</span><img width="1" height="1" src="https://www.google.com/images/cleardot.gif"><span style="color: rgb(155, 155, 155);">?</span></a></span></div></div></div>
        <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-1157448-2'}, 'google_translate_element');
        }
        </script>
        <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>    
    </div>   

	<p><a target="_blank" href="https://www.facebook.com/AgricarLtd" title="Facebook" class="social_fb">&nbsp;</a> <a target="_blank" href="https://plus.google.com/100703188361407432838/posts" title="Google Plus" class="social_gp">&nbsp;</a></p>
       

</div>

                    </div>
                </div>
            </div>    
            
            <div class="row-fluid">
                                <div class="span12">
                    



<div class="navbar navbar-inverse navbar_agricar">
    <div class="navbar-inner">
        <div class="container">
            <a class="mobile_logo" title="Agricar - Home" href="http://www.agricar.co.uk/"><img alt="Agricar - Logo" src="/templates/ssofb.co.uk_agricar/images/agricar_mobile_logo.png"></a>
        </div>
    </div>
</div>

                </div>
            </div>  
            
        </div>
	</div>
        
	<div class="header_wide_yellow"> </div>    
        
        
    <?php # main white portion ?>
    <div class="container">                   
        <div class="row-fluid">
            <main id="content" role="main" class="span12">
                <div class="main_body">
					<!-- Begin Content -->
					<h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
                    <div class="row-fluid">
                        <div class="span6">
                            <p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
                            <p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
                            <ul>
                                <li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
                                <li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
                                <li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
                                <li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
                            </ul>
                        </div>
                        <div class="span6">
                            <p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
                            <p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><i class="icon-home"></i> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
                        </div>
                    </div>
                    <hr />
                    <p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
                    <blockquote>
                        <span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo $this->error->getMessage();?>
                    </blockquote>
					<!-- End Content -->
                </div>
            </main>
        </div>
    </div>


	<?php # Footer ?>
	<div class="footer_toplink_wide">
	    <div class="container">
	        <a class="top_link" title="Back to the top" href="#top">TOP</a>        	
        </div>
    </div>    
	
	<?php # Footer ?>
	<div class="footer_wide">
	    <div class="container">
            <div class="row-fluid">
                <div class="span12 footer_4">
                    <div class="copyright_footer">&copy; <?php echo $sitename; ?> <?php echo date('Y'); ?></div>
                    <div class="credit_footer">
                        <a href="http://www.designbyoomph.com/" title="Design By Oomph. Creative graphic design and advertising agency based in Forfar, Dundee, Aberdeen, Scotland" target="_blank">Website design by designbyoomph.com</a><br/>
                        <a href="http://www.pukkadigital.com/" title="Website by Pukka Digital. Design for print, web and advertising based in Forfar, Dundee, Aberdeen, Scotland" target="_blank">Website developed and built by pukkadigital.com</a>
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
