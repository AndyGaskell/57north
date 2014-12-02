<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);


$params  = $this->item->params;
$images = json_decode($this->item->images);

?>

<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != '0000-00-00 00:00:00' )) : ?>
	<div class="system-unpublished">
<?php endif; ?>

<?php #echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>

<?php #echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
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
    $query->where($db->quoteName('articleid')." = " . $this->item->id);
    
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
        <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>" itemprop="url">
            <?php echo $this->escape($this->item->title); ?>
        </a>
    </h2>

    <?php if ($params->get('show_tags') && !empty($this->item->tags->itemTags)) : ?>
        <?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
    <?php endif; ?>

    <?php // Todo Not that elegant would be nice to group the params ?>
    <?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
        || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') ); ?>

    <?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
        <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
    <?php endif; ?>



    <?php if (!$params->get('show_intro')) : ?>
        <?php echo $this->item->event->afterDisplayTitle; ?>
    <?php endif; ?>
    <?php echo $this->item->event->beforeDisplayContent; ?> <?php echo $this->item->introtext; ?>

    <?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
        <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
    <?php  endif; ?>

    <?php if ($params->get('show_readmore') && $this->item->readmore) :
        if ($params->get('access-view')) :
            $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
        else :
            $menu = JFactory::getApplication()->getMenu();
            $active = $menu->getActive();
            $itemId = $active->id;
            $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
            $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
            $link = new JUri($link1);
            $link->setVar('return', base64_encode($returnURL));
        endif; ?>
        <a class="btn ibcos_readmore" href="<?php echo $link; ?>" itemprop="url">View Details</a>

    <?php endif; ?>

    <?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
        || ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != '0000-00-00 00:00:00' )) : ?>
    </div>
    <?php endif; ?>

    <?php echo $this->item->event->afterDisplayContent; ?>
</div>