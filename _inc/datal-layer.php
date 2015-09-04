<?php

//
//
// K2 Data layer (introduced in version 3)
//
//

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

