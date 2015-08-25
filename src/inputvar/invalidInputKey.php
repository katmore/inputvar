<?php
/**
 * \inputvar\invalidInputKey exception class definition. 
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
 * invalidInputKey exception 
 * 
 * @package    inputvar
 * @author     D. Bird <retran@gmail.com>
 * @copyright  Copyright (c) 2010-2015 Doug Bird. All Rights Reserved.
 * 
 */
class invalidInputKey extends invalidInput {
   /**
    * Provides reason why input key was invalid.
    * @return string
    */
   public function getReason() {
      return $this->_reason;
   }
   /**
    * @var string reason why input key was invalid.
    */
   private $_reason;
   /**
    * @param string $reason reason why input key is invalid
    */
   public function __construct($reason) {
      $this->_reason = $reason;
      parent::__construct($reason,1);
   }
}