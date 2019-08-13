# 安装酷博

---
- [添加域名解析](#section-1)
- [安装酷博](#section-2)
- [绑定网站](#section-3)

<a name="section-1"></a>
## 添加域名解析
一个博客当然要有自己的专属域名啦，一个.com后缀的域名大概在五十人民币左右。如果还没有域名的朋友请先去注册购买一个。  
购买完毕后将dns解析到你的服务器ip上即可。
如果你的服务器在大陆网站是需要先备案才能正常访问的。具体备案流程请咨询你的服务器提供商，他们会协助你完成备案。

<a name="section-2"></a>
## 安装酷博
通过SSH连上服务器，移动到存放网站的根目录    
```bash
cd /www/wwwroot/
```
Composer是PHP的包管理工具，如果使用宝塔集成环境默认会安装好，如果没有安装请自行安装Composer  
使用阿里云镜像加速Composer  
```bash
composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
```
下载酷博源码(请将xxx.com替换成你自己的域名)  
```bash
composer create-project flex/blog xxx.com
```
稍等2分钟左右就会安装完毕，安装成功会如下图所示：  
![安装成功](/images/docs/install_success.png)  
> {warning} 如果你是以root用户执行的，请执行`chown -R www.www xxx.com` 请将xxx.com改为你自己的目录，命令是更改源码目录的用户组为www，宝塔集成环境中Nginx、Mysql、PHP是以www用户组运行的，不更改将导致权限问题无法写入数据。
 
<a name="section-3"></a>
## 绑定网站
部署完源码后，登录管理面板，依次点击左部菜单的网站，然后在点击添加网站：  
![添加网站](/images/docs/add_site.png)  
填写完毕后点击添加按钮。   
![网站信息](/images/docs/site_info.png)  
将源码根目录.env文件中的数据库配置信息改为上方保存的信息。  
```text
DB_CONNECTION="mysql"
DB_HOST="127.0.0.1" #数据库ip地址 默认即可
DB_PORT=3306 #数据库端口 默认即可
DB_DATABASE=blog #数据库名称
DB_USERNAME=root #数据库用户名
DB_PASSWORD=123456 #数据库密码
```
进入网站设置(看不清点击图片放大看)
![网站设置](/images/docs/setting_open.png)  
修改网站运行目录  
![运行目录](/images/docs/setting_dir.png)  
配置伪静态  
![伪静态](/images/docs/setting_htaccess.png)  
开启https  
![SSL](/images/docs/setting_ssl.png)  
修改完毕后，在终端执行安装命令  
```bash
php artisan blog:install
```
至此, 安装完成 ^_^。





