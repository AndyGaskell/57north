<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);
JHtml::_('behavior.caption');
$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author'));


# add lightbox    
#JHTML::_('behavior.modal');    
    
# see if it is the ibcos layout
$template_params = JFactory::getApplication()->getTemplate(true)->params;
$layout_variation = $template_params->get('layoutvariation');
#echo "layout_variation: " . $layout_variation . "<br/> \n";     
if ($layout_variation == 2) {
    #echo "<h2>people</h2>";
    $is_ibcos = 1;
} else {
    #echo "<h2>normal</h2>";
    $is_ibcos = 0;    
}    
 

if ($is_ibcos) {

    // require helper file
    JLoader::register('fieldattach', 'components/com_fieldsattach/helpers/fieldattach.php');     
    # get the fields
    $serial = fieldattach::getValue($this->item->id, 37);
    $vmloc = fieldattach::getValue($this->item->id, 29);
    $stock_status = fieldattach::getValue($this->item->id, 35);
    $vmstok = fieldattach::getValue($this->item->id, 1);
    $vm_engine = fieldattach::getValue($this->item->id, 17);
    $vmreg = fieldattach::getValue($this->item->id, 18);
    $vmdreg = fieldattach::getValue($this->item->id, 19);
    $vm_condition = fieldattach::getValue($this->item->id, 20);
    $vm_wsj_clk = fieldattach::getValue($this->item->id, 16);
    $vmrdat = fieldattach::getValue($this->item->id, 15);
    $vmspec = fieldattach::getValue($this->item->id, 13);
    $vm_year = fieldattach::getValue($this->item->id, 14);
    $vmmodl = fieldattach::getValue($this->item->id, 11);
    $vmcode = fieldattach::getValue($this->item->id, 10);
    $vmnu = fieldattach::getValue($this->item->id, 4);
    $vmstat = fieldattach::getValue($this->item->id, 5);
    $stock_status = fieldattach::getValue($this->item->id, 6);
    $vmgrp = fieldattach::getValue($this->item->id, 7);
    $wwg_description = fieldattach::getValue($this->item->id, 3);
    $wwg_group = fieldattach::getValue($this->item->id, 2);
    $vgdes = fieldattach::getValue($this->item->id, 8);
    $pre_desc = fieldattach::getValue($this->item->id, 9);
    $serial = fieldattach::getValue($this->item->id, 12);
    $vm_rrp = fieldattach::getValue($this->item->id, 24);
    $vm_model_rrp = fieldattach::getValue($this->item->id, 36);
    $vm_trd_price = fieldattach::getValue($this->item->id, 23);
    $vat_code = fieldattach::getValue($this->item->id, 21);
    $vat_code = fieldattach::getValue($this->item->id, 38);
    $srp_name = fieldattach::getValue($this->item->id, 25);
    $srp_email = fieldattach::getValue($this->item->id, 26);
    $srp_mobile = fieldattach::getValue($this->item->id, 27);
    $dep_name = fieldattach::getValue($this->item->id, 30);
    $dep_tel = fieldattach::getValue($this->item->id, 33);
    $dep_email = fieldattach::getValue($this->item->id, 34);
    $dep_address = fieldattach::getValue($this->item->id, 31);
    $dep_postcode = fieldattach::getValue($this->item->id, 32);
    $vm_depot = fieldattach::getValue($this->item->id, 28);
    $pictures = fieldattach::getValue($this->item->id, 39);
    $nessplant = fieldattach::getValue($this->item->id, 40);
    $price_range = fieldattach::getValue($this->item->id, 42);
?>
<div class="item-page<?php echo $this->pageclass_sfx; ?> ibcos_item" itemscope itemtype="http://schema.org/Product">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
	<div class="row-fluid">
        <div class="span7">
            <?php if ($this->params->get('show_page_heading', 1)) : ?>
            <div class="page-header">
                <h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
            </div>
            <?php endif; ?>
            
            <div class="page-header">
                <h2 itemprop="name"><?php echo $this->escape($this->item->title); ?></h2>
                <?php if ($this->item->state == 0) : ?>
                    <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
                <?php endif; ?>
                <?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
                    <span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
                <?php endif; ?>
                <?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != '0000-00-00 00:00:00') : ?>
                    <span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
                <?php endif; ?>
            </div>



            <?php 
            echo $this->item->event->afterDisplayTitle;
            echo $this->item->event->beforeDisplayContent;
            ?>


            <div itemprop="articleBody">
                <?php #echo $this->item->text; ?>
                <div class="share_icons">
                    <?php
                    # PDF code
                    require('pdf/pdf.php');
                    # find out the filename
                    $pdf_filename = get_pdf_filename( $this->item->id );
                    # full file name and path
                    $pdf_full_filename = "images/product_pdfs/" . $pdf_filename;
                    # create the generate-on-the-fly link
                    $pdf_link = JURI::base() . "pdf/?id=" . $this->item->id;
                    ?>
                    <a href="<?php echo $pdf_link ?>" target="_blank"  title="View PDF Stock Sheet" class="social_pdf">&nbsp;</a>
                    <?php
                    $mail_subject = "Agricar Product";
                    $mail_body = urlencode("Hi \n\nHave a look at this product " . $pre_desc . " " . $vmspec . " on the Agricar website. \n\nSee  " . JURI::current() . " ");
                    ?>
                    <a target="_blank" href="mailto:?subject=<?php echo $mail_subject; ?>&body=<?php echo $mail_body; ?>" title="Email This" class="social_mail">&nbsp;</a>
                    <a target="_blank" href="#" id="bookmark_this" title="Bookmark This" class="social_fave">&nbsp;</a>
                    <?php
                    # manufacturer brochure, stored in the vmloc field
                    if ($vmloc) {
                        ?>
                        <a href="/images/brochure_pdfs/<?php echo $vmloc ?>" target="_blank"  title="View Manufacturer's Brochure" class="social_brochure">&nbsp;</a>
                        <?php
                    }
                    
                    ?>
                </div>

                

                
                <div class="ibcos_details">
                
                    <h4>Price: &pound;<?php echo $vm_model_rrp; ?></h4> 
                    
                    <h4>Details</h4>       
                    <h6><?php echo $vmspec; ?></h6>
                    <div>
                        <span class="title"> Make:</span>
                        <span class="value"><?php echo $pre_desc; ?></span>
                    </div>
                    <div>
                        <span class="title"> Item:</span>
                        <span class="value"><?php echo $vmcode; ?></span>
                    </div>
                    <div>
                        <span class="title"> Model:</span>
                        <span class="value"><?php echo $vmmodl; ?></span>
                    </div> 
                    <div>
                        <span class="title"> Year:</span>
                        <span class="value"><?php echo $vm_year; ?></span>
                    </div> 
                    <div>
                        <span class="title"> Hours:</span>
                        <span class="value"><?php echo $vm_wsj_clk; ?></span>
                    </div> 
                    <div>
                        <span class="title"> Registration:</span>
                        <span class="value"><?php echo $vmreg; ?></span>
                    </div>                    
                    <div>
                        <span class="title"> Stock Code:</span>
                        <span class="value"><?php echo $vmstok; ?></span>
                    </div>   
                    <div>
                        <span class="title"> Price:</span>
                        <span class="value">&pound;<?php echo $vm_model_rrp; ?></span>
                    </div> 
                    

                    <span class="share_icons" style="margin-top: 16px;">
                        <?php
                        $mail_subject = "Agricar Product Enquiry";
                        $mail_body = urlencode("Hi \n\nI am interested in a product...\n\n" . $pre_desc . " " . $vmspec . "\n\n...on the Agricar website. \n\nSee...\n  " . JURI::current() . "\n\nPlease contact me with more details.");
                        if ($srp_email) {
                            $enquiry_to = $srp_email;
                        } else if ($dep_email) {
                            $enquiry_to = $dep_email;
                        } else {
                            $config = JFactory::getConfig();
                            $enquiry_to = $config->get( 'config.mailfrom' );
                        }                        
                        ?>
                        <a target="_blank" href="mailto:<?php echo $enquiry_to; ?>?subject=<?php echo $mail_subject; ?>&body=<?php echo $mail_body; ?>" title="Email Us About This product" class="social_ques">&nbsp;</a>
                    </span>                       
                    <h4>Contact</h4> 
                    <?php 
                    if (!$srp_name AND !$srp_mobile ) {
                        echo "Please contact the depot.<br/>";
                    } else {    
                        if ($srp_name) echo "Sales contact name: " . $srp_name . "<br/>";
                        if ($srp_email) echo "Sales contact email: " . $srp_email . "<br/>";
                        if ($srp_mobile) echo "Sales contact phone: " . $srp_mobile . "<br/>";
                    }           
                    ?>
                    
                    <?php
                    if ($nessplant == "yes") {
                        echo "<img src=\"images/ibcos/ness_plant_logo.png\" style=\"float: right; margin-top: 12px;\"/> \n";
                    }                    
                    ?>
                    <h4>Depot</h4> 
                    <?php 
                    echo $dep_name . "<br/>";
                    echo $dep_address . "<br/>";
                    echo $dep_postcode . "<br/>";
                    echo $dep_tel . "<br/>";
                    echo $dep_email . "<br/>";
                    ?>
                </div>
                
                                
                <?php
                /*
                echo "<pre>";
                echo "For reference purposes, the full ibcos field is listed below.  This is for review purposes only and will be removed before the site goes live: <br/>";
                echo "vmstok: " . $vmstok . "<br/>";
                echo "wwg_group: " . $wwg_group . "<br/>";
                echo "wwg_description: " . $wwg_description . "<br/>";
                echo "vmnu: " . $vmnu . "<br/>";
                echo "vmstat: " . $vmstat . "<br/>";
                echo "stock_status: " . $stock_status . "<br/>";
                echo "vmgrp: " . $vmgrp . "<br/>";
                echo "vgdes: " . $vgdes . "<br/>";
                echo "pre_desc: " . $pre_desc . "<br/>";
                echo "vmcode: " . $vmcode . "<br/>";
                echo "vmmodl: " . $vmmodl . "<br/>";
                echo "serial: " . $serial . "<br/>";
                echo "vmspec: " . $vmspec . "<br/>";
                echo "vm_year: " . $vm_year . "<br/>";
                echo "vmrdat: " . $vmrdat . "<br/>";
                echo "vm_wsj_clk: " . $vm_wsj_clk . "<br/>";
                echo "vm_engine: " . $vm_engine . "<br/>";
                echo "vmreg: " . $vmreg . "<br/>";
                echo "vmdreg: " . $vmdreg . "<br/>";
                echo "vm_condition: " . $vm_condition . "<br/>";
                echo "vat_code: " . $vat_code . "<br/>";
                echo "vm_model_rrp: " . $vm_model_rrp . "<br/>";
                echo "vm_trd_price: " . $vm_trd_price . "<br/>";
                echo "vm_rrp: " . $vm_rrp . "<br/>";
                echo "srp_name: " . $srp_name . "<br/>";
                echo "srp_email: " . $srp_email . "<br/>";
                echo "srp_mobile: " . $srp_mobile . "<br/>";
                echo "vm_depot: " . $vm_depot . "<br/>";
                echo "vmloc: " . $vmloc . "<br/>";
                echo "dep_name: " . $dep_name . "<br/>";
                echo "dep_address: " . $dep_address . "<br/>";
                echo "dep_postcode: " . $dep_postcode . "<br/>";
                echo "dep_tel: " . $dep_tel . "<br/>";
                echo "dep_email: " . $dep_email . "<br/>";
                echo "pictures: " . $pictures . "<br/>";
                echo "nessplant: " . $nessplant . "<br/>";
                echo "price_range: " . $price_range . "<br/>";
                echo "</pre>";
                */
                ?>
                
                <?php echo $this->item->event->afterDisplayContent; ?> 
            </div>
        </div>
        <div class="span5">
            <div class="ibcos_images">
            <?php  
            if ($pictures) {
                ?>
                <script type="text/javascript" language="javascript">
                jQuery(document).ready(function(){         
                jQuery('a.colorbox').colorbox({rel:'colorbox', width:900, height:650});
                });
                </script>
                <?php
                $images_array = explode(",", $pictures);
                foreach ($images_array as $image) {
                   #echo "<a class=\"modal\" href=\"images/ibcos/large_" . $image. "\" >";
                   
                   echo "<a class=\"colorbox\" href=\"/images/ibcos/large_" . $image. "\" >";
                   echo "<img src=\"images/ibcos/medium_" . $image. "\" /> ";
                   echo "</a> \n";
                }
            } else {
                if ($nessplant == "yes") {
                    echo "<img src=\"images/ibcos/no_image_ness.png\" /> \n";
                } else {
                    echo "<img src=\"images/ibcos/no_image.png\" /> \n";
                }
            }
            ?>
            </div>
        </div>
    </div>
</div>    
<?php 


} else { 
?>
<div class="item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif;
if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
{
	echo $this->item->pagination;
}
?>
	<?php if (!$useDefList && $this->print) : ?>
		<div id="pop-print" class="btn hidden-print">
			<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
		</div>
		<div class="clearfix"> </div>
	<?php endif; ?>
	<?php if ($params->get('show_title') || $params->get('show_author')) : ?>
	<div class="page-header">
		<h2 itemprop="name">
			<?php if ($params->get('show_title')) : ?>
				<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
					<a href="<?php echo $this->item->readmore_link; ?>" itemprop="url"> <?php echo $this->escape($this->item->title); ?></a>
				<?php else : ?>
					<?php echo $this->escape($this->item->title); ?>
				<?php endif; ?>
			<?php endif; ?>
		</h2>
		<?php if ($this->item->state == 0) : ?>
			<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
		<?php endif; ?>
		<?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
			<span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
		<?php endif; ?>
		<?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != '0000-00-00 00:00:00') : ?>
			<span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if (!$this->print) : ?>
		<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php if ($useDefList) : ?>
			<div id="pop-print" class="btn hidden-print">
				<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
		<div class="article-info muted">
			<dl class="article-info">
			<dt class="article-info-term"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>

			<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
				<dd class="createdby" itemprop="author" itemscope itemtype="http://schema.org/Person">
					<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
					<?php $author = '<span itemprop="name">' . $author . '</span>'; ?>
					<?php if (!empty($this->item->contact_link) && $params->get('link_author') == true) : ?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', $this->item->contact_link, $author, array('itemprop' => 'url'))); ?>
					<?php else: ?>
						<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_parent_category') && !empty($this->item->parent_slug)) : ?>
				<dd class="parent-category-name">
					<?php $title = $this->escape($this->item->parent_title); ?>
					<?php if ($params->get('link_parent_category') && !empty($this->item->parent_slug)) : ?>
						<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '" itemprop="genre">' . $title . '</a>'; ?>
						<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
					<?php else : ?>
						<?php echo JText::sprintf('COM_CONTENT_PARENT', '<span itemprop="genre">' . $title . '</span>'); ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_category')) : ?>
				<dd class="category-name">
					<?php $title = $this->escape($this->item->category_title); ?>
					<?php if ($params->get('link_category') && $this->item->catslug) : ?>
						<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?>
						<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
					<?php else : ?>
						<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span itemprop="genre">' . $title . '</span>'); ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>

			<?php if ($params->get('show_publish_date')) : ?>
				<dd class="published">
					<span class="icon-calendar"></span>
					<time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'c'); ?>" itemprop="datePublished">
						<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
					</time>
				</dd>
			<?php endif; ?>

			<?php if ($info == 0) : ?>
				<?php if ($params->get('show_modify_date')) : ?>
					<dd class="modified">
						<span class="icon-calendar"></span>
						<time datetime="<?php echo JHtml::_('date', $this->item->modified, 'c'); ?>" itemprop="dateModified">
							<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
						</time>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_create_date')) : ?>
					<dd class="create">
						<span class="icon-calendar"></span>
						<time datetime="<?php echo JHtml::_('date', $this->item->created, 'c'); ?>" itemprop="dateCreated">
							<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
						</time>
					</dd>
				<?php endif; ?>

				<?php if ($params->get('show_hits')) : ?>
					<dd class="hits">
						<span class="icon-eye-open"></span>
						<meta itemprop="interactionCount" content="UserPageVisits:<?php echo $this->item->hits; ?>" />
						<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
					</dd>
				<?php endif; ?>
			<?php endif; ?>
			</dl>
		</div>
	<?php endif; ?>

	<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>

		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>

	<?php if (!$params->get('show_intro')) : echo $this->item->event->afterDisplayTitle; endif; ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($params->get('access-view')):?>
	<?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
	<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
	<div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image"> <img
	<?php if ($images->image_fulltext_caption):
		echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) . '"';
	endif; ?>
	src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" itemprop="image"/> </div>
	<?php endif; ?>
	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative):
		echo $this->item->pagination;
	endif;
	?>
	<?php if (isset ($this->item->toc)) :
		echo $this->item->toc;
	endif; ?>
	<div itemprop="articleBody">
		<?php echo $this->item->text; ?>
	</div>

	<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
		<div class="article-info muted">
			<dl class="article-info">
			<dt class="article-info-term"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>

			<?php if ($info == 1) : ?>
				<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
					<dd class="createdby" itemprop="author" itemscope itemtype="http://schema.org/Person">
						<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
						<?php $author = '<span itemprop="name">' . $author . '</span>'; ?>
						<?php if (!empty($this->item->contact_link) && $params->get('link_author') == true) : ?>
							<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', $this->item->contact_link, $author, array('itemprop' => 'url'))); ?>
						<?php else: ?>
							<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_parent_category') && !empty($this->item->parent_slug)) : ?>
					<dd class="parent-category-name">
						<?php $title = $this->escape($this->item->parent_title); ?>
						<?php if ($params->get('link_parent_category') && $this->item->parent_slug) : ?>
							<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '" itemprop="genre">' . $title . '</a>'; ?>
							<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
						<?php else : ?>
							<?php echo JText::sprintf('COM_CONTENT_PARENT', '<span itemprop="genre">' . $title . '</span>'); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_category')) : ?>
					<dd class="category-name">
						<?php $title = $this->escape($this->item->category_title); ?>
						<?php if ($params->get('link_category') && $this->item->catslug) : ?>
							<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?>
							<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
						<?php else : ?>
							<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span itemprop="genre">' . $title . '</span>'); ?>
						<?php endif; ?>
					</dd>
				<?php endif; ?>
				<?php if ($params->get('show_publish_date')) : ?>
					<dd class="published">
						<span class="icon-calendar"></span>
						<time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'c'); ?>" itemprop="datePublished">
							<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
						</time>
					</dd>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ($params->get('show_create_date')) : ?>
				<dd class="create">
					<span class="icon-calendar"></span>
					<time datetime="<?php echo JHtml::_('date', $this->item->created, 'c'); ?>" itemprop="dateCreated">
						<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
					</time>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_modify_date')) : ?>
				<dd class="modified">
					<span class="icon-calendar"></span>
					<time datetime="<?php echo JHtml::_('date', $this->item->modified, 'c'); ?>" itemprop="dateModified">
						<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
					</time>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_hits')) : ?>
				<dd class="hits">
					<span class="icon-eye-open"></span>
					<meta itemprop="interactionCount" content="UserPageVisits:<?php echo $this->item->hits; ?>" />
					<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
				</dd>
			<?php endif; ?>
			</dl>
			<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
				<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
				<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative):
	echo $this->item->pagination;
?>
	<?php endif; ?>
	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php // Optional teaser intro text for guests ?>
	<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
	<?php echo $this->item->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JUri($link1);?>
	<p class="readmore">
		<a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->item->attribs); ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
				echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; ?>
		</a>
	</p>
	<?php endif; ?>
	<?php endif; ?>
	<?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
	echo $this->item->pagination;
?>
	<?php endif; ?>
	<?php echo $this->item->event->afterDisplayContent; ?> </div>

    
    
    
    
<?php 




}

?>    
