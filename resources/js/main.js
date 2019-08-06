/*====================================================
  TABLE OF CONTENT
  1. function declearetion
  2. Initialization
====================================================*/

/*===========================
 1. function declearetion
 ==========================*/
window.app = {
    backToTop: () => {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 1000);
            return false;
        });
    },
    favoriteComment: () => {
        $(".favorite").click(function () {
            var that = $(this);
            var id = $(this).data('id');
            if (is_login == false) {
                return app.loginTips();
            }
            if ($(this).hasClass('favorited')) {
                swal("您已经点赞过了哦");
                return false;
            }
            axios({
                method: 'post',
                url: '/favorites/comment/' + id,
            }).then(function (response) {
                if (response.data.code == 0) {
                    $(that).find(".num").html(response.data.count);
                    swal("点赞成功", "", "success");
                } else {
                    swal(response.data.msg);
                }
            });
        });
    },
    reply: () => {
        $(".reply").click(function () {
            if (is_login == false) {
                return app.loginTips();
            }
            var content = $("#reply_content").val() + '@' + $(this).data('name') + ' ';
            $("#reply_content").val(content).focus();
            $('html,body').animate({scrollTop: $("#reply-wrap").offset().top}, 500);
        });
    },
    deleteComment: () => {
        $(".delete").click(function () {
            var id = $(this).data('id');
            if (is_login == false) {
                return app.loginTips();
            }
            swal({
                title: "确定要删除吗?",
                text: "一旦删除无法恢复!",
                icon: "warning",
                buttons: ['取消操作', '确定删除'],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios({
                        method: 'delete',
                        url: '/comment/' + id,
                    }).then(function (response) {
                        if (response.data.code == 0) {
                            swal(response.data.msg, "", "success").then(() => {
                                document.location.reload();
                            });
                        } else {
                            swal(response.data.msg);
                        }
                    });
                }
            });
        });
    },
    deletePost: () => {
        $("#delete").click(function () {
            var id = $(this).data('id');
            swal({
                title: "确定要删除吗?",
                text: "一旦删除，文章无法恢复!",
                icon: "warning",
                buttons: ["取消操作", "确定删除"],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios({
                            method: 'delete',
                            url: '/post/' + id
                        }).then(function (response) {
                            swal(response.data.msg, {
                                icon: "success",
                            }).then(function () {
                                document.location = '/';
                            });
                        });
                    }
                });
        });
    },
    loginTips: () => {
        swal({
            title: "",
            text: "您需要登录以后才能操作！",
            icon: "warning",
            buttons: ["算了", "前往登录"],
            dangerMode: true,
        }).then((choose) => {
            if (choose) {
                location.href = '/login';
            }
        });
        return false;
    },
    subscribe: () => {
        var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
        if (reg.test($("#subscribe_email").val())) {
            axios({
                method: 'post',
                url: '/subscribe',
                data: {
                    'email': $("#subscribe_email").val()
                }
            }).then(function (response) {
                if (response.data.code == 0) {
                    swal({title: "操作成功", icon: "success", text: response.data.msg, button: "好的",});
                } else {
                    swal({title: "操作失败", icon: "error", text: response.data.msg, button: "好的",});
                }
            });
        } else {
            swal({title: "提示", icon: "error", text: "请正确填写您的邮箱地址", button: "好的"});
        }
    },
    at: function () {
        var tribute = new Tribute({
            values: function (text, cb) {
                axios({
                    method: 'post',
                    url: '/at',
                    data: {
                        'id': $("#post-wrap").data('id'),
                        'q': text
                    }
                }).then(function (response) {
                    cb(response.data);
                });
            },
        });
        tribute.attach(document.getElementById('reply_content'));
    },
    rewardAuthor: () => {
        $("#rewardAuthor").click(function () {
            if (localStorage.getItem('total_amount') == null) {
                localStorage.setItem('total_amount', '1');
            }
            if (localStorage.getItem('payment') == null) {
                localStorage.setItem('payment', 'alipay');
            }
            $('#payModal').modal('toggle');
        });

        $("#payModal .col-4 .item").click(function () {
            $("#payModal .col-4 .item").removeClass('active');
            localStorage.setItem('total_amount', $(this).data('money'));
            $(this).addClass('active');
        });

        $("#payModal .col-6 .item").click(function () {
            $("#payModal .col-6 .item").removeClass('active');
            localStorage.setItem('payment', $(this).data('type'));
            $(this).addClass('active');
        });

        $("#payModal #money").focus(function () {
            $("#payModal .col-4 .item").removeClass('active');
        });

        $("#payModal #money").on('change', function () {
            localStorage.setItem('total_amount', $("#money").val());
        });

        $("#btn-reward").click(function () {
            if (is_login == false) {
                return app.loginTips();
            }
            if (localStorage.getItem('payment') == 'alipay') {
                axios({
                    method: 'post',
                    url: '/pay/alipay/create',
                    data: {
                        'total_amount': localStorage.getItem('total_amount'),
                        'post_id': $("#post-wrap").data('id'),
                        'remark': $("#remark").val()
                    }
                }).then(function (response) {
                    if (response.data.code == 0) {
                        window.open(location.protocol + '//' + location.host + '/pay/alipay/' + response.data.order_id);
                        $('#payModal').modal('toggle');
                        swal({
                            title: "您完成付款了吗?",
                            buttons: ["我已付款", "重新支付"],
                            dangerMode: true,
                        }).then((choose) => {
                            if (choose) {
                                window.open(location.protocol + '//' + location.host + '/pay/alipay/' + response.data.order_id);
                            }
                        });
                    } else {
                        swal(response.data.msg);
                    }
                });
            }
            if (localStorage.getItem('payment') == 'wechat') {
                axios({
                    method: 'post',
                    url: '/pay/wechat/pay',
                    data: {
                        'total_amount': localStorage.getItem('total_amount'),
                        'post_id': $("#post-wrap").data('id'),
                        'remark': $("#remark").val()
                    }
                }).then(function (response) {
                    if (response.data.code == 0) {
                        $('#payModal').modal('toggle');
                        $("#qrcode").empty();
                        $('#qrcode').qrcode(response.data.qrcode);
                        $('#wechatPayModal').modal('toggle');
                    } else {
                        swal(response.data.msg);
                    }
                });
            }

        });

    },
    likePost: () => {
        $("#likePost").click(function () {
            var that = $(this);
            var id = $(this).data('id');
            if (is_login == false) {
                return app.loginTips();
            }
            if ($(this).hasClass('active')) {
                swal("您已经点赞过了哦");
                return false;
            }
            axios({
                method: 'post',
                url: '/favorites/post/' + id,
            }).then(function (response) {
                if (response.data.code == 0) {
                    $(that).addClass('active');
                    $("#post-favorite-count").html(response.data.count);
                    $("#post-favorite-count").parent()[0].dataset.originalTitle = response.data.count + '人赞了这篇文章';
                    swal("点赞成功", "", "success");
                } else {
                    swal(response.data.msg);
                }
            });
        });
    },
    forbidCopy: () => {
        if (!is_login) {
            document.oncontextmenu = new Function('event.returnValue=false;');
            document.onselectstart = new Function('event.returnValue=false;');
        }
    },
    search: () => {
        $("#search").click(function () {
            if ($("#keyword").val() != '') {
                location.href = location.protocol + '//' + location.host + '/search/' + $("#keyword").val();
            } else {
                swal({title: "提示", icon: "error", text: "请填写您要搜索的关键词", button: "好的"});
            }
        });
    },
    regServiceWork: () => {
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js', {scope: '/'})
                .then(function (registration) {
                    // 注册成功
                    console.log('ServiceWorker registration successful with scope: ', registration.scope)
                }).catch(function (err) {
                // 注册失败:(
                console.log('ServiceWorker registration failed: ', err)
            });

            var dfdPrompt = null;
            var clickTips = false;
            var pwaTips = document.getElementById('pwaTip');

            window.addEventListener('beforeinstallprompt', function (e) {
                if (clickTips) return;
                // 存储事件
                dfdPrompt = e;
                // 显示按钮
                pwaTips.classList.remove("d-none");
                pwaTips.style.cursor = 'pointer';
                // 阻止默认事件
                e.preventDefault();
                return false;
            });
            pwaTips.addEventListener('click', function (e) {
                console.log(e);
                if (dfdPrompt == null || e.srcElement.classList.outerText == '×') {
                    return;
                }
                // 通过按钮点击事件触发横幅显示
                dfdPrompt.prompt();
                // 监控用户的安装行为
                dfdPrompt.userChoice.then(function (choiceResult) {
                    // alert(choiceResult.outcome);
                });
                // 隐藏按钮
                pwaTips.style.display = 'none';
                dfdPrompt = null;
                clickTips = true;
            });
        }
    },
    submitComment: () => {
        if ((/^\/post\/.*/.test(document.location.pathname)) && is_login) {
            $.getScript('https://cdn.vaptcha.com/v2.js', function () {
                let vid = $("#vaptchaContainer").data('id');
                window.vaptcha({
                    vid: vid,
                    type: 'click',
                    container: '#vaptchaContainer',
                }).then(function (vaptchaObj) {
                    vaptchaObj.listen('pass', function () {
                        var token = vaptchaObj.getToken();
                        $("#verify_token").val(token);
                    });
                    vaptchaObj.render();
                });
            });
        }

        $("#submit-comment").click(function () {
            if ($("#verify_token").val() == '') {
                swal({title: "提示", icon: "error", text: "请先完成人机验证！", button: "好的"});
                return;
            }
            if ($("#reply_content").val() == '') {
                swal({title: "提示", icon: "error", text: "评论内容不能为空！", button: "好的"});
                return;
            }
            $("#comment-form").submit();
        });
    },
    init: function () {
        //设置Jq CSRF令牌
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': token.content}
            });
        }

        //修复底部高度
        // if (document.body.clientWidth > 992 && $(".content-wrap").height() < 292) {
        //   $("#footer-warp").css("position", "absolute").css("bottom", "0");
        // }

        //启用bootstarp冒泡插件
        $('[data-toggle="tooltip"]').tooltip();

        hljs.initHighlightingOnLoad();
        app.regServiceWork();
        app.backToTop();
        app.search();
        app.likePost();
        app.rewardAuthor();
        app.favoriteComment();
        app.reply();
        app.forbidCopy();
        app.submitComment();
        if (is_login && document.getElementsByTagName("body")[0].className == 'post-show-page') {
            app.at();
            app.deleteComment();
            app.deletePost();
        }
    },
};

/*===========================
2. Initialization
==========================*/
$(document).ready(function () {
    app.init();
});
