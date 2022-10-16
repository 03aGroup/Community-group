backend是后台的，里面的config文件下的test.php尽量不要动。
jwt如果出现问题更改service层下面的JwtValidataData里面的路径，setID改成动态的，空间引用
短信宝直接调用，里面配置按照注释进行更改成自己的

更目录composer.json文件下写的都是配置，支付，redis版本等写里面，写法   安装的路径：版本号

Es搜索，端口号不一样，将composer.json里面版本可自行更改，在common文件下的params.php更改端口号

密码service层进行更改，如果有问题，控制器之间复制加密和校验
加密：$hash_password = Yii::$app->security->generatePasswordHash('123456');
校验：$bool = Yii::$app->security->validatePassword($password, $hash_password);
$password为输入的密码，它是没有经过加密的字符串
$hash_password为原先加密的密码