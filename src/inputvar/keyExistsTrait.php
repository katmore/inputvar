<?php
/**
 * \inputvar\value class definition 
 *
 * PHP version >=5.4
 * 
 * Copyright (c) 2012-2015 Doug Bird. 
 *    All Rights Reserved. 
 *    
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * @license The MIT License (MIT) http://opensource.org/licenses/MIT
 * @license GNU General Public License, version 3 (GPL-3.0) http://opensource.org/licenses/GPL-3.0
 * @link https://github.com/katmore/inputvar
 * @author     D. Bird <retran@gmail.com>
 * @copyright  Copyright (c) 2010-2015 Doug Bird. All Rights Reserved.
 * 
 * @author D. Bird
 * @link http://github.com/katmore/inputvar
 *
 */
/**
 * inptuvar namespace
 */
namespace inputvar;
/**
 * trait with functionality to implement keyExists interface
 *    and __isset magic method.
 * 
 * @package    inputvar
 * @author     D. Bird <retran@gmail.com>
 * @copyright  Copyright (c) 2010-2015 Doug Bird. All Rights Reserved.
 * 
 */
trait keyExistsTrait {
   /**
    * @var bool indicator of wheather key associated with an inputvar did exist.
    */
   private $_exists = false;

   /**
    * Indicates that the key associated with an inputvar did exist.
    * @return void
    * @see exists()
    */
   protected function _setExistsOn() {
      $this->_exists = true;
   }
   /**
    * Indicates that the key associated with an inputvar did not exist.
    * @return void
    * @see exists()
    */
   protected function _setExistsOff() {
      $this->_exists = false;
   }
   /**
    * Indicates wheather or not the key associated with this inputvar exists.
    * 
    * @return bool
    */
   public function exists() {
      return $this->_exists;
   }
}