<?php

// 	This is a small cheatsheet that will help you with your K2 Projects.
//	This is a living sheet so expect some things to change.
//	This code in meant for K2 Version 3
//	Happy coding from @fevangelou @lefteriskavadas and @kricore
// 	A special thanks to all of the community's members

// Legend:
// 1: Working on your template's index.php
// 2: Handling Images
// 3: Working with Extrafields
// 4: Working with K2 elements



//
//
// Working on your template
//
//

// Use Joomla!'s API in order to know what type of content you are viewing and use it to
// execute code (eg: show a module position) inside specific K2 views only or,
// avaibable tasks (views) - tag, category, user, search etc view bellow for other uses
//
// $itemid is the menu item's id.
$app			= JFactory::getApplication();
$option 		= JRequest::getCmd('option');
$view 			= JRequest::getCmd('view');
$layout 		= JRequest::getCmd('layout');
$page 			= JRequest::getCmd('page');
$task 			= JRequest::getCmd('task');
$id 			= JRequest::getInt('id');
$itemid 		= JRequest::getInt('Itemid');
$tmpl 			= JRequest::getCmd('tmpl');

// Detect the frontpage using Joomla!'s native way
$menu = $app->getMenu();
if($menu->getActive() == $menu->getDefault()) $isFrontpage = true; else $isFrontpage = false;

// Use Joomla!'s API in order to build a killer body class like WP does.
$bodyClass = '';
if($isFrontpage) 			$bodyClass .= ' is-frontpage';
if($option) 				$bodyClass .= ' cmt-is-'.ucfirst($option);
if($view) 				$bodyClass .= ' view-is-'.ucfirst($view);
if($layout) 				$bodyClass .= ' layout-is-'.ucfirst($layout);
if($page) 				$bodyClass .= ' page-is-'.ucfirst($page);
if($task) 				$bodyClass .= ' task-is-'.ucfirst($task);
if($id) 				$bodyClass .= ' id-is-'.ucfirst($id);
if($itemid) 				$bodyClass .= ' itemId-is-'.ucfirst($itemid);
if($tmpl) 				$bodyClass .= ' tmpl-isi'.ucfirst($tmpl);
if($tmpl=='component') 			$bodyClass .= ' contentpane component wrapper--component';
if($tmpl=='raw')			$bodyClass .= ' wrapper--raw';
$bodyClass = trim($bodyClass); ?>

<body class="<?php echo $bodyClass; ?>">

<?php
//
if($option == 'com_k2' && $view == 'item' ):

	//Code that renders inside the item only

elseif($option == 'com_k2' && $view == 'itemlist' && $task=='category'):

	//Code that renders inside the category only
else:

	//Fallback
endif;


// Add a script in your template
$document = JFactory::getDocument();
$document->addScript($url);


// Add a stylesheet in your template
$document = JFactory::getDocument();
$document->addStylesheet($url);


//
//
// Image Handling
//
//

// Use a default image as a placeholder.
if($this->item->params->get('itemImage') && !empty($this->item->image)): ?>

	<img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" />

<?php else: ?>

	<img src="PLACEHOLDER_URL.jpg" alt="<?php echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" />

<?php endif;


// Use an extrafield instead of K2's images - The extrafield is a TEXT one
if( $this->item->params->get('itemImage') && $this->item->extraFields->EXTRAFIELDALIASHERE->value !== '' ): ?>

	<img src="<?php echo $this->item->extraFields->EXTRAFIELDALIASHERE->value; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" />

<?php endif; ?>


// Use an extrafield instead of K2's images - The extrafield is an IMAGE one
<?php if( $this->item->params->get('itemImage') && $this->item->extraFields->EXTRAFIELDALIASHERE->value !== '' ):
	$var = $this->item->extraFields->EXTRAFIELDALIASHERE->value ;     
	$var = preg_replace('/<img src="/',"",$var); 
	$var = preg_replace('/"> alt="Image" \>/'," ",$var); ?>

	<img src="<?php echo $var; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" />

<?php endif; ?>

<?php
// Use responsive images (srcset) K2 Version 3.
// You might need to adapt the image names to reflect your setup
?>

<img src="<?php echo $this->item->image->src; ?>" alt="<?php echo $this->escape($this->item->image->alt); ?>" style="width:<?php echo $this->item->image->width; ?>px; height:auto;" itemprop="image"
	srcset="<?php echo $this->item->image['xsmall']->src; ?> 320w,
			<?php echo $this->item->image['small']->src; ?> 400w, 
			<?php echo $this->item->image['medium']->src; ?> 600w, 
			<?php echo $this->item->image['large']->src; ?> 768w,
			<?php echo $this->item->image['large']->src; ?> 2x"
	/>
<?php 

//
//
// Working with Extrafields
//
//


// Render a specific extrafield
if( isset( $this->item->extraFields->EXTRAFIELDALIASHERE->value ) && ( $this->item->extraFields->EXTRAFIELDALIASHERE->value !== '') ) 
{
	$this->item->extraFields->EXTRAFIELDALIASHERE->name;
	$this->item->extraFields->EXTRAFIELDALIASHERE->value;
}


// Use extrafields as meta data - thank you @heyjoecampbell and @kbrookes
$doc = JFactory::getDocument();
if ( isset( $this->item->extraFields->title_tag->value ) && ($this->item->extraFields->title_tag->value !=='') ) {
	$doc->addCustomTag('<title>'.$this->item->extraFields->title_tag->value.'</title>');
}
if ( isset( $this->item->extraFields->meta_description->value ) && ($this->item->extraFields->meta_description->value !=='') ) {
	$doc->addCustomTag('<meta name="description" content="'.$this->item->extraFields->meta_description->value.'" />');
}
// See also https://gist.github.com/kricore/2c9a5434748c5f5f6cf9

// Cleanup the extrafields content so you can use them as metatags
$safe 		= array("", "");
$nonsafe 	= array("'", "\"");
$custometa  = $this->item->extraFields->NAME->value;
$safemeta 	= str_replace( $nonsafe, $safe, $custometa);
echo $safemeta;


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
<?php endif;


//
//
// K2 Template checks
//
//

// Get all of the item's content (or $item)
var_dump($this->item);


// Check if the item belongs to a certain category, category->id will work as well
if($this->item->category->name == 'Category Name') 
{
	// Do something
}


// Get the item's alias
echo $this->item->alias;


// Display a certain tag based on its position
echo $this->item->tags[0]->name;

