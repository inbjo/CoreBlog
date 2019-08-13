# 配置说明

---
- [系统配置](#section-1)
- [站点配置](#section-2)
- [数据库配置](#section-3)
- [驱动配置](#section-4)
- [搜索配置](#section-5)
- [Redis配置](#section-6)
- [邮件配置](#section-7)
- [支付配置](#section-8)
- [人机验证配置](#section-9)

大部分的配置信息都保存在项目根目录的`.env`文件中,您可以修改此文件来更改配置。当然管理员也可以在后台进行修改。

<a name="section-1"></a>
### 系统配置
```text
APP_NAME=Blog #系统名称
APP_ENV=local #系统环境 如果是正式环境请更改为production
APP_KEY=base64:Xkbsl4hHUpM15Cq3ez90gbcbQs/gY8zrQcRH+H7BvE8= #自动生成的key值 
APP_DEBUG=true #调试模式  正式环境请关闭
APP_URL=http://www.blog.test #博客网址 请自行修改
```

<a name="section-2"></a>
### 站点配置
```text
SITE_NAME=CoreBlog #站点名称
SITE_SLOGAN='an elegant blog system' #站点标语
SITE_KEYWORD='CoreBlog,Blog,Laravel' #站点关键词
SITE_DESCRIPTION='CoreBlog an elegant blog system' #站点描述
SITE_ICP='京ICP证030173号' #icp备案号
SITE_POLICE='京公网安备11000002000001号' #公安备案号
AllOW_USER_POST=false #是否允许注册用户发表文章
```

<a name="section-3"></a>
### 数据库配置
```text
DB_CONNECTION=mysql #数据库类型
DB_HOST=127.0.0.1 #数据库服务器地址
DB_PORT=3306 #数据库端口
DB_DATABASE=homestead #数据库名
DB_USERNAME=homestead #数据库用户名
DB_PASSWORD=secret #数据库密码
```

<a name="section-4"></a>
### 驱动配置
```text
LOG_CHANNEL=stack #日志频道
BROADCAST_DRIVER=log #广播驱动
CACHE_DRIVER=redis #缓存驱动
QUEUE_CONNECTION=sync #队列连接方式
SESSION_DRIVER=redis #session驱动
SESSION_LIFETIME=120 #session过期时间
```

<a name="section-5"></a>
### 搜索配置
```text
SCOUT_DRIVER=tntsearch #全文索引驱动
TNTSEARCH_TOKENIZER=jieba #分词器
```
CoreBlog目前使用tntsearch做全文索引，tntsearch是基于sqlite开发的全文索引引擎，十分轻巧非常适合博客类网站。之前版本使用过elasticsearch做全文索引，但elasticsearch比较吃配置，杀鸡没必要用宰牛刀故新版移除了支持。

<a name="section-6"></a>
### Redis配置
```text
REDIS_HOST=127.0.0.1 #redis服务器地址
REDIS_PASSWORD=null #redis密码 没有密码请填写null
REDIS_PORT=6379 #redis端口
```

<a name="section-7"></a>
### 邮件配置
```text
MAIL_DRIVER=smtp #邮件驱动
MAIL_HOST=smtpdm.aliyun.com #邮件服务器地址
MAIL_PORT=465 #服务器端口
MAIL_FROM_ADDRESS=service@inbjo.com #发信地址
MAIL_FROM_NAME=Flex #发信昵称
MAIL_USERNAME=service@inbjo.com #发信用户名
MAIL_PASSWORD=***** #发信密码
MAIL_ENCRYPTION=ssl #邮件加密方式
```
推荐使用阿里云的邮件推送，每天可免费发送300封邮件。支持自定义域名邮箱。

<a name="section-8"></a>
### 支付配置
```text
ALI_APP_ID=  #支付宝APP ID
ALI_PUBLIC_KEY= #支付宝公钥(支付宝生成的公钥)
ALI_PRIVATE_KEY= #支付宝私钥(你自己生成的私钥)
WECHAT_APP_ID= #微信APP ID
WECHAT_MCH_ID= #微信商户号
WECHAT_KEY= #微信秘钥
```

<a name="section-9"></a>
### 人机验证配置
```text
VAPTCHA_VID= #vaptcha vid
VAPTCHA_KEY= #vaptcha key
```
v1.4.0版本评论新增了人机检测功能，他是由VAPTCHA提供的服务，你需要前往[VAPTCHA](https://www.vaptcha.com/)注册一个账号并新增一个验证单元即可获取到VID和KEY。  
> {info} VAPTCHA是“Variation Analysis based Public Turing Test to Tell Computers and Humans Apart”（基于变量分析来区分人类和计算机的图灵测试程序）的缩写，又称为手势验证码，一种基于人工智能和大数据的人机验证解决方案 。用户仅需用鼠标绘制指定轨迹即可完成人机验证。VAPTCHA能有效防止恶意密码破解、论坛灌水、垃圾邮件、撞库等。
