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
// This is waht the user will see.
defined('_JEXEC') or die ; ?>

<?php
	// In a production environment, these should be moved to your template's main js and css files
 
	// Check if the user has chosen Bing maps.
if( $field->get('type') == 'bing' ): ?>

<div id="mapviewer">
	<iframe id="map" scrolling="no" frameborder="0"
 src="http://www.bing.com/maps/embed/?v=2&amp;cp=<?php echo $field->get('lat'); ?>~<?php echo $field->get('long'); ?>&amp;lvl=9&amp;sty=r&amp;form=LMLTEW"></iframe><div id="LME_maplinks" style="line-height:20px;"><a id="LME_largerMap" href="http://www.bing.com/maps/?v=2&amp;cp=-13.110234~-49.371449&amp;lvl=9&amp;sty=r&amp;form=LMLTEW" target="_blank" style="margin:0 7px">View Larger Map</a><a id="LME_directions" href="http://www.bing.com/maps/?v=2&amp;cp=-13.110234~-49.371449&amp;lvl=9&amp;sty=r&amp;form=LMLTEW&amp;rtp=%7Epos.-13.110233719820414_-49.371449316406256_GO" target="_blank" style="margin:0 7px">Driving Directions</a></div>
 </div>

<?php else: 
	// Use Google maps instead
	// This example uses the iframe code. If you want to us the new version you need to uncomment the code and add the assets folder's contents in your template.
?>
<iframe src="https://maps.google.com/maps?q=37.9908372,23.7383394&amp;z=14&amp;output=embed&amp;iwloc=0" frameborder="0" style="border:0" allowfullscreen></iframe>

<?php /*
<div class="map">
 	<div class="marker" data-lat="<?php echo $field->get('lat'); ?>" data-lng="<?php echo $field->get('long'); ?>"></div>
</div>
*/ ?>
<?php endif; ?>
