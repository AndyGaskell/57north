<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

# get the first item in the menu, and the first item from that
$first_item = array_shift(array_slice($list,0,1));
$first_item = array_shift(array_slice($first_item,0,1));



#echo "parent_title: " . $first_item->parent_title . "<br/>";
#echo "category_title: " . $first_item->category_title . "<br/>";

?>


<ul class="category-module<?php echo $moduleclass_sfx; ?>">
<?php if ($grouped) : ?>

	<?php 
    foreach ($list as $group_name => $group) {
        
        if ( count($list) !== 1 ) {
            # only put the items in a sub if there is more than one
            
            # get the first item in this group
            $first_item = array_shift(array_slice($group,0,1));
            
            # get the alias
            $child_alias = $first_item->link;           
            #echo "child_alias: " . $child_alias . "<br/>";
            
            # find out where the last slash is
            $position_of_last_slash = strrpos($child_alias, "/");
            #echo "position_of_last_slash: " . $position_of_last_slash . "<br/>";
            
            # trim off everything after there
            $cat_link = substr($child_alias, 0, $position_of_last_slash);
            #echo "cat_link: " . $cat_link . "<br/>";
            
            ?>
            <li>
                <a class="mod-articles-category-title" href="<?php echo $cat_link; ?>">
                    <?php echo $group_name; ?>
                </a>
                <ul>
            <?php 
        }
        ?>            
            
                <?php foreach ($group as $item) : ?>
                    <li>
                        <?php if ($params->get('link_titles') == 1) : ?>
                            <a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
                            <?php echo $item->title; ?>
                            </a>
                        <?php else : ?>
                            <?php echo $item->title; ?>
                        <?php endif; ?>

                        <?php if ($item->displayHits) : ?>
                            <span class="mod-articles-category-hits">
                            (<?php echo $item->displayHits; ?>)
                            </span>
                        <?php endif; ?>

                        <?php if ($params->get('show_author')) :?>
                            <span class="mod-articles-category-writtenby">
                            <?php echo $item->displayAuthorName; ?>
                            </span>
                        <?php endif;?>

                        <?php if ($item->displayCategoryTitle) :?>
                            <span class="mod-articles-category-category">
                            (<?php echo $item->displayCategoryTitle; ?>)
                            </span>
                        <?php endif; ?>

                        <?php if ($item->displayDate) : ?>
                            <span class="mod-articles-category-date"><?php echo $item->displayDate; ?></span>
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
                                    if ($params->get('show_readmore_title', 0) != 0) :
                                        echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
                                        endif;
                            elseif ($params->get('show_readmore_title', 0) == 0) :
                                echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE');
                            else :
                                echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE');
                                echo JHtml::_('string.truncate', ($item->title), $params->get('readmore_limit'));
                            endif; ?>
                            </a>
                            </p>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
        
        <?php                 
        if ( count($list) !== 1 ) {
            # only put the items in a sub if there is more than one
            ?>
                </ul>
            </li>
            <?php 
        }
    } 
    ?>
<?php else : ?>
	<?php foreach ($list as $item) : ?>
		<li>
			<?php if ($params->get('link_titles') == 1) : ?>
				<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
				<?php echo $item->title; ?>
				</a>
			<?php else : ?>
				<?php echo $item->title; ?>
			<?php endif; ?>

			<?php if ($item->displayHits) :?>
				<span class="mod-articles-category-hits">
				(<?php echo $item->displayHits; ?>)  </span>
			<?php endif; ?>

			<?php if ($params->get('show_author')) :?>
				<span class="mod-articles-category-writtenby">
					<?php echo $item->displayAuthorName; ?>
				</span>
			<?php endif;?>

			<?php if ($item->displayCategoryTitle) :?>
				<span class="mod-articles-category-category">
				(<?php echo $item->displayCategoryTitle; ?>)
				</span>
			<?php endif; ?>

			<?php if ($item->displayDate) : ?>
				<span class="mod-articles-category-date"><?php echo $item->displayDate; ?></span>
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
		</li>
	<?php endforeach; ?>
<?php endif; ?>
</ul>
