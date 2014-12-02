<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');

# count the number of products
$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query->select('COUNT(*)');
$query->from($db->quoteName('#__content'));
$query->where($db->quoteName('xreference') . ' = ' . $db->quote('ibcos'));
$db->setQuery($query);
$count = $db->loadResult();

/*
    $introtext .= "    price_range-" . $product_data['price_range'] . " \n";
    $introtext .= "    search_cat-" . preg_replace("/[^A-Za-z0-9 ]/", "", $product_data['wwg_description'])  . " \n";
    $introtext .= "    manufacturer-" . preg_replace("/[^A-Za-z0-9 ]/", "", $product_data['pre_desc'])  . " \n";

*/

# get manufactures
$query = $db->getQuery(true);
$query->select( array('value', 'COUNT(*) AS num') );
$query->from( $db->quoteName('#__fieldsattach_values') );
$query->where( $db->quoteName('fieldsid') . " = 9" ); # 9 is pre_desc
$query->group( $db->quoteName('value'));    
$db->setQuery($query);
$results = $db->loadObjectList();
# make the select box
$default = 0;
$options = array();
$options[] = JHTML::_('select.option', '', 'All Manufacturers');
foreach ($results as $result) {
    #$select_val = $result->value;
    # format the value, formatting must match ibcos import
    $select_val = "m" . preg_replace("/[^A-Za-z0-9]/", "", $result->value);
    $select_text = $result->value . " (" . $result->num . " products)";
    $options[] = JHTML::_('select.option', $select_val, $select_text);
}
#echo "<pre>" . count($results) . "</pre>";
#echo "<pre>" . print_r($results, TRUE) . "</pre>";
#echo "<pre>" . print_r($options, TRUE) . "</pre>";

$manufacturer_dropdown = JHTML::_('select.genericlist', $options, 'manufacturer', 'class="inputbox"', 'value', 'text', $default);
#echo $dropdown;

# get cats
$query = $db->getQuery(true);
$query->select( array('title', 'id') );
$query->from( $db->quoteName('#__categories') );
#$query->where( $db->quoteName('parent_id') . " = 17" );
$query->where( $db->quoteName('level') . " = 3" );
$db->setQuery($query);
$results = $db->loadObjectList();
# make the select box
$default = 0;
$options = array();
$options[] = JHTML::_('select.option', '', 'All Types');
foreach ($results as $result) {
    #$select_val = "cat" . $result->id . "ref";
    # format the value, formatting must match ibcos import
    $select_val = "c" . preg_replace("/[^A-Za-z0-9]/", "", $result->title);    
    $select_text = $result->title;
    $options[] = JHTML::_('select.option', $select_val, $select_text);
}
#echo "<pre>" . count($results) . "</pre>";
#echo "<pre>" . print_r($results, TRUE) . "</pre>";
#echo "<pre>" . print_r($options, TRUE) . "</pre>";

$category_dropdown = JHTML::_('select.genericlist', $options, 'category', 'class="inputbox"', 'value', 'text', $default);
   
   

# price ranges
$prices = array(
    "0-25" => "&pound;0 - &pound;25,000",
    "25-50" => "&pound;25,000 - &pound;50,000",
    "50-100" => "&pound;50,000 - &pound;100,000",
    "100-150" => "&pound;100,000 - &pound;150,000",
    "150-200" => "&pound;150,000 - &pound;200,000",
    "200+" => "&pound;200,000+"
);
# make the select box
$default = 0;
$options = array();
$options[] = JHTML::_('select.option', '', 'Any Price');
foreach ($prices as $value => $text) {
    #$select_val = $value;
    # format the value, formatting must match ibcos import
    $select_val = "p" . $value;       
    $select_text = $text;
    $options[] = JHTML::_('select.option', $select_val, $select_text);
}
#echo "<pre>" . count($results) . "</pre>";
#echo "<pre>" . print_r($results, TRUE) . "</pre>";
#echo "<pre>" . print_r($options, TRUE) . "</pre>";

$price_range_dropdown = JHTML::_('select.genericlist', $options, 'price_range', 'class="inputbox"', 'value', 'text', $default);



?>
<div class="search<?php echo $moduleclass_sfx ?> stock_search">
    <h4>Stock List Search</h4>

	<form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-inline">
		<input id="search_text" maxlength="100"  class="inputbox search-query" type="text" placeholder="Keywords" />
        <?php 
        echo $manufacturer_dropdown;
        echo $category_dropdown;
        echo $price_range_dropdown;
        ?>
		<button class="button btn" id="search_submit"><?php echo $button_text;?></button>
        <input type="hidden" name="searchword" id="searchword" value="" />
		<input type="hidden" name="task" value="search" />
		<input type="hidden" name="option" value="com_search" />
		<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
        <input type="hidden" name="searchphrase" value="all" />
        <input type="hidden" name="areas[1]" value="content" />
	</form>
</div>
<div class="stock_search_product_count">
    <?php echo $count . " products in stock"; ?>
</div>


<script type="text/javascript">
jQuery(document).ready(function (){
	jQuery('#search_submit').click(function() {
        // get the value of the various fields
        var search_value = jQuery('#search_text').val() + ' ' + jQuery('#manufacturer').val() + ' ' + jQuery('#category').val() + ' ' + jQuery('#price_range').val() ;
        //alert('bo');
        //alert(search_value.length);
        //if (search_value.length == 3) {
            //window.location.href('http://agricar.ssofb.co.uk/sales/all-products');
        //}
        //var url = "http://stackoverflow.com";    
        //jQuery(location).attr('href',url);
        
        jQuery('#searchword').val(search_value);
    
    });
});
</script>
