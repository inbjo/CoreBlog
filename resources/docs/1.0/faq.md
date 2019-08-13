# 常见问题

---

- [加密kEY不存在问题](#section-1)
- [无权限写入问题](#section-2)
- [防跨站攻击问题](#section-3)

<a name="section-1"></a>
## 加密kEY不存在问题
![No application encryption key has been specified](/images/docs/key.png)  
这是`.env`中`APP_KEY`值不存在或者为空，解决办法是在项目根目录下执行:
```bash
php artisan key:generate
```

<a name="section-2"></a>
## 无权限写入问题
这个问题一般来说就是权限配置不得当导致的，比如你是以root用户创建的项目，但是以www用户运行就会导致无权限写入问题。  
第一个办法是更改目录所有者为www用户(推荐)  
```bash
chown -R www.www xxx.com
```
> {info} 第一个www指的是www用户，第二个www指的是www用户组。xxx.com指的是你项目的根目录。  

第二个办法是更改目录写入权限(不推荐)
```bash
chmod -R 777 xxx.com
```
<a name="section-3"></a>
## 防跨站攻击问题
![open_basedir](/images/docs/basedir.png)  
这个问题是根目录配置不正确导致。请参考下图配置：  
![bt_open_basedir](/images/docs/bt_basedir.png)  
