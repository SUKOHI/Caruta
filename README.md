Caruta
=====

A PHP package mainly developed for Laravel to generate sort link(s).

Installation&setting for Laravel
====

After installation using composer, add the followings to the array in  app/config/app.php

    'providers' => array(  
        ...Others...,  
        'Sukohi\Caruta\CarutaServiceProvider', 
    )

Also

    'aliases' => array(  
        ...Others...,  
        'Caruta' => 'Sukohi\Caruta\Facades\Caruta',
    )

Usage
====
**Minimal way**  
    
    {{ Caruta::links('column_name') }}

**with Options**

    echo Caruta::url('http://example.com')  
        ->text('&#8593;', '&#8595;')  
        ->appends(array(
			'key1' => 'value1',  
			'key2' => 'value2',  
			'key3' => 'value3'  
		))
		->keys('order', 'direction')
		->links('column_name', $separator = ''); 

*All methods except links() are skippable.

License
====
This package is licensed under the MIT License.

Copyright 2014 Sukohi Kuhoh