<?php

return [

    /**
     *
     * Shared translations.
     *
     */
    'title' => 'CoreBlog 安装程序',
    'next' => '下一步',
    'back' => '返回',
    'finish' => '安装',
    'forms' => [
        'errorTitle' => '发生以下错误:',
    ],


    /**
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'templateTitle' => '欢迎',
        'title' => 'CoreBlog 安装程序',
        'message' => '快速安装和设置向导',
        'next' => '检查运行环境',
    ],


    /**
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => '第一步 | 环境要求检查',
        'title' => '环境要求',
        'next' => '检查权限',
    ],


    /**
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'templateTitle' => '第二歩 | 权限检查',
        'title' => '权限',
        'next' => '环境设置',
    ],


    /**
     *
     * Environment page translations.
     *
     */
    'environment' => [
        'title' => '环境设置',
        'menu' => [
            'templateTitle' => '第三步 | 环境设置',
            'title' => '环境设置',
            'desc' => '请选择一种您要配置<code>.env</code> 文件的方式',
            'wizard-button' => '通过表单设置',
            'classic-button' => '使用文本编辑器',
        ],
        'wizard' => [
            'templateTitle' => '第三步 | 环境设置 | 表单引导',
            'title' => '<code>.env</code> 配置表单',
            'tabs' => [
                'environment' => '基础配置',
                'database' => '数据库配置',
                'application' => '应用配置'
            ],
            'form' => [
                'name_required' => '此项必填。',
                'name_label' => '用户名',
                'name_placeholder' => '管理员用户名',
                'email_label' => '邮箱地址',
                'email_placeholder' => '管理员电子邮箱地址',
                'password_label' => '密码',
                'password_placeholder' => '管理员密码 长度8位及以上',
                'app_url_label' => '博客网址',
                'app_url_placeholder' => '博客网址',
                'db_connection_failed' => '连接数据库失败',
                'redis_connection_failed' => '连接Redis失败',
                'db_host_label' => '数据库地址',
                'db_host_placeholder' => '数据库地址',
                'db_port_label' => '数据库端口',
                'db_port_placeholder' => '数据库端口',
                'db_name_label' => '数据库名',
                'db_name_placeholder' => '数据库名',
                'db_username_label' => '数据库用户名',
                'db_username_placeholder' => '数据库用户名',
                'db_password_label' => '数据库密码',
                'db_password_placeholder' => '数据库密码',
                'redis_label' => 'Redis驱动',
                'redis_host' => 'Redis地址',
                'redis_password_label' => 'Redis密码',
                'redis_password_placeholder' => '无密码请留空',
                'redis_port' => 'Redis端口',

                'buttons' => [
                    'setup_database' => '配置数据库',
                    'setup_application' => '配置应用',
                    'install' => '安装',
                ],
            ],
        ],
        'classic' => [
            'templateTitle' => '第三步 | 环境设置 | 配置编辑',
            'title' => '环境配置编辑',
            'save' => '保存 .env',
            'back' => '返回使用表单向导',
            'install' => '保存并安装',
        ],
        'success' => '.env 文件保存成功.',
        'errors' => '无法保存 .env 文件, 请手动创建它.',
    ],

    'install' => 'Install',

    /*
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => 'CoreBlog 成功安装于 ',
    ],


    /**
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => '安装完成',
        'templateTitle' => '安装完成',
        'finished' => '应用已成功安装',
        'migration' => '迁移和填充控制台输出:',
        'console' => '应用控制台输出:',
        'log' => '安装日志:',
        'env' => '最终 .env 文件:',
        'exit' => '完成',
    ],

    /*
    *
    * Update specific translations
    *
    */
    'updater' => [
        /*
         *
         * Shared translations.
         *
         */
        'title' => 'CoreBlog 更新',

        /*
         *
         * Welcome page translations for update feature.
         *
         */
        'welcome' => [
            'title'   => '欢迎使用更新程序',
            'message' => '欢迎使用更新表单',
        ],

        /*
         *
         * Welcome page translations for update feature.
         *
         */
        'overview' => [
            'title'   => '概览',
            'message' => '有一个更新.|这里有 :number 更新.',
            'install_updates' => '安装成功',
        ],

        /*
         *
         * Final page translations.
         *
         */
        'final' => [
            'title' => '完成',
            'finished' => 'CoreBlog\'s 的数据库已经成功更新了.',
            'exit' => '点击退出',
        ],

        'log' => [
            'success_message' => 'CoreBlog 成功更新于 ',
        ],
    ],
];
