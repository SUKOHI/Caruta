<?php namespace Sukohi\Caruta;

class Caruta {

	const ORDER_KEY = 'orderby';
	const DIRECTION_KEY = 'direction';
	private $_url = '';
	private $_texts = array();
	private $_params = array();
	private $_keys = array(
		'order' => self::ORDER_KEY, 
		'direction' => self::DIRECTION_KEY
	);

	public function url($url) {
	
		$this->_url = $url;
		return $this;
	
	}
	
	public function text($asc_text, $desc_text) {
		
		$this->_texts = array(
			'asc' => $asc_text, 
			'desc' => $desc_text
		);
		return $this;
		
	}
	
	public function appends($params) {
		
		$this->_params = $params;
		return $this;
		
	}
	
	public function keys($order_key, $direction_key) {
		
		$this->_keys = [
			'order' => $order_key, 
			'direction' => $direction_key
		];
		return $this;
		
	}
	
	public function links($column, $separator='&nbsp;') {
		
		return $this->asc($column) . $separator . $this->desc($column);
		
	}
	
	public function asc($column) {
		
		return $this->link($column, $this->_texts['asc'], 'asc');
		
	}
	
	public function desc($column) {
		
		return $this->link($column, $this->_texts['desc'], 'desc');
		
	}
	
	private function link($column, $text, $direction) {
		
		$params = $this->_params + array(
			$this->_keys['order'] => $column, 
			$this->_keys['direction'] => $direction
		);
		
		if(isset($_GET[$this->_keys['order']]) && $_GET[$this->_keys['direction']] == $direction) {
			
			return $text;
			
		}
		
		return '<a href="'. $this->_url .'?'. http_build_query($params) .'">'. $text .'</a>';
		
	}
	
}

/*** Example

	echo Caruta::url('http://example.com')
			->text('&#8593;', '&#8595;')
			->appends(array(	// Skippable
				'name1' => 'value1', 
				'name2' => 'value2', 
				'name3' => 'value3'
			))
			->keys('order', 'direction')	// Skippable
			->links('column_name'); 

***/