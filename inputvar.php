<?php
/**
 * YOU SHOULD NOT NEED TO INCLUDE THIS FILE !!! 
 *    IT ONLY NEEDED IF you are not using composer or some psr0/psr4 autoloading routine.
 *    
 * This file invokes includes to the files needed for inputvar namespaced class definitions.
 * It also includes explanatory comments and a placeholder to an include for a file containing 
 * optional class definitions for legacy class names.
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
 * The original inputvar package organized the class definitions into a single file
 * and used nomenclature not compliant with psr-2/psr-4. For those that wish to avoid 
 * having to refactor existing code I have provided classes recreating the
 * naming and functionality of the old package.
 * 
 * To enable the legacy support:
 * require the file /legacy-inputvar.php. 
 * ie: require(__DIR__.'/legacy-inputvar.php'); 
 * 
 * @see /legacy-inputvar.php for legacy compatiblility with pre-2015-08 package.
 */
/*
 * uncomment the following line to provide legacy class aliases.
 */
//include(__DIR__.'/legacy-inputvar.php');