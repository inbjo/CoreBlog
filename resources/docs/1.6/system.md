# 系统管理
---
- [基本设置](#basic)
- [邮件设置](#mail)
- [支付设置](#pay)
- [其他设置](#other)

> {warning} 如果修改了配置并且提示保存成功但页面并没有更新，请清除缓存再刷新页面即可。

<a name="basic"></a>
## 基本设置
![基本设置](/images/docs/basic.png)  
这些参数都比较简单不详细说了，详细大家看一下都懂。  

<a name="mail"></a>
## 邮件设置
![邮件设置](/images/docs/mail.png)  
推荐使用阿里云的邮件推送服务，每天可免费发送200封邮件，一般来说足够了。  
```bash
MAIL_DRIVER=smtp
MAIL_HOST=smtpdm.aliyun.com
MAIL_PORT=465
MAIL_FROM_ADDRESS=service@inbjo.com
MAIL_FROM_NAME=Flex
MAIL_USERNAME=service@inbjo.com
MAIL_PASSWORD=********
MAIL_ENCRYPTION=ssl
```
上面是一份阿里云邮件的配置  

<a name="pay"></a>
## 支付设置
![支付设置](/images/docs/pay.png)  
目前暂时没用到，为以后增加会员体系打基础。

<a name="other"></a>
## 其他设置
![其他设置](/images/docs/other.png)  
[人机验证配置](/{{route}}/{{version}}/config#vaptcha)请参考之前的章节，redis配置比较简单就不赘述了。
