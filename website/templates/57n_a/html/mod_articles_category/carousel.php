<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

# break them out of groups
$items =  array();
if ($grouped) { 
	foreach ($list as $group_name => $group) {
		foreach ($group as $item) {
			$items[] = $item;
        }
    }    
} else {
	foreach ($list as $item) {
		$items[] = $item;
	}
}

# random sort the array
shuffle($items);

# create a 'good' array
$good_items =  array();
# loop through em
foreach ($items as $item) {
    
    $images = json_decode($item->images);
    #echo "<pre>" . print_r($images, TRUE) . "</pre>";
    #echo "<pre>" . count($images) . "</pre>";
    
    # this is a tricky tweak to avoid a php warning
    if ( !empty($images->image_intro) ){
        # check the file exists on the file system
        if ( file_exists($images->image_intro) ) {
            $good_item = array();
            $good_item["image"] = $images->image_intro;
            $good_item["link"] = $item->link;
            $good_item["title"] = $item->title;
            $good_items[] = $good_item;
        } 
    } 
}
#echo "<pre>" . print_r($good_items, TRUE) . "</pre>";
# trim it to 30 images
$good_items = array_slice($good_items, 0, 30);

# html id for the item
$carousel_id = "carousel" . $module->id;
?>
<div id="<?php echo $carousel_id; ?>" class="carousel slide" data-pause="">
    <div class="carousel-inner">
        <div class="item active"><?php 
        $item_count = 1;
        # loop through the good array
        foreach ($good_items as $good_item) {
            #echo "<pre>" . print_r($good_item, TRUE) . "</pre>";
            # link
            echo "<a href=\"" . $good_item["link"] . "\" title=\"" . $good_item["title"] . "\" >";
            # image
            echo "<img ";
            echo "class=\"no_caption\" title=\"" . htmlspecialchars($good_item["title"]) . "\" ";
            echo " src=\"" .  htmlspecialchars($good_item["image"]) . "\" alt=\"" . htmlspecialchars($good_item["title"]) . "\" />";
            # close link
            echo "</a>";    
            # every 5 items, break into another rotator
            if (($item_count % 5) == 0) {
                echo "</div>\n";
                echo "<div class=\"item\">";
            }
            $item_count++;
        }
        ?>
        </div>
    </div>
<?php
# Carousel nav, left and right
if ( count($items) > 5 ) {
    ?>
    <a class="carousel-control left" href="#<?php echo $carousel_id; ?>" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#<?php echo $carousel_id; ?>" data-slide="next">&rsaquo;</a>
    <?php
}
?>    
</div>