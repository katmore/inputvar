<?php
/**
 * \inputvar\post class definition 
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
 *    typically those from form submissions.
 * 
 * @package    inputvar
 * @author     D. Bird <retran@gmail.com>
 * @copyright  Copyright (c) 2010-2015 Doug Bird. All Rights Reserved.
 * 
 */
class post extends \inputvar 
   implements keyExists
{
   
   use keyExistsTrait;
   /**
    * Maps value from the $_POST superglobal.
    * 
    * @param string $key alphanumeric query key
    * @throws \inputvar\invalidInputKey When key is not alphanumeric.
    */   
   protected function _initPost($key) {
      
      if (preg_match('/[^A-Za-z0-9_]/',$key) ) {
         throw new invalidInputKey("key must be alphanumeric");
      }
      
      
      if (isset($_POST[$key])) {
         $this->_setRawval($_POST[$key]);
         $this->_setExistsOn();
      } else {
         $this->setRawval("");
         $this->_setExistsOff();
      }
   }
   /**
    * @see \inputvar\post::_initPost()
    */
   public function __construct($key) {
      $this->_initPost($key);
   }
   
}