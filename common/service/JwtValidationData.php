<?php
 namespace app\components;

 class JwtValidationData extends \sizeg\jwt\JwtValidationData
 {
     public function init()
     {
         $this->validationData->setIssuer('http://example.com');
         $this->validationData->setAudience('http://example.com');
         $this->validationData->setId('4f1g23a12aa');

         parent::init();
     }
 }
