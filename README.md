Caruta
=====

A PHP package mainly developed for Laravel to generate sort link(s).

Installation&setting for Laravel
====

After installation using composer, add the followings to the array in  app/config/app.php

    'providers' => array(  
        ...Others...,  
        'Sukohi\Caruta\CarutaServiceProvider'  
    )

Also

    'aliases' => array(  
        ...Others...,  
        'Sukohi\Caruta\Facades\Caruta'
    )

Usage
====

echo Caruta::url('http://example.com')
		->text('&#8593;', '&#8595;')
		->appends(array(	// Skippable
			'name1' => 'value1', 
			'name2' => 'value2', 
			'name3' => 'value3'
		))
		->keys('order', 'direction')	// Skippable
		->links('column_name'); 