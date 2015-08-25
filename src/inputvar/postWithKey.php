<?php
/**
 * \inputvar\postWithKey class definition 
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
 * Convenience class to filter POST method key-values...
 *    typically those from form submissions while also storing the
 *    corresponding key name for later retrieval.
 * 
 * @package    inputvar
 * @author     D. Bird <retran@gmail.com>
 * @copyright  Copyright (c) 2010-2015 Doug Bird. All Rights Reserved.
 * 
 */
class postWithKey extends postvar {
   private $_key;
   /**
    * Retrieves key name post input mapped from.
    * @return string
    */
   public function getKey() {
      return $this->_key;
   }
   /**
    * Maps value from the $_POST superglobal, storing the
    * key name for future retrieval.
    * 
    * @throws \inputvar\invalidInputKey When key is not alphanumeric.
    * @see \inputvar\post::_initPost()
    */
   public function __construct($key) {
      
      $this->_initPost($key);
      $this->_key = $key;
      
   }
}