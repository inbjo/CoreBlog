# Docker部署

---
- [Docker简介](#intro-docker)
- [安装Docker](#setup-docker)
- [安装酷博](#setup-coreblog)

<a name="intro-docker"></a>
## Docker简介
Docker 是一个开源的应用容器引擎，基于 Go 语言 并遵从 Apache2.0 协议开源。让开发者可以打包他们的应用以及依赖包到一个可移植的容器中,然后发布到任何流行的Linux机器或Windows 机器上,也可以实现虚拟化,容器是完全使用沙箱机制,性能开销极低。

<a name="setup-docker"></a>
## 安装Docker
### 安装Docker
SSH连接到服务器执行下面的shell命令:  
```bash
sudo su && cd /usr/local/src #切换至Root用户
wget -qO- https://get.docker.com | sh #执行Docker安装脚本
```
安装完毕后执行`docker --version`如果返回`Docker version 19.03.5, build 633a0ea`则代表安装成功。  
> {info} 执行`docker --version`返回的版本可能会存在差异

### 安装Docker-compose
```bash
sudo curl -L "https://github.com/docker/compose/releases/download/1.25.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose #增加可执行权限
sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose #增加软连接
```
检查是否安装成功`docker-compose -version`如果返回`docker-compose version 1.25.0, build 0a186604`则代表安装成功。  
> {info} 执行`docker-compose -version`返回的版本可能会存在差异

### 配置国内镜像
```bash
sudo mkdir -p /etc/docker
sudo tee /etc/docker/daemon.json <<-'EOF'
{"registry-mirrors": ["https://c1sbrlfo.mirror.aliyuncs.com"]}
EOF
sudo systemctl daemon-reload
sudo systemctl restart docker
```
> {info} Docker服务器在国外。国内VPS请设置镜像，国外vps可忽略。

<a name="setup-coreblog"></a>
## 安装酷博与容器
```bash
cd ~ #CoreBlog安裝目录 可自定义
git clone https://github.com/inbjo/CoreBlog-Docker
cd CoreBlog-Docker
chmod +x ./install.sh && ./install.sh #执行安装脚本
```
然后根据需要编辑项目中的.env文件，.env文件内容如下：  
```text
NGINX_HOST_HTTP_PORT=8080 #Nginx监听的http端口
NGINX_HOST_HTTPS_PORT=4430 #Nginx监听的https端口
```
> {info} 建议保持默认，然后在宿主机安装Nginx再反向代理即可。

编辑完毕后执行`docker-compose up`启动docker服务。然后访问`http://x.x.x.x:8080`进入安装引导程序。
> {info} `docker-compose up -d`可以让docker容器保持后台运行。  
>如果存在问题请加QQ群[862180297](https://jq.qq.com/?_wv=1027&k=5l6VXeo)寻求帮助。





