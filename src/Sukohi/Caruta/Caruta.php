<?php namespace Sukohi\Caruta;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\HTML;
use Illuminate\Support\Facades\Input;
class Caruta {

	const ORDER_KEY = 'orderby';
	const DIRECTION_KEY = 'direction';
	private $_url = '';
	private $_texts = array(
		'asc' => '&#8593;', 
		'desc' => '&#8595;'
	);
	private $_keys = array(
		'order' => self::ORDER_KEY, 
		'direction' => self::DIRECTION_KEY
	);
	private $_appends = array();

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
		
		return $this->asc($column) . $separator . $this->desc($column);
		
	}
	
	private function link($column, $text, $direction) {
		
		$params = $this->_appends + array(
			$this->_keys['order'] => $column, 
			$this->_keys['direction'] => $direction
		);
		
		if(Input::has($this->_keys['order']) && Input::get($this->_keys['direction']) == $direction) {
			
			return $text;
			
		}
		
		if(empty($this->_url)) {
			
			$this->_url = Request::url();
			
		}
		
		return '<a href="'. $this->_url .'?'. http_build_query($params) .'">'. $text .'</a>';
		
	}
	
}