<?php
/**
 * @version		3.0.0
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2015 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access

// This renders the front-end of the field
defined('_JEXEC') or die ; ?>

<?php
	// Needed Scripts and styles for the demo 
	// In a production environment, these should be moved to your template's main js and css files
?>
<div class="map">
 	<div class="marker" data-lat="<?php echo $field->get('lat'); ?>" data-lng="<?php echo $field->get('long'); ?>"></div>
</div>
