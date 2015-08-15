Caruta
=====

A PHP package mainly developed for Laravel to generate sort link(s).

![alt text](http://i.imgur.com/qT8TjJn.png)
![alt text](http://i.imgur.com/5RerRSA.png)  

Installation
====

Add this package name in composer.json

    "require": {
      "sukohi/caruta": "2.*"
    }

Execute composer command.

    composer update

Register the service provider in app.php

    'providers' => [
        ...Others...,  
        Sukohi\Caruta\CarutaServiceProvider::class,
    ]

Also alias

    'aliases' => [
        ...Others...,  
        'Caruta'   => Sukohi\Caruta\Facades\Caruta::class
    ]

Usage
====
**Minimal way**  
    
    {{ Caruta::links('your-column-name') }}
    
(example)  
![alt text](http://i.imgur.com/qT8TjJn.png)  

**with Options**

    echo Caruta::url('http://example.com')  
        ->text('&#8593;', '&#8595;')  
        ->appends([
			'key1' => 'value1',  
			'key2' => 'value2',  
			'key3' => 'value3'  
		])
		->keys('order', 'direction')
		->links('column_name', $separator = ''); 

* All methods except links() are optional. See [methods](#methods)

**Single Text Way**  

If you set the third argument like the below, only one link will be displayed.  

    Caruta::text(
        '<i class="fa fa-sort-asc"></i>',  
        '<i class="fa fa-sort-desc"></i>',  
        '<i class="fa fa-sort"></i>'
    );

(example)

![alt text](http://i.imgur.com/5RerRSA.png)  

**Sort with model**  
With model(Eloquent), you can automatically set "ORDER BY" like the below.

	$items = Item::select('id', 'title');
	$items = Caruta::sort($items, 
	    ['id', 'title', 'created_at'], 
	    ['updated_at', 'asc']
	);
	dd($items->get()->toArray());
	
* The second argument(Array) means that except specific column name(s) will be ignored to set "ORDER BY" for secure.   
* The third argument(Array) will be used for default. And direction canbe `asc` and `desc`
  
**Note:** If you changed the parameter name "ORDER BY" to other using keys() method, you also need to set it in this case as well.

Methods<a name="methods">
====

* url($url)

`$url` is base URL that will be included in `href` property.

* text($one, $two)

`$one` and `$two` are text that will be included in link tag.

e.g. &lt;a href="****"&gt;YOUR-TEXT&lt;/a&gt;

* appends($values)

`$values` is additional values that you want to include in link URL.

e.g. http://example.com?orderby=*****&direction=asc&YOUR-KEY=YOUR-VALUE

License
====
This package is licensed under the MIT License.

Copyright 2014 Sukohi Kuhoh