<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HelloWorld</title>
</head>
<body>
<h3>这是一封激活邮件</h3>
<h4><p>尊敬的{{$uname}}!您好!</p></h4>
<a href="http://shop.com/reg/email/{{$user}}/{{$token}}/{{$uname}}">点击本链接激活邮箱即可登录</a>
<p>本邮件激活链接有效仅保存十分钟!十分钟后则失效不能进行激活!</p>
</body>
</html>