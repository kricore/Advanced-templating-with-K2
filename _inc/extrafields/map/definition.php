<?php
/**
 * @version		3.0.0
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2015 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die ; 

// Some simple params for our maps.
// Choose between bing or Google Maps
?>

<select name="<?php echo $field->get('prefix'); ?>[type]">
	<option value="gmaps">Google Maps</option>
	<option value="bing">Bing Maps</option>
</select>