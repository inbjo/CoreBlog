<?php

return [

    /**
     *
     * Shared translations.
     *
     */
    'title' => 'CoreBlog 安装程序',
    'next' => '下一步',
    'finish' => '安装',


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
                'environment' => '环境配置',
                'database' => '数据库配置',
                'application' => '应用配置'
            ],
            'form' => [
                'name_required' => '此项必填。',
                'app_name_label' => '博客名称',
                'app_name_placeholder' => '酷博',
                'app_environment_label' => '应用模式',
                'app_environment_label_local' => '本地模式',
                'app_environment_label_developement' => '开发模式',
                'app_environment_label_qa' => 'Qa模式',
                'app_environment_label_production' => '生产模式',
                'app_environment_label_other' => '自定义模式',
                'app_environment_placeholder_other' => '请输入你自定义的模式...',
                'app_debug_label' => '应用调试',
                'app_debug_label_true' => '打开',
                'app_debug_label_false' => '关闭',
                'app_log_level_label' => '应用日志记录等级',
                'app_log_level_label_debug' => 'debug',
                'app_log_level_label_info' => 'info',
                'app_log_level_label_notice' => 'notice',
                'app_log_level_label_warning' => 'warning',
                'app_log_level_label_error' => 'error',
                'app_log_level_label_critical' => 'critical',
                'app_log_level_label_alert' => 'alert',
                'app_log_level_label_emergency' => 'emergency',
                'app_url_label' => '博客网址',
                'app_url_placeholder' => '博客网址',
                'db_connection_label' => '数据库',
                'db_connection_label_mysql' => 'mysql',
                'db_connection_label_sqlite' => 'sqlite',
                'db_connection_label_pgsql' => 'pgsql',
                'db_connection_label_sqlsrv' => 'sqlsrv',
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

                'app_tabs' => [
                    'more_info' => 'More Info',
                    'broadcasting_title' => '广播, 缓存, Session, 队列',
                    'broadcasting_label' => '广播驱动',
                    'broadcasting_placeholder' => '广播驱动',
                    'cache_label' => '缓存驱动',
                    'cache_placeholder' => '缓存驱动',
                    'session_label' => 'Session驱动',
                    'session_placeholder' => 'Session驱动',
                    'queue_label' => '队列驱动',
                    'queue_placeholder' => '队列驱动',
                    'redis_label' => 'Redis驱动',
                    'redis_host' => 'Redis主机',
                    'redis_password' => 'Redis密码',
                    'redis_port' => 'Redis端口',

                    'mail_label' => '邮件',
                    'mail_driver_label' => '邮件驱动',
                    'mail_driver_placeholder' => '邮件驱动',
                    'mail_host_label' => '邮件主机',
                    'mail_host_placeholder' => '邮件主机',
                    'mail_port_label' => '邮件端口',
                    'mail_port_placeholder' => '邮件端口',
                    'mail_username_label' => '邮件用户名',
                    'mail_username_placeholder' => '邮件用户名',
                    'mail_password_label' => '邮件密码',
                    'mail_password_placeholder' => '邮件密码',
                    'mail_encryption_label' => '邮件加密',
                    'mail_encryption_placeholder' => '邮件加密',

                    'pusher_label' => '推送',
                    'pusher_app_id_label' => '推送应用ID',
                    'pusher_app_id_palceholder' => '推送应用ID',
                    'pusher_app_key_label' => '推送应用Key',
                    'pusher_app_key_palceholder' => '推送应用Key',
                    'pusher_app_secret_label' => '推送应用Secret',
                    'pusher_app_secret_palceholder' => '推送应用Secret',
                ],
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


    /**
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => '安装完成',
        'templateTitle' => '安装完成',
        'finished' => '应用已成功安装。下一步设置管理员账号',
        'migration' => '迁移和填充控制台输出:',
        'console' => '应用控制台输出:',
        'log' => '安装日志:',
        'env' => '最终 .env 文件:',
        'exit' => '设置管理员账号',
    ],
];
