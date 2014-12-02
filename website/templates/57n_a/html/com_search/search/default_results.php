<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="ibcos_list">
<?php 

$result_count = 0;

foreach ($this->results as $result) { 
    $article = JTable::getInstance("content");
    # get the art id from the result slug, as the result doesn't have an artid in it
    $slug = $result->slug;
    $slug_array = explode(":", $slug);
    $art_id = $slug_array[0];
    $article->load($art_id);
    
    if ($article->xreference == "ibcos" ) {
        $result_count++;
        
        
        #echo "title: " . $article->get('title') . "<br/>";
        $images = json_decode($article->images);
        
        #echo "<pre>" . print_r($article, TRUE) . "</pre>";
        #echo "<hr/>";
        #echo "<pre>" . print_r($result, TRUE) . "</pre>";
            
        
        ?>
            <div class="item" itemprop="blogPost" itemscope itemtype="http://schema.org/Product">
                <div class="ibcos_thumb">
                <?php 

                if (isset($images->image_intro) && !empty($images->image_intro)) { 
                    ?>
                    <img <?php 
                    if ($images->image_intro_caption) {
                        echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_intro_caption) . '"';
                    } 
                    ?> src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" itemprop="thumbnailUrl"/>
                    <?php 
                } else {
                    # see which image it needs
                    $db = JFactory::getDbo();
                    $query = $db->getQuery(true);
                    $query->select('value');
                    $query->from($db->quoteName('#__fieldsattach_values'));
                    $query->where($db->quoteName('fieldsid')." = 40");
                    $query->where($db->quoteName('articleid')." = " . $art_id);
                     
                    // Reset the query using our newly populated query object.
                    $db->setQuery($query);
                    $ness = $db->loadResult();
                    if ($ness == "yes" ) {
                        ?>
                        <img src="<?php echo JURI::base(); ?>images/ibcos/no_image_thumb_ness.png" alt="Sorry, no image"/>
                        <?php                 
                    } else {
                        ?>
                        <img src="<?php echo JURI::base(); ?>images/ibcos/no_image_thumb.png" alt="Sorry, no image"/>
                        <?php 
                    }
                }    
                ?>
                </div>
                <div class="ibcos_text">
                    <h2 itemprop="name">
                        <a href="<?php echo JRoute::_($result->href); ?>" itemprop="url">
                            <?php echo $this->escape($article->title); ?>
                        </a>
                    </h2>





                    <?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
                        <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $article, 'params' => $params, 'position' => 'above')); ?>
                    <?php endif; ?>



                    <?php echo $article->event->beforeDisplayContent; ?> <?php echo $article->introtext; ?>




                        <a class="btn ibcos_readmore" href="<?php echo JRoute::_($result->href); ?>" itemprop="url">View Details</a>


                    <?php if ($article->state == 0 || strtotime($article->publish_up) > strtotime(JFactory::getDate())
                        || ((strtotime($article->publish_down) < strtotime(JFactory::getDate())) && $article->publish_down != '0000-00-00 00:00:00' )) : ?>
                    </div>
                    <?php endif; ?>

                    <?php echo $article->event->afterDisplayContent; ?>
                </div>
            </div>





        <?php 
    } else {    
        # not ibcos
    }
}
?>
</div>

<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
