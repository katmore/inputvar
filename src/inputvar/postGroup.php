<?php
/**
 * \inputvar\postGroup class definition 
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
 * inptuvar namespace
 */
namespace inputvar;
/**
 * Map one or more keys into corresponding post objects.
 * 
 * @package    inputvar
 * @author     D. Bird <retran@gmail.com>
 * @copyright  Copyright (c) 2010-2015 Doug Bird. All Rights Reserved.
 * 
 */
class postGroup {
   /**
    * @var postWithData[]
    */
   private $_post;
   /**
    * Magic Method implementation for __get().
    * Retrieves post object associated with key.
    * 
    * @see \inputvar\postGroup::get()
    */
   public function __get($key) {
      return $this->get($key);
   }
   /**
    * Magic Method implementation for __isset().
    * Returns (bool) true if post object is associated with given key,
    * otherwise returns (bool) false.
    * @return bool
    */
   public function __isset($key) {
      try {
         $this->get($key);
         return true;
      } catch (invalidInputKey $e) {
         return false;
      }
   }
   /**
    * Retrieve post object associated with a key.
    * 
    * @param string $key alphanumeric key corresponding to post object definition.
    * 
    * @return \inputvar\postWithData
    * 
    * @throws \inputvar\invalidInputKey given name is not found within group. 
    */
   public function get($key) {
      foreach ($this->_post as $post) {
         if ($postvar->getKey() == $key) return $post;
      }
      throw new inputKeyNotFound($key);
   }
   
   /**
    * Maps one or more keys into corresponding post objects.
    * 
    * @param string | string[] $key,... one or more keys (post var names) to map into post objects.
    */
   public function __construct() {
      
      $numargs = func_num_args();
      $arg_list = func_get_args();
      $this->_post=[];
      for ($i = 0; $i < $numargs; $i++) {
         if (is_array($arg_list[$i])) {
            foreach($arg_list[$i] as $a) {
               $this->_post[] = new postWithKey($a);
            }
         } else {
            $this->_post[] = new postWithKey($arg_list[$i]);
         }
      }
      
   }
   
}