/*====================================================
  TABLE OF CONTENT
  1. function declearetion
  2. Initialization
====================================================*/

/*===========================
 1. function declearetion
 ==========================*/
window.app = {
  backToTop: function () {
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
  favorite: function () {
    $(".favorite").click(function () {
      var id = $(this).data('id');
      if (is_login == false) {
        return false;
      }
      axios({
        method: 'post',
        url: '/favorites',
        data:{
          type:'comment',
          id:id
        }
      }).then(function (response) {
        console.log(response.data.msg);
      });
    });
  },
  reply: function () {
    $(".reply").click(function () {
      if (is_login == false) {
        return false;
      }
      var content = $("#reply_content").val() + '@' + $(this).data('name') + ' ';
      $("#reply_content").val(content).focus();
      $('html,body').animate({scrollTop: $("#reply").offset().top}, 500);
    });
  },
  delete_comment: function () {
    $(".delete").click(function () {
      if (is_login == false) {
        return false;
      }
      swal({
        title: "确定要删除吗?",
        text: "一旦删除无法恢复!",
        icon: "warning",
        buttons: ['取消操作', '确定删除'],
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            swal("删除成功!", {
              icon: "success",
            });
          }
        });
    });
  },
  subscribe: function () {
    var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
    if (reg.test($("#subscribe_email").val())) {
      $.ajax({
        url: '/subscribe',
        type: 'post',
        data: {
          email: $("#subscribe_email").val()
        },
        success: function (data) {
          swal({
            title: "操作成功",
            icon: "success",
            text: data.msg,
            button: "好的",
          });
        },
        error: function () {
          swal({
            title: "操作失败",
            icon: "error",
            text: '服务器出了点故障~',
            button: "好的",
          });
        }
      });

    } else {
      swal({
        title: "提示",
        icon: "error",
        text: "请正确填写您的邮箱地址",
        button: "好的"
      });
    }
    //{{ route('subscribe') }}
  },
  init: function () {
    //设置Jq CSRF令牌
    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
      $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': token.content}
      });
    }
    //防止复制
    // document.oncontextmenu = new Function('event.returnValue=false;');
    // document.onselectstart = new Function('event.returnValue=false;');
    app.backToTop();
    app.favorite();
    app.reply();
    app.delete_comment();
  },
  like: function (id) {
    if (is_login == false) {
      return false;
    }
    let user_id = status;
    if (typeof ($("#like-" + id).data('is_like')) == "undefined" || $("#like-" + id).data('is_like') == false) {
      $("#like-" + id).css('color', '#00ada7');
      var like_count = parseInt($("#like-" + id).data('like')) + 1;
      $("#like-" + id).html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> 赞(' + like_count + ')');
      $("#like-" + id).data('is_like', true);
      $("#like-" + id).data('like', like_count);
      $("#comment_tips").html('+1').css('color', 'green').removeClass('animated').removeClass('fadeOutUp');
      var offset = ($("#like-" + id)[0].offsetWidth - $("#comment_tips").width()) / 2;
      $("#comment_tips").css('top', $("#like-" + id)[0].offsetTop - 20).css('left', $("#like-" + id)[0].offsetLeft + offset);
      $("#comment_tips").show().addClass('animated').addClass('fadeOutUp');
    } else {
      $("#like-" + id).css('color', '#959595');
      var like_count = parseInt($("#like-" + id).data('like')) - 1;
      $("#like-" + id).html('<i class="fa fa-thumbs-up" aria-hidden="true"></i> 赞(' + like_count + ')');
      $("#like-" + id).data('is_like', false);
      $("#like-" + id).data('like', like_count);
      $("#comment_tips").html('-1').css('color', 'red').removeClass('animated').removeClass('fadeOutUp');
      var offset = ($("#like-" + id)[0].offsetWidth - $("#comment_tips").width()) / 2;
      $("#comment_tips").css('top', $("#like-" + id)[0].offsetTop - 20).css('left', $("#like-" + id)[0].offsetLeft + offset);
      $("#comment_tips").show().addClass('animated').addClass('fadeOutUp');
    }
  }
};

/*===========================
2. Initialization
==========================*/
$(document).ready(function () {
  app.init();
});
