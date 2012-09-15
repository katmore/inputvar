<?php
/**
 * gateway/include/inputvar.inc.php
 * 
 * Purpose:
 *    the place to use any potentially 'dangerous' input from client
 *    such as _GET _POST vars
 *    
 *    idea: a small place that can be evaluated for proper filtering, security, etc
 * 
 * Created:
 *    6/6/2012 by DB
 * 
 */



class inputvar {
   
   private $rawval;
   
   public function myesc($myi,$striphighlow=true) {
      if (!is_a($myi,"mysqli")) throw new Exception("must be given mysqli object",3);
      $val = $this->rawval;
      if ($striphighlow) {
         $val = preg_replace('/[^A-Za-z0-9 _\.\s\#]/', '',$val);
      }
      return $myi->real_escape_string($val);
   }
   
   protected function setRawval($rawval) {
      $this->rawval = $rawval;
   }
   
   public function streetaddr() {
      return preg_replace('/[^A-Za-z0-9 _\.\s\#]/', '',$this->rawval);
   }
   
   public function value() {
      
      $val = $this->rawval;
      
      $val = strip_tags($val);
      
      preg_replace('/[\x00-\x08\x0B-\x1F]/', '', $val);
      
      return $val;
      //for this generic function remove the most 'dangerous' shit
      //return filter_var($this->rawval,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW+FILTER_FLAG_STRIP_HIGH);
   }
   
   public function email() {
      //return $this->rawval;
      if ( preg_match(
         "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",
         $this->rawval) ) {
            return $this->rawval;
      }
      throw new Exception("inputvar is not valid email",2);
   }
   
   public function alphanumspace() {
      return preg_replace('/[^A-Za-z0-9 _]/', '',$this->rawval);
   }
   
   public function numeric() {
      return preg_replace('/[^0-9]/', '',$this->rawval);
   }
   
   public function alphanum() {
      
      $alphanum = preg_replace('/[^A-Za-z0-9_]/', '',$this->rawval);
      
      return $alphanum;
      
   }
   
   public function usphone() {
      return preg_replace('~(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})$~', '$1-$2-$3', $this->numeric());
   }
} /*end class inputvar*/


class varvar extends inputvar {
   
   public function exists() {
      return true;
   }
   
   public function __construct($rawval) {
      $this->setRawval($rawval);
   }
}

class getvar extends inputvar {
   
   
   private $exists;
   
   public function exists() {
      return $this->exists;
   }
   
   public function __construct($key) {
      
      if (preg_match('/[^A-Za-z0-9_]/',$key) ) {
         throw new Exception("getvar key must be alphanumeric",1);
      }
      
      
      if (isset($_GET[$key])) {
         $this->setRawval($_GET[$key]);
         $this->exists = true;
      } else {
         $this->setRawval("");
         $this->exists = false;
      }
      
   }/*end getvar.constructor*/
   

   
}/* end class getvar*/

class postvar extends inputvar {
   
   
   private $exists;
   
   public function exists() {
      return $this->exists;
   }
   
   public function __construct($key) {
      
      if (preg_match('/[^A-Za-z0-9_]/',$key) ) {
         throw new Exception("getvar key must be alphanumeric",1);
      }
      
      
      if (isset($_POST[$key])) {
         $this->setRawval($_POST[$key]);
         $this->exists = true;
      } else {
         $this->setRawval("");
         $this->exists = false;
      }
      
   }/*end getvar.constructor*/
   

   
}/* end class postvar*/

class reqvar extends inputvar {
   
   
   private $exists;
   
   public function exists() {
      return $this->exists;
   }
   
   public function __construct($key) {
      
      if (preg_match('/[^A-Za-z0-9_]/',$key) ) {
         throw new Exception("getvar key must be alphanumeric",1);
      }
      
      
      if (isset($_REQUEST[$key])) {
         $this->setRawval($_REQUEST[$key]);
         $this->exists = true;
      } else {
         $this->setRawval("");
         $this->exists = false;
      }
      
   }/*end getvar.constructor*/
   

   
}/* end class reqvar*/