<?php

// 	This is a small cheatsheet that will help you with your K2 Projects.
//	This is a living sheet so expect some things to change.
//	This code in meant for K2 Version 3
//	Happy coding from @fevangelou @lefteriskavadas and @kricore
// 	A special thanks to all of the community's members

// Fetch a single K2 item by ID
$item = K2Items::getInstance(12);


// Fetch an item by its alias
$item = K2Items::getInstance('docs');


// Fetching multiple items based on filters
// Get items from categories which have the IDs 33 and 40
$model = K2Model::getInstance('items');
// Apply publishing and ACL
$model->setState('site', true);
$model->setState('category', array(33, 40));
$model->setState('sorting', 'title');
$items = $model->getRows();

foreach ( $items as $item ) 
{
	// Do something
}


// Lazy loading.
// Access the item's tags from ANYWHERE
$item = K2Items::getInstance(12);

foreach ( $items->tags as $tag )
{ 
	echo $tag->name;
	echo $tag->link;
}


// Render a specific extrafield
if( isset( $this->item->extraFields->EXTRAFIELDALIASHERE->value ) && ( $this->item->extraFields->EXTRAFIELDALIASHERE->value ! == '') ) 
{
	$this->item->extraFields->EXTRAFIELDALIASHERE->name;
	$this->item->extraFields->EXTRAFIELDALIASHERE->value;
}



// Use extrafields as meta data - thank you Joe Campbell 
$doc = JFactory::getDocument();
$doc->addCustomTag('<title>'.$this->item->extraFields->title_tag->value.'</title>');
$doc->addCustomTag('<meta name="description" content="'.$this->item->extraFields->meta_description->value.'" />');

// See also https://gist.github.com/kricore/2c9a5434748c5f5f6cf9



//
// Excute code (eg: show a module position) inside specific K2 views only
// avaibable tasks (views) - tag, category, user, search
$option 		= JRequest::getCmd('option');
$view 			= JRequest::getCmd('view');
$layout 		= JRequest::getCmd('layout');
$page 			= JRequest::getCmd('page');
$task 			= JRequest::getCmd('task');
$id 			= JRequest::getInt('id');

//
if($option == 'com_k2' && $view == 'item' ):

	//Code that renders inside the item only

elseif($option == 'com_k2' && $view == 'itemlist' && $task=='category'):

	//Code that renders inside the category only
else:

	//Fallback
endif;


// Use a default image as a placeholder.
if(!empty($this->item->image)): ?>

	<img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" />

<?php else: ?>

	<img src="PLACEHOLDER_URL.jpg" alt="<?php echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" />

<?php endif;


//
// Just a normal K2 extrafields loop with the addition of icon fonts for social links instead of simple links.. 
// It requires the use of the extrafields aliases (eg twitter, facebook etc). 
// The icon- and -circled prefix and suffixed are based on the Entypo icon font from Fontello.
//
if($this->item->params->get('itemExtraFields') && count($this->item->extra_fields)): ?>
<!-- Item extra fields -->
<div class="itemExtraFields">
	<?php /*<h3><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h3>*/ ?>
	<ul>
	<?php foreach ($this->item->extra_fields as $key=>$extraField): ?>
	<?php if($extraField->value != ''): ?>
	<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">	
		<?php // Check if it is a social link 
			$ealias = $extraField->alias;
		?>
		<?php if(preg_match('[facebook|twitter|linkedin|gplus|vimeo|skype|youtube|dribbble|flickr|pinterest|tumblr]', $ealias)): ?>
		
			<?php if($extraField->type == 'header'): ?>
			<h4 class="itemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
			<?php else: ?>
			<?php
				// clean up the content 
				$string = $extraField->value;
				$initial = '">';
				$replacement = '"><i class="icon-'.$extraField->alias.'-circled"></i><span class="hidden">';
				$first = str_replace($initial, $replacement, $string);
				
				// once again add markup at the end
				$secondString = $first;
				$secondInit = '</a>';
				$secondRep = '</span></a>';
				
				// final result
				$final = str_replace($secondInit, $secondRep, $secondString);
			?>
			<span class="itemExtraFieldsValue"> 
				<?php echo $final; ?>
			</span>
			<?php endif; ?>
		
		<?php else: // Not a social link - display default extrafields ?>
		<span class="itemExtraFieldsLabel"><?php echo $extraField->name; ?>:</span>
		<span class="itemExtraFieldsValue"><?php echo $extraField->value; ?></span>
		<?php endif; ?>
	</li>
	<?php endif; ?>
	<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>


