# 安装酷博

---

- [安装酷博](#section-1)

<a name="section-1"></a>
## 安装酷博
1. 克隆 CoreBlog 源代码到本地:  
`git clone https://github.com/inbjo/CoreBlog.git`

2. 生成配置文件  
`cp .env.example .env`  
请将.env改为你自己的配置信息

3. 安装扩展包依赖  
`composer install --optimize-autoloader --no-dev`

4. 执行安装命令  
`php artisan blog:install //请按照提示进行安装`  
至此, 安装完成 ^_^。
