<?php
/**
 * inputvar class definitions
 *
 * PHP version >=7.1
 *
 * Copyright (c) 2012-2017 Doug Bird.
 *    All Rights Reserved.
 *
 * COPYRIGHT NOTICE:
 * inputvar. https://github.com/katmore/inputvar
 * Copyright (C) 2010-2017  Doug Bird.
 * ALL RIGHTS RESERVED. THIS COPYRIGHT APPLIES TO THE ENTIRE CONTENTS OF THE WORKS HEREIN
 * UNLESS A DIFFERENT COPYRIGHT NOTICE IS EXPLICITLY PROVIDED WITH AN EXPLANATION OF WHERE
 * THAT DIFFERENT COPYRIGHT APPLIES. WHERE SUCH A DIFFERENT COPYRIGHT NOTICE IS PROVIDED
 * IT SHALL APPLY EXCLUSIVELY TO THE MATERIAL AS DETAILED WITHIN THE NOTICE.
 *
 * 'inputvar' is copyrighted free software.
 * You can redistribute it and/or modify it under either the terms and conditions of the
 * "The MIT License (MIT)" (see the file MIT-LICENSE.txt); or the terms and conditions
 * of the "GPL v3 License" (see the file GPL-LICENSE.txt).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @license The MIT License (MIT) http://opensource.org/licenses/MIT
 * @license GNU General Public License, version 3 (GPL-3.0) http://opensource.org/licenses/GPL-3.0
 * @link https://github.com/katmore/inputvar
 * @author     D. Bird <retran@gmail.com>
 * @copyright  Copyright (c) 2010-2017 Doug Bird. All Rights Reserved.
 */

/**
 * runtime error encountered by an inputvar object
 */
class inputvar_exception extends RuntimeException{}

/**
 * facilitate sanitizing any potentially 'dangerous' input that may be encountered
 */
abstract class inputvar {
   /**
    * @var string
    */
   private $_rawval;
   /**
    * Determines wheather or not a value 'exists'
    * 
    * @return bool true if value exists, false otherwise
    */
   abstract public function exists() : bool;
   
   /**
    * enumeration of all valid input value 'types'
    */
   const INPUTVAR_TYPES = [
      'myesc',
      'streetaddr',
      'value',
      'email',
      'alphanumspace',
      'alphanum',
      'numeric',
      'usphone', 
   ];
   /**
    * @var string the 'type' associated with current input value
    *    default: 'value'
    */
   private $_type='value';
   
   /**
    * Sets the input value 'type'
    * @param string $type Specify type, must be one of the following:
    * <ul>
         <li>myesc</li>
         <li>streetaddr</li>
         <li>value</li>
         <li>email</li>
         <li>alphanumspace</li>
         <li>alphanum</li>
         <li>numeric</li>
         <li>usphone</li> 
    * </ul>
    * 
    * @return void
    * @throws inputvar_exception when the specified input value type (<b>$type</b>) is invalid
    * 
    * @see \inputvar::INPUTVAR_TYPES
    */
   public function setType(string $type) :void {
      if (!in_array($type,static::INPUTVAR_TYPES)) {
         throw new inputvar_exception("unknown input value 'type', must be one of: ".implode(", ",static::INPUTVAR_TYPES),4);
      }
   }
   
   /**
    * Provides the 'input value' after escaping with mysqli::real_escape_string(),
    *    optionally stripping non-printable chars.
    *    
    * @param \mysqli $mysqli mysqli object
    * @param bool $striphighlow Optional, default (bool) true.<br> 
    *    If set to (bool) true, input value will be sanitized by stripping 
    *    'high' and 'low' (non-printable) chars if value is true.
    * 
    * @return string sanitized input value
    */
   public function myesc(mysqli $mysqli,bool $striphighlow=true) :string {
      $val = $this->_rawval;
      if ($striphighlow) {
         $val = filter_var($val,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW+FILTER_FLAG_STRIP_HIGH);
      }
      return $mysqli->real_escape_string($val);
   }
   /**
    * Set the raw value
    * @param string $rawval raw value
    * @return void
    */
   protected function _setRawval(string $rawval) : void {
      $this->_rawval = $rawval;
   }
   
   /**
    * Provides value striped of all chars except what is needed for a street address.
    * 
    * @return string sanitized input value
    */
   public function streetaddr() :string {
      return preg_replace('/[^A-Za-z0-9 _\.\s\#]/u', '',$this->_rawval);
   }
   
   /**
    * Provides value stripped of stripped of HTML tags 
    *    and non-printable or control characters.
    *
    * @return string sanitized input value
    */
   public function value() :string {
      
      $val = $this->_rawval;
      
      $val = strip_tags($val);
      
      preg_replace('/[\x00-\x08\x0B-\x1F]/u', '', $val);
      
      return $val;;
   }
   
   /**
    * Validates if input value is a valid email address according to RFC 822 syntax.
    *
    * @return string sanitized input value
    * @throws inputvar_exception when input value is not a valid email address
    */
   public function email() : string{
      //return $this->_rawval;
      if ( filter_var($this->_rawval, FILTER_VALIDATE_EMAIL,FILTER_FLAG_EMAIL_UNICODE) ) {
            return $this->_rawval;
      }
      throw new inputvar_exception("inputvar is not valid email",2);
   }
   
   /**
    * Provides value stripped of all but alphanumeric chars.
    * 
    * @param bool $allow_space Optional, default (bool) true.
    *    If set to (bool) true, spaces will not be stripped.
    *    
    * @param bool $allow_underscore Optional, default (bool) true.
    *    If set to (bool) true, underscores will not be stripped.
    *
    * @return string sanitized input value
    */
   public function alphanumspace(bool $allow_space=true,bool $allow_underscore=true):string {
      
      $expr_suffix="";
      if ($allow_space) $expr_suffix .= " ";
      if ($allow_underscore) $expr_suffix .= "_";
      //$alphanum = preg_replace('/[^A-Za-z0-9_]/', '',$this->rawval);
      $val = preg_replace("/[^A-Za-z0-9$expr_suffix]/", '',$this->_rawval);
      //return preg_replace('/[^A-Za-z0-9 _]/', '',$this->rawval);
      return $val;
   }
   
   /**
    * Provides value stripped of all chars except 0-9,
    *    optionally allowing a decimal point. 
    *
    * @param bool $allow_decimal Optional, default (bool) false.
    *    If set to (bool) true, valid decimal point notation will not be stripped.
    *
    * @return string sanitized input value
    * 
    * @see localeconv() Decimal point char determined by value of localeconv()['decimal_point']
    */
   public function numeric(bool $allow_decimal=false) :string {
      if ($allow_decimal) {
         $d = localeconv()['decimal_point'];
         $val = preg_replace("/[^0-9$d]/u", '',$this->_rawval);
         if (substr_count($val,$d)<2) return $val;
      }
      return preg_replace("/[^0-9]/u", '',$this->_rawval);
   }
   
   /**
    * Provides value stripped of all but alpha chars.
    *
    * @param bool $allow_underscore Optional, default (bool) true.
    *    If set to (bool) true, underscores will not be stripped.
    *
    * @return string sanitized input value
    */
   public function alphanum(bool $allow_underscore=true) :string{
      $expr_suffix="";
      if ($allow_underscore) $expr_suffix .= "_";
      //$alphanum = preg_replace('/[^A-Za-z0-9_]/', '',$this->rawval);
      $alphanum = preg_replace("/[^A-Za-z0-9$expr_suffix]/u", '',$this->_rawval);
      
      return $alphanum;
      
   }
   
   /**
    * Provides value stripped of all but chars relevant to displaying 
    *    a NANP phone number with 'dash' separators
    *    <ul>
    *       <li><b>format:</b> areaCode-officePrefix-stationCode</li>
    *       <li><b>example:</b> (ie: "800-555-1234")</li>
    *    </ul>
    * @return string sanitized input value
    */
   public function usphone() :string {
      return preg_replace('~(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})$~', '$1-$2-$3', $this->numeric());
   }
} /*end class inputvar*/

/**
 * facilitate sanitizing any potentially 'dangerous' input that may be encountered
 */
class varvar extends inputvar {
   /**
    * Determines if value existed
    *
    * @return bool true if a value exists, false otherwise.
    */
   public function exists() :bool {
      return true;
   }
   /**
    * Specify the raw value to sanitize.
    * 
    * @param string $rawval the raw value to sanitize.
    */
   public function __construct(string $rawval) {
      $this->_setRawval($rawval);
   }
}

/**
 * facilitate mapping and sanitizing any potentially 'dangerous' input that may be encountered
 *    via 'GET' data
 * @see http://php.net/manual/en/reserved.variables.get.php
 */
class getvar extends inputvar {
   
   
   /**
    * @var bool true if a value existed for the specified GET key name, false otherwise.
    */
   private $_exists;
   /**
    * Determines if value existed for the specified GET key name.
    * 
    * @return bool true if a value exists, false otherwise.
    */
   public function exists() :bool {
      return $this->_exists;
   }
   /**
    * Derives the raw 'input value' from a 'GET' variable.
    *
    * @param string $key The 'GET' variable key name from which to derive the 'input value'.
    *    aka: 'getvar key'
    *    
    * @throws inputvar_exception when an invalid 'GET' variable key is specified
    * 
    * @see http://php.net/manual/en/reserved.variables.get.php
    */
   public function __construct(string $key) {
      
      if (preg_match('/[^A-Za-z0-9_]/',$key) ) {
         throw new inputvar_exception("getvar key must be alphanumeric",1);
      }
      
      
      if (isset($_GET[$key])) {
         $this->_setRawval($_GET[$key]);
         $this->_exists = true;
      } else {
         $this->_setRawval("");
         $this->_exists = false;
      }
      
   }/*end getvar.constructor*/
   

   
}/* end class getvar*/

/**
 * facilitate mapping and sanitizing any potentially 'dangerous' input that may be encountered
 *    via 'POST' data
 * @see http://php.net/manual/en/reserved.variables.post.php
 */
class postvar extends inputvar {
   
   /**
    * @var bool true if a value existed for the specified POST key name, false otherwise.
    */
   private $_exists;
   /**
    * Determines if value existed for the specified POST key name.
    *
    * @return bool true if a value exists, false otherwise.
    */
   public function _exists() :bool {
      return $this->_exists;
   }
   /**
    * Derives the raw 'input value' from a 'POST' variable.
    *
    * @param string $key The 'POST' variable key name from which to derive the 'input value'.
    * 
    * @return void
    * 
    * @throws inputvar_exception when an invalid 'POST' variable key is specified
    */
   protected function _initPostvar(string $key) :void {
      
      if (preg_match('/[^A-Za-z0-9_]/',$key) ) {
         throw new inputvar_exception("postvar key must be alphanumeric",1);
      }
      
      
      if (isset($_POST[$key])) {
         $this->_setRawval($_POST[$key]);
         $this->_exists = true;
      } else {
         $this->_setRawval("");
         $this->_exists = false;
      }
   }
   /**
    * Derives the raw 'input value' from a 'POST' variable.
    * 
    * @param string $key The 'POST' variable key name from which to derive the 'input value'.
    *    aka: 'postvar key'
    * @see http://php.net/manual/en/reserved.variables.post.php
    */
   public function __construct(string $key) {
      $this->_initPostvar($key);
      
   }/*end getvar.constructor*/
   

   
}/* end class postvar*/

/**
 * facilitate mapping and sanitizing any potentially 'dangerous' input that may be encountered
 *    via 'REQUEST' data
 * @see http://php.net/manual/en/reserved.variables.request.php
 */
class reqvar extends inputvar {
   
   /**
    * @var bool true if a value exists, false otherwise.
    */
   private $_exists;
   /**
    * Determines if value existed for the specified REQUEST key name.
    *
    * @return bool true if a value exists, false otherwise.
    */
   public function _exists() :bool{
      return $this->_exists;
   }
   /**
    * Derives the raw 'input value' from a 'REQUEST' variable.
    *
    * @param string $key The 'REQUEST' variable key name from which to derive the 'input value'.
    *    aka: 'reqvar key'
    *    
    * @throws inputvar_exception when an invalid 'REQUEST' variable key is specified
    * @see http://php.net/manual/en/reserved.variables.request.php
    */
   public function __construct(string $key) {
      
      if (preg_match('/[^A-Za-z0-9_]/',$key) ) {
         throw new inputvar_exception("reqvar key must be alphanumeric",1);
      }
      
      
      if (isset($_REQUEST[$key])) {
         $this->_setRawval($_REQUEST[$key]);
         $this->_exists = true;
      } else {
         $this->_setRawval("");
         $this->_exists = false;
      }
      
   }/*end getvar.constructor*/
   

   
}/* end class reqvar*/

/**
 * facilitate mapping and sanitizing any potentially 'dangerous' input that may be encountered
 *    via 'POST' data with ability to provide the key name for future reference
 * @see http://php.net/manual/en/reserved.variables.post.php
 */
class postvar_withdata extends postvar {
   /**
    * @var string the 'POST' variable key name
    */
   private $_name;
   /**
    * Magically create the 'readonly' property 'name'
    */
   public function __get($what) {
      if ($what == "name") return $this->_name;
   }
   /**
    * Provides the 'POST' variable key name associated with this 'input value'.
    * @return string key name 
    */
   public function getName() :string {
      return $this->_name;
   }
   /**
    * Derives the raw 'input value' from a 'POST' variable.
    *
    * @param string $key The 'POST' variable key name from which to derive the 'input value'.
    *    aka: 'postvar key'
    *    
    * @throws inputvar_exception when an invalid 'POST' variable key is specified
    */
   public function __construct(string $key) {
      
      $this->_initPostvar($key);
      $this->_name = $key;
      
   }
}

/**
 * facilitate mapping and sanitizing a set of potentially 'dangerous' input that may be encountered
 *    via 'POST' data with ability to provide the key name for future reference
 * @see http://php.net/manual/en/reserved.variables.post.php
 */
class postvar_group {
   /**
    * provide each postvar_withdata object created from the list of 'POST' variable key names
    * 
    * @return postvar_withdata[]
    */
   public function enumPostvar() : array {
      return $this->_postvar;
   }
   /**
    * @var postvar_withdata[]
    *    the postvar_withdata input value objects
    *    created from the list of 'POST' variable key names
    */
   private $_postvar;//postvar_withdata
   /**
    * Magically creates 'readonly' properties for each
    *   with the same name as the provided 'POST' variable key names
    *   so long as the 'POST' key did actually exist.
    *   
    */
   public function __get($what) {
      foreach ($this->_postvar as $postvar) {
         if ($postvar->getName() == $what) return $postvar;
      }
      //throw new inputvar_exception("key name not found in group",2);
   }
   /**
    * Provide a list of 'POST' variable key names
    * from which to derive 'input values'.
    * 
    * @param array $postvar specify list of postvars, if 
    *    an element is itself an array, each element of that array
    *    will be recursively used to specify postvars as well.
    */
   private function _populate_postvars(array $postvar) {
      foreach ($postvar as $var) {
         if (is_array($var)) {
            $this->_populate_postvars($var);
         } else {
            $this->_postvar[] = new postvar_withdata($var);
         }
      }
   }
   /**
    * Provide a list of 'POST' variable key names
    * from which to derive 'input values'.
    * 
    * @param mixed $postvar,... If a single array argument is specified, each element value
    *    indicates a 'POST' variable key name. If one or more arguments are specified, each
    *    indicates a 'POST' variable key name.
    * 
    * @throws inputvar_exception when an invalid 'POST' variable key is specified
    * @see http://php.net/manual/en/reserved.variables.post.php
    */
   public function __construct(...$postvar) {
      
      
      $this->_populate_postvars($postvar);
      
      
   }
   
}















