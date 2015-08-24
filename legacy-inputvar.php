<?php
/**
 * Provides class aliases for legacy usage of inputvar.php package.
 * The original inputvar package organized the class definitions into a single file
 *    and used non-psr2 nomenclature. It also included some features that I found to be
 *    superfluous or weird, and thus removed.
 * 
 * PHP version >=5.6
 * 
 * Copyright (c) 2010-2015 Doug Bird. 
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
 */
/**
 * inputvar class definition files
 */
include_once(__DIR__.'/src/inputvar/invalidInput.php');
include_once(__DIR__.'/src/inputvar/invalidEmail.php');
include_once(__DIR__.'/src/inputvar/inputKeyNotFound.php');
include_once(__DIR__.'/src/inputvar/keyExistsInterface.php');
include_once(__DIR__.'/src/inputvar/keyExistsTrait.php');
include_once(__DIR__.'/src/inputvar.php');
include_once(__DIR__.'/src/inputvar/get.php');
include_once(__DIR__.'/src/inputvar/post.php');
include_once(__DIR__.'/src/inputvar/request.php');
include_once(__DIR__.'/src/inputvar/value.php');
include_once(__DIR__.'/src/inputvar/postGroup.php');
include_once(__DIR__.'/src/inputvar/postWithKey.php');
/**
 * The legacy 'getvar' class is an alias of the \inputvar\get class.
 * 
 * @see \inputvar\get
 */
class getvar extends \inputvar\get{}

/**
 * The legacy 'getvar' class is an alias of the \inputvar\post class.
 * 
 * @see \inputvar\post
 */
class postvar extends \inputvar\post {
   /**
    * alias of _initPost()
    */
   protected function initPostvar($key) {
      return self::_initPost($key);
   }
}

/**
 * The legacy 'reqvar' class is an alias of the \inputvar\request class.
 * 
 * @see \inputvar\request
 */
class reqvar extends \inputvar\request{}

/**
 * The legacy 'varvar' class is an alias of the \inputvar\value class.
 * 
 * @see \inputvar\value
 */
class varvar extends \inputvar\value implements \inputvar\keyExistsInterface {
   /**
    * Always returns true, as this was an arbitrary value to begin with.
    * 
    * @return bool
    */
   public function exists() {
      return true;
   }
}

/**
 * The legacy 'postvar_withdata' class is an alias of the \inputvar\postWithdata class.
 * 
 * @see \inputvar\postWithdata
 */
class postvar_withdata extends \inputvar\postWithKey{
   public function __get($what) {
      if ($what == "name") return $this->getKey();
   }
}

/**
 * The legacy 'postvar_group' class is an alias of the \inputvar\postGroup class.
 * 
 * @see \inputvar\postGroup
 */
class postvar_group extends \inputvar\postGroup{}



















