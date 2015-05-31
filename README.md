# Baidu UEditor for Laravel 5

A laravel 5 package of UEditor,which is an open source WYSIWYG editor maintained by [Baidu FE team](http://ueditor.baidu.com/website/index.html)

这个package主要是为了方便自己的项目，本打算找个现成的，参考了现有的两个package，但是考虑到能否有长期的更新维护和灵活性的问题，
再考虑到自己也曾是Baidu FE UEditor Team的一员(只待了3周就被调走:D)，最终还是决定自己打包一个。

### 示例演示

先上个例子再说，[ueditor for laravel5](https://www.bigfeettrip.com/demo/ueditor)

请不要乱传图片，我服务器很脆弱的，谢了啊。

顺便打个广告，喜欢旅游的可以聊聊，搞搞基什么的，有兴趣也可以参与到项目中来，交流下看法，思路也可以的。

### 参考列表

- [stevenyangecho/laravel-u-editor](https://github.com/stevenyangecho/laravel-u-editor)
- [zhuzhichao/Ueditor](https://github.com/zhuzhichao/Ueditor)

主要参考了stevenyangecho/laravel-u-editor，能用的基本上都是直接拿过来用的，部分按自己的喜好调整了下，里面有用到七牛存储的代码，虽然目前项目中没有用到，
暂时也保留了下来，如果以后用到可以省点事。
另外这个貌似图片上传有问题，应该就是路由的问题，下面会提到。

对以上作者表示感谢。


## Install

Via Composer

``` bash
$ composer require "ender/laravel-ueditor:0.8.1"
```

## Usage

首先在laravel 配置文件app.php中增加对应的provider和alias

```php
'Ender\UEditor\UEditorServiceProvider'
```

```php
'UEditor'   => 'Ender\UEditor\UEditor'
```

然后在你的项目根目录执行

``` 
php artisan vendor:publish --provider='Ender\UEditor\UEditorServiceProvider'
```

UEditor所需要的资源文件、配置文件会分别发布到对应目录，之后你可以根据需要修改这些文件，当然也可以使用默认配置

你也可以选择通过tag参数指明只发布特定内容，如

```
php artisan vendor:publish --provider='Ender\UEditor\UEditorServiceProvider' --tag=config
```

为了方便，共分为config js css dialog third_party lang theme 七个tag，除了third_party最好是全部发布，除非你真的很想用自己的替换掉默认的

如果有了较大的改动需要强制覆盖已有的内容可以加上--force 参数

```php
php artisan vendor:publish --provider='Ender\UEditor\UEditorServiceProvider' --force
```

所有的资源文件会发布到/public/vendor/ueditor 目录下

php部分增加了lang的配置，会发布到默认的lang目录下，目前包括en zh_Cn zh_TW

基本配置文件包括一个php的配置文件ueditor.php,会发布到laravel的默认config目录中
前端的config.js会跟其他前端资源文件一样发布到/public/vendor/ueditor目录下

前端部分的使用可以参考UEditor[官方文档](http://fex.baidu.com/ueditor/)，这里不再赘述

为了方便，定义了几个辅助方法

- 输出对应的css

```php
{!! UEditor::css() !!} 输出UEditor的css
```

- 初始化编辑器容器

```php
{!! UEditor::content() !!}
```

- 输出对应的js

```php
{!! UEditor::js() !!}
```

### 实例化编辑器js代码

```js
<script type="text/javascript">
    var ue = UE.getEditor('ueditor'); //用辅助方法生成的话默认id是ueditor
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
    });
</script>
```

至此一个可用的编辑器已经有了，注意ue.execCommand是用来提交csrf token 参数的，这是laravel的特殊需要，不是UEditor本身的需要。

### 图片、视频等的上传

默认的处理上传的route是/ueditor/server，可以通过修改config.js的serverUrl值来修改这个值，

注意：

UEditor官方文档此值为
```
serverUrl: URL + "xxx"
```
这里改成了

```
serverUrl: "ueditor/server"
```

区别在于去掉了前面的URL,否则route会多出资源文件的路径，无法完成图片等的上传。


图片、视频等的默认上传目录为是在ueditor.php的配置文件中设定的，以图片为例具体配置项是

```
"imagePathFormat" => "/uploads/ueditor/image/{yyyy}{mm}{dd}/{time}{rand:6}",
```
这里做了一点调整，UEditor官方的默认路径是/uploads/ueditor/php/upload/image/{yyyy}{mm}{dd}/{time}{rand:6},路径比较深，
我们这里只针对php，所以去掉了php/upload 这两层。

上传路径大家可以根据需要自行修改，另外要保证你的public目录有写权限。

ueditor.php配置文件中的可以指定middleware来进行认证授权等的检查，默认是auth,大部分情况下是需要登陆才能上传文件的。


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Testing

``` bash
$ 
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.


## Credits


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
