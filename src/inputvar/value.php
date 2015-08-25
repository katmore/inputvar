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
 * conveniently filter external input from arbitrary value
 * 
 * @package    inputvar
 * @author     D. Bird <retran@gmail.com>
 * @copyright  Copyright (c) 2010-2015 Doug Bird. All Rights Reserved.
 * 
 * @abstract
 */
class value extends \inputvar 
   implements keyExists
{

   /**
    * Sets arbitrary value for inputvar.
    * @param string $rawval
    */
   public function __construct($rawval) {
      $this->_setRawval($rawval);
   }
}