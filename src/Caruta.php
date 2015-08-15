<?php namespace Sukohi\Caruta;

use Illuminate\Support\Facades\Request;

class Caruta {

	const ORDER_KEY = 'orderby';
	const DIRECTION_KEY = 'direction';
	private $_url = '';
	private $_texts = [
		'asc' => '&#8593;', 
		'desc' => '&#8595;'
	];
	private $_keys = [
		'order' => self::ORDER_KEY, 
		'direction' => self::DIRECTION_KEY
	];
	private $_appends = [];

	public function url($url) {
	
		$this->_url = $url;
		return $this;
	
	}
	
	public function text($asc_text, $desc_text, $default_text = null) {
		
		if(!is_null($default_text)) {
			
			$this->_texts = [
				'asc' => $asc_text,
				'desc' => $desc_text, 
				'default' => $default_text
			];
			
		} else {

			$this->_texts = [
				'asc' => $asc_text,
				'desc' => $desc_text
			];
			
		}
		return $this;
		
	}
	
	public function appends($params) {
		
		$this->_appends = $params;
		return $this;
		
	}
	
	public function keys($order_key, $direction_key) {
		
		$this->_keys = [
			'order' => $order_key, 
			'direction' => $direction_key
		];
		return $this;
		
	}
	
	public function asc($column) {
		
		return $this->link($column, $this->_texts['asc'], 'asc');
		
	}
	
	public function desc($column) {
		
		return $this->link($column, $this->_texts['desc'], 'desc');
		
	}
	
	public function links($column, $separator='') {
		
		if(isset($this->_texts['default'])) {
			
			$mode = 'default';
			
			if(Request::has($this->_keys['order'])
					&& Request::get($this->_keys['order']) == $column) {
				
				$current_direction = Request::input($this->_keys['direction']);
						
				if(in_array($current_direction, ['asc', 'desc'])) {
					
					$mode = $current_direction;
					
				}
				
			}
			
			$text = $this->_texts[$mode];
			$direction = ($mode == 'asc') ? 'desc' : 'asc';
			return $this->link($column, $text, $direction);
			
		}
		
		$links = $this->asc($column) . $separator . $this->desc($column);
		$this->_url = '';
		$this->_texts = [
			'asc' => '&#8593;',
			'desc' => '&#8595;'
		];
		$this->_keys = [
			'order' => self::ORDER_KEY,
			'direction' => self::DIRECTION_KEY
		];
		$this->_appends = [];
		return $links;
		
	}
	
	public function sort($model, $columns = [], $default_sort = []) {
		
		$current_direction = Request::input($this->_keys['direction']);
		$current_column = Request::input($this->_keys['order']);
		
		if(!in_array($current_direction, ['asc', 'desc']) || !in_array($current_column, $columns)) {
			
			if(!empty($default_sort)) {
				
				$model->orderBy($default_sort[0], $default_sort[1]);
				
			}
			
			return $model;
			
		}
		
		return $model->orderBy($current_column, $current_direction);
		
	}
	
	private function link($column, $text, $direction) {
		
		$params = $this->_appends + [
			$this->_keys['order'] => $column, 
			$this->_keys['direction'] => $direction
		];
		
		if(Request::has($this->_keys['order'])
				&& Request::input($this->_keys['order']) == $column
				&& Request::input($this->_keys['direction']) == $direction) {
			
			return $text;
			
		}
		
		if(empty($this->_url)) {
			
			$this->_url = Request::url();
			
		}
		
		return '<a href="'. $this->_url .'?'. http_build_query($params) .'">'. $text .'</a>';
		
	}
	
}