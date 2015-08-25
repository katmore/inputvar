<?php
/**
 * \inputvar class definition 
 *
 * PHP version >=5.6
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
 * abstract parent class to facilitate conveniently filtering external input
 * 
 * @package    inputvar
 * @author     D. Bird <retran@gmail.com>
 * @copyright  Copyright (c) 2010-2015 Doug Bird. All Rights Reserved.
 * 
 * @abstract
 */
abstract class inputvar {
   /**
    * @var string unfiltered value of input
    */
   private $_rawval;
   /**
    * @param string $rawval unfiltered vlaue of input
    * @return void
    */
   protected function _setRawval($rawval) {
      $this->_rawval = $rawval;
   }
   /**
    * Retrieve input value stripped of all characters except that needed for a US Street address.
    * @return string
    */
   public function streetaddr() {
      return preg_replace('/[^A-Za-z0-9 _\.\s\#]/', '',$this->rawval);
   }
   /**
    * Retrieve input value stripped of HTML tags, high/low ascii chars.
    * @return string
    */
   public function value() {
      
      $val = $this->rawval;
      
      $val = strip_tags($val);
      
      preg_replace('/[\x00-\x08\x0B-\x1F]/', '', $val);
      
      return $val;
      //for this generic function remove the most 'dangerous' shit
      //return filter_var($this->rawval,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW+FILTER_FLAG_STRIP_HIGH);
   }
   /**
    * Retrieve input value stripped except what is needed for email address.
    * @return string 
    */
   public function email() {
      //return $this->rawval;
      if ( preg_match(
         "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",
         $this->rawval) ) {
            return $this->rawval;
      }
      throw new inputvar\invalidEmail();
   }
   /**
    * Retrieve input value stripped except for alphanumeric chars and space.
    * @return string
    */
   public function alphanumspace() {
      return preg_replace('/[^A-Za-z0-9 _]/', '',$this->rawval);
   }
   /**
    * Retrieve input value stripped except for chars "0","1","2","3","4","5","6","7","8" and "9".
    * @return string
    */
   public function numeric() {
      return preg_replace('/[^0-9]/', '',$this->rawval);
   }
   /**
    * Retrieve input value stripped except for alphanumeric chars.
    * @return string
    */
   public function alphanum() {
      
      $alphanum = preg_replace('/[^A-Za-z0-9_]/', '',$this->rawval);
      
      return $alphanum;
      
   }
   /**
    * Retrieve input value formatted as US phone number.
    * @return string
    */
   public function usphone() {
      return preg_replace('~(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})$~', '$1-$2-$3', $this->numeric());
   }
} 