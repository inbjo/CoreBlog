<h1 align="center"> CoreBlog </h1>

<p align="center">基于Laravel的一款博客系统</p>

### 支持的功能
* 前端响应式，支持在PC、手机、平板下访问；
* 用户注册、登录、退出；
* 根据用户email地址自动生成用户头像；
* 上传头像支持预览、裁剪；
* 用户注册需通过邮件验证；
* 用户支持编辑资料、更换头像、修改密码；
* 文章编辑使用markdown格式；
* 文章Url地址自动加密；
* 文章支持点赞、评论、打赏；
* 登录用户支持评论文章、点赞文章、点赞评论；
* 评论支持@功能、xss过滤；
* 文章被点赞、文章被评论、评论被点赞、评论被提及将收到站内通知；
* 支持支付宝、微信支付；
* 支持网站地图、RSS订阅；
* 友情链接增删改；
* 分类目录增删改；
* 支持后台ICP备案号修改、公安备案号修改；

### 服务器要求
* PHP >= 7.1.3
* GD PHP 拓展
* OpenSSL PHP 拓展
* PDO PHP 拓展
* Mbstring PHP 拓展
* Tokenizer PHP 拓展
* XML PHP 拓展
* Ctype PHP 拓展
* JSON PHP 拓展
* BCMath PHP 拓展
* Redis PHP 扩展(可选)

### 安装与配置
1. 克隆 CoreBlog 源代码到本地：
```
git clone https://github.com/inbjo/CoreBlog.git
```

2. 生成配置文件
```
cp .env.example .env    // 进入到项目目录
```
修改对应配置

3. 安装扩展包依赖
```
composer install      	// 进入到项目目录
```

4. 生成数据表及生成测试数据
```
$ php artisan migrate --seed
```

5 生成秘钥
```
php artisan key:generate
```
至此, 安装完成 ^_^。

## License

MIT
