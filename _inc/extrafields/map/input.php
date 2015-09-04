<?php
/**
 * @version		3.0.0
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2015 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die ; ?>
<div class="jw--block--field">
	<input type="text" name="<?php echo $field->get('prefix'); ?>[lat]" value="<?php echo htmlspecialchars($field->get('lat'), ENT_QUOTES, 'UTF-8'); ?>" />
</div>

<div class="jw--block--field">
	<input type="text" name="<?php echo $field->get('prefix'); ?>[long]" value="<?php echo htmlspecialchars($field->get('long'), ENT_QUOTES, 'UTF-8'); ?>" />
</div>
