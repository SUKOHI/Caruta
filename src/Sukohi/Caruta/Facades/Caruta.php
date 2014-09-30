<?php namespace Sukohi\Caruta\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class Caruta extends Facade {
 
  /**
   * コンポーネントの登録名を取得
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'caruta'; }
 
}