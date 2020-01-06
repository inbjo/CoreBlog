# 用户管理

---

- [用户注册](#add-post)
- [用户登录](#add-post)
- [忘记密码](#add-post)
- [点赞文章](#edit-post)
- [点赞评论](#delete-post)
- [打赏作者](#manage-post)
- [修改资料](#manage-post)
- [更换头像](#manage-post)
- [修改密码](#manage-post)
- [账号关联](#manage-post)
- [上传收款码](#manage-post)

> {info} 用户注册、忘记密码等需要发送电子邮件，需正确配置好邮件服务器信息。  

<a name="add-post"></a>
## 用户注册
![用户注册](/images/docs/user-reg.png)  
点击右上角【注册】进入注册页面。【用户名】仅支持英文数字和下划线且不可重复，【E-mail】请填写你常用的邮箱地址，【密码】长度需大于等于8位。填写完毕后点击【注册】按钮完成注册。此时系统会发送一份验证邮件到您的收件箱，请根据邮件内容提示点击邮件链接激活账户。未激活账户不可发表评论。

<a name="edit-post"></a>
## 用户登录
![用户登录](/images/docs/user-login.png)  
填写您注册时的邮箱地址和密码登录即可。如果忘记密码请点击【忘记密码】超链接进行重置密码。

<a name="delete-post"></a>
## 忘记密码
![忘记密码](/images/docs/user-reset.png)  
填写您注册时的邮箱地址，然后点击【发送重置密码链接】按钮发送邮件。您的邮箱会收到一封重置密码邮件点击邮件中的链接，然后重新设置密码即可。

<a name="manage-post"></a>
## 点赞文章
![点赞文章](/images/docs/post-action.png)  
在每篇文章文末有一个点赞按钮，点击点赞按钮即可，自己不能给自己点赞。

<a name="manage-post"></a>
## 点赞评论
![点赞评论](/images/docs/comment-like.png)  
每条评论都可以被点赞，自己不能给自己点赞。

<a name="manage-post"></a>
## 打赏作者
![打赏作者](/images/docs/post-action.png)  
在每篇文章文末有一个打赏按钮，如果作者未开启打赏则会提示:  
![未开启收款功能](/images/docs/reward-tips.png)  
如果作者上传了收款码则会显示:  
![打赏作者](/images/docs/reward.png)  
你可以随意挑选一个方式扫码打赏

<a name="manage-post"></a>
## 修改资料
![修改资料](/images/docs/edit_profile.png)  
从顶部下拉菜单点击【编辑资料】进入修改资料页面  
你可以修改【用户名】、【手机号】、【个性签名】。后续版本会支持手机号注册和短信验证。

<a name="manage-post"></a>
## 更换头像
![更换头像](/images/docs/edit_avatar.png)  
从顶部下拉菜单点击【更换头像】进入更换头像页面  
点击【选择文件】按钮选择你要上传的头像图片。拖动图片裁剪然后点击【更换】按钮完成保存即可。

<a name="manage-post"></a>
## 修改密码
![修改密码](/images/docs/edit_password.png)  
从顶部下拉菜单点击【修改密码】进入修改密码页面  
输入两次新密码点击【修改】按钮即可。

<a name="manage-post"></a>
## 账号关联
![账号关联](/images/docs/binding.png)  
从顶部下拉菜单点击【编辑资料】进入修改资料页面，然后再点击左侧【账号关联】。  
这里你可以填写【QQ号】，【微信号】、【微博地址】、【GitHub地址】。后续会优化微信号上传。  
![用户卡片](/images/docs/infocard.png)  
填写对应信息会在作者卡片上展示

<a name="manage-post"></a>
## 上传打赏码
![上传打赏码](/images/docs/paycode.png)  
从顶部下拉菜单点击【编辑资料】进入修改资料页面，然后再点击左侧【打赏收款】。
打赏功能可以开启和关闭，收款码可以从对应的软件上点击我要收款生成二维码，然后在此处上传对应二维码即可。  
> {info} 系统会将上传的二维码识别成文本信息，基于一个第三包包实现的该包依赖GD库或者imagemagick库。但目前已知imagemagick会报内存超标问题，如装了imagemagick扩展请先卸载，后续版本可能会解决。
