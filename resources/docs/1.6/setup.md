# 安装酷博

---
- [添加域名解析](#section-1)
- [部署代码](#section-2)
- [绑定网站](#section-3)
- [安装酷博](#section-4)

<a name="section-1"></a>
## 添加域名解析
购买和解析域名比较简单，在这里就不在赘述了。如果您不太清楚如何操作可加QQ群[862180297](https://jq.qq.com/?_wv=1027&k=5l6VXeo)寻求帮助。
> {warning} 在大陆网站开设网站是需要先备案才能正常访问。具体备案流程请咨询你的服务器提供商，他们会协助你完成备案。

<a name="section-2"></a>
## 部署代码
通过SSH连上服务器，移动到存放网站的根目录    
```bash
cd /www/wwwroot/
```
Composer是PHP的包管理工具，如果使用宝塔集成环境默认会安装好，如果没有安装请自行安装Composer  
使用阿里云镜像加速Composer(海外VPS无需进行此操作)  
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
保存一下生成的数据库名、用户名、密码等信息(下面会用到)  

进入网站设置(看不清点击图片放大看)
![网站设置](/images/docs/setting_open.png)  
修改网站运行目录  
![运行目录](/images/docs/setting_dir.png)  
配置伪静态  
![伪静态](/images/docs/setting_htaccess.png)  
开启https  
![SSL](/images/docs/setting_ssl.png)  

<a name="section-4"></a>
## 安装酷博
修改完毕后，在浏览器中访问您的域名地址`xxx.com/install`进入安装引导程序。
![安装欢迎页面](/images/docs/install-1.png)  
点击【检查运行环境】按钮进入下一步  
![安装环境检查](/images/docs/install-2.png)  
如果满足要求点击【检查权限】进入下一步，如果部分扩展没有安装请参考上一节安装对应扩展。  
如果函数被禁用了，请修改php.ini解除对该函数禁用。  
![安装权限检查](/images/docs/install-3.png)  
如果满足上述目录对应权限点击【环境设置】进入下一步，不满足请更改上述目录权限。  
![安装环境设置](/images/docs/install-4.png)  
这里有两种方式进行设置，一般点击【通过表单设置】即可，【使用文本编辑】是为开发者或对Laravel熟悉的用户提供的。  
![安装配置表单](/images/docs/install-5.png)  
【博客网址】系统会默认填写您当前访问的域名，一般来说无需改动。  
然后再分别设置好【用户名】和【邮箱】和【密码】即可。   
![安装配置数据库](/images/docs/install-6.png)  
将上面保存的数据库信息填入此处。  
![安装应用配置](/images/docs/install-7.png)  
然后在填写Redis配置信息，填写完毕后点击【安装】稍等片刻后。  
![安装完成](/images/docs/install-8.png)  
至此, 安装已完成 ^_^。

> {info} 安装完毕后请使用管理员账号登录，进入后台配置站点名称、关键词、备案号、邮件服务器等信息。具体请查看[系统管理](/{{route}}/{{version}}/system)文档进行配置。




