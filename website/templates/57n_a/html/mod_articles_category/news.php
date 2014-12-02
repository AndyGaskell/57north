<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<h4>Agricar News</h4>
<div class="news">
<?php

foreach ($list as $item) { ?>
	<div>
		<?php if ($params->get('link_titles') == 1) : ?>
			<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?>
			</a>
		<?php else : ?>
			<?php echo $item->title; ?>
		<?php endif; ?>

		<?php if ($item->displayHits) :?>
			<div class="mod-articles-category-hits">
			(<?php echo $item->displayHits; ?>)  </div>
		<?php endif; ?>

		<?php if ($params->get('show_author')) :?>
			<div class="mod-articles-category-writtenby">
				<?php echo $item->displayAuthorName; ?>
			</div>
		<?php endif;?>

		<?php if ($item->displayCategoryTitle) :?>
			<div class="mod-articles-category-category">
			(<?php echo $item->displayCategoryTitle; ?>)
			</div>
		<?php endif; ?>

		<?php if ($item->displayDate) : ?>
			<div class="mod-articles-category-date"><?php echo $item->displayDate; ?></div>
		<?php endif; ?>

		<?php if ($params->get('show_introtext')) :?>
			<p class="mod-articles-category-introtext">
			<?php echo $item->displayIntrotext; ?>
			</p>
		<?php endif; ?>

		<?php if ($params->get('show_readmore')) :?>
			<p class="mod-articles-category-readmore">
			<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
				<?php if ($item->params->get('access-view') == false) :
					echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE');
				elseif ($readmore = $item->alternative_readmore) :
					echo $readmore;
					echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit'));
				elseif ($params->get('show_readmore_title', 0) == 0) :
					echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE');
				else :
					echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE');
					echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit'));
				endif; ?>
			</a>
			</p>
		<?php endif; ?>
	</div>
<?php 
}
?>
</div>


