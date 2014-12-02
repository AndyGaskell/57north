<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>


<div class="custom<?php echo $moduleclass_sfx ?>" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?> >
    <?php
    if ($module->showtitle){
        echo "<h2 class=\"page-header\">" . $module->title . "</h2>";
    }
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js" type="text/javascript">//swfobject plugin</script>
    <script type="text/javascript">
    /*<![CDATA[*/
    /* FCK swfobject v1.5 */
    document.write('<div id="flash201072315049" style="width:737px; height:225px;"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player<\/a> to see this player.<\/div>');
    var params={};
    var attributes={};
    var flashvars = {};
        params["play"]="true";
        params["menu"]="true";
        params["loop"]="true";
        params["allowfullscreen"]="false";
        params["wmode"]="transparent";
    swfobject.embedSWF("images/_flash/trange-marketing-offers.swf", "flash201072315049", 737, 225, "7.0.0", false, flashvars, params, attributes);
    /*]]>*/
    </script>

	<?php echo $module->content;?>      

</div>
