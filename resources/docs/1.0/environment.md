# 构建环境

---

- [使用宝塔部署环境](#section-1)
- [使用OneInStack部署环境](#section-2)

如果你已经安装了LNMP请跳过本章节。请看下一节。  
安装集成环境需要干净的操作系统，如果你已经安装过了Nginx、Mysql、PHP请重装系统后再安装以免冲突。

<a name="section-1"></a>
## 使用宝塔部署环境(推荐)

### 宝塔简介
宝塔是国内一款开源的服务器面板，一键全能部署及管理。支持一键创建网站、FTP、数据库、SSL；安全管理，计划任务，文件管理，PHP多版本共存及切换；自带LNMP与LAMP。[点击领取宝塔￥3188礼包](https://www.bt.cn/?invite_code=MV9lc2l0eGM=)

### 安装要求：
* 内存：512M以上，推荐768M以上（纯面板约占系统60M内存）
* 硬盘：100M以上可用硬盘空间（纯面板约占20M磁盘空间）
* 系统：CentOS 7.1+ (Ubuntu16.04+.、Debian9.0+)，确保是干净的操作系统，没有安装过其它环境带的Apache/Nginx/php/MySQL(已有环境不可安装)

### 面板特色功能：
* 一键配置服务器环境（LAMP/LNMP）
* 一键安全重启
* 一键创建管理网站、ftp、数据库
* 一键配置（定期备份、数据导入、伪静态、301、SSL、子目录、反向代理、切换PHP版本）
* 一键安装常用PHP扩展(fileinfo、intl、opcache、imap、memcache、apc、redis、ioncube、imagick)
* 数据库一键导入导出
* 系统监控（CPU、内存、磁盘IO、网络IO）
* 防火墙端口放行
* SSH开启与关闭及SSH端口更改
* 禁PING开启或关闭
* 方便高效的文件管理器（上传、下载、压缩、解压、查看、编辑等等）
* 计划任务（定期备份、日志切割、shell脚本）
* 软件管理（一键安装、卸载、版本切换）

### 安装宝塔
推荐使用centos7.1+作为操作系统,使用SSH连接到你的服务器，根据你当前的操作系统执行对应的安装命令，以root用户执行。

#### Centos安装命令
```bash
yum install -y wget && wget -O install.sh http://download.bt.cn/install/install_6.0.sh && sh install.sh
``` 

#### Ubuntu/Deepin安装命令
```bash
wget -O install.sh http://download.bt.cn/install/install-ubuntu_6.0.sh && sudo bash install.sh
``` 

#### Debian安装命令
```bash
wget -O install.sh http://download.bt.cn/install/install-ubuntu_6.0.sh && bash install.sh
``` 
#### Fedora安装命令
```bash
wget -O install.sh http://download.bt.cn/install/install_6.0.sh && bash install.sh
``` 

执行上述命令后宝塔会询问你默认安装路径如图所示:  
![宝塔安装位置询问](/images/docs/bt_ask.png)  
一般来说默认即可，接着脚本会安装宝塔依赖，稍等片刻就会提示安装成功，如下图所示：  
![宝塔安装位置询问](/images/docs/bt_success.png)  
复制上述网址登录面板后台  
如果你无法打开上述地址可能是厂商未开放该端口，请参考下方链接解决    
腾讯云：https://www.bt.cn/bbs/thread-1229-1-1.html  
阿里云：https://www.bt.cn/bbs/thread-2897-1-1.html  
华为云：https://www.bt.cn/bbs/thread-3923-1-1.html

### 安装套件
第一次登录到管理面板面板会提示你安装套件  
![宝塔安装套件](/images/docs/bt_env.png)  
选择好后点击一键安装即可，编译安装大约需要1~2小时(取决于你的机器配置)  
安装完毕之后，请点击左侧菜单【软件商店】找到【Redis5.0.0】再点击安装即可。
> {info} 编译安装比急速安装大约能提升10%的性能，如果你只是想测试一下选择急速安装即可。  
  
<a name="section-2"></a>
## 使用OneInStack部署环境
OneInStack是一键部署脚本，其官网已写明安装流程在此不再赘述。  
请移步[OneInStack](https://oneinstack.com/install/)进行查看。  
OneInStack并未提供图形化的管理面板，所以适合对linux熟悉的人员使用。新手和懒癌推荐使用宝塔面板。

