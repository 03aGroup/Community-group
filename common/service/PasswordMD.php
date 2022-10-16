<?php

class PasswordMD{
    public static $key = '123';
    //加密
    public function hash($key){
        $hash_password = Yii::$app->security->generatePasswordHash($key);

        return $hash_password;
    }
    //校验
    public function bool($password,$hash_password){
        $bool_password = Yii::$app->security->validatePassword($password,$hash_password);

        return $bool_password;
    }
}
