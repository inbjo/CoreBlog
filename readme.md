<h1 align="center"> CoreBlog </h1>

<p align="center">一款简洁优雅的博客系统</p>

![preview](https://raw.githubusercontent.com/inbjo/CoreBlog/master/public/images/preview.png)

## 项目概述

* 产品名称：酷博
* 项目代码：CoreBlog
* 官方地址：https://www.inbjo.com/
* 文档地址：https://www.inbjo.com/docs

[CoreBlog](https://github.com/inbjo/CoreBlog) Laravel 5.8 版本。

## 主要功能
* 前端响应式，支持在PC、手机、平板下访问；
* 用户注册、登录、退出；
* 根据用户email地址自动生成用户头像；
* 上传头像支持预览、裁剪；
* 用户注册需通过邮件验证；
* 用户支持编辑资料、更换头像、修改密码；
* 文章编辑使用markdown格式；
* 新增文章时自动调用谷歌翻译生成友好的slug；
* 文章访问统计；
* 文章支持点赞、评论、打赏；
* 文章使用tntsearch做全文索引、jieba做中文分词；
* 登录用户支持评论文章、点赞文章、点赞评论；
* 评论支持@功能、xss过滤；
* 文章数据缓存；
* 文章被点赞、文章被评论、评论被点赞、评论被提及将收到站内通知；
* 支持邮件订阅；
* 支持支付宝、微信打赏；
* 支持网站地图、RSS订阅；
* 友情链接增删改；
* 分类目录增删改；
* 支持后台ICP备案号修改、公安备案号修改；
* 更多功能请查看demo；

## 服务器要求
* Nginx >= 1.8
* PHP >= 7.1.3
* Mysql >= 5.7
* Redis >= 3.0
* Sqlite PHP 拓展
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
#### 下载源码包
```
composer create-project flex/blog 
```

#### 修改配置文件
```
vi .env
```
修改数据库配置信息
```
DB_HOST="127.0.0.1" #数据库ip地址
DB_PORT=3306 #数据库端口
DB_DATABASE=blog #数据库名称
DB_USERNAME=root #数据库用户名
DB_PASSWORD=123456 #数据库密码
```

#### 执行安装命令
```
php artisan blog:install
```
至此, 安装完成 ^_^。更多请查看[在线文档](https://www.inbjo.com/docs)

## License
MIT
