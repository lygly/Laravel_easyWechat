<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Login Page 2 | Creative - Bootstrap 3 Responsive Admin Template</title>

    <!-- Bootstrap CSS -->    
    {{--<link href="{{asset('style/admin/css/bootstrap.min.css')}}" rel="stylesheet">--}}
    <!-- bootstrap theme -->
    <link href="{{asset('style/admin/css/bootstrap-theme.css')}}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{asset("style/admin/css/elegant-icons-style.css")}}" rel="stylesheet" />
    {{--<link href="css/font-awesome.css" rel="stylesheet" />--}}
    <!-- Custom styles -->
    <link href="{{asset("style/admin/css/style.css")}}" rel="stylesheet">
    {{--<link href="{{asset('style/admin/css/style-responsive.css')}}" rel="stylesheet" />--}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-img3-body">

    <div class="container">

      <form class="login-form"  method="post">
        {{--  {{csrf_field()}}--}}
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" name="userName" placeholder="Username" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" name="userPass" placeholder="Password">
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="icon_genius"></i>
                </span>
                <input type="text" class="form-control" placeholder="Code" name="userCode" autofocus>
                <span class="input-group-addon">
                    <img src="{{url('admin/code')}}" alt="" onclick="this.src ='{{url('admin/code')}}?'+Math.random() ">  {{--显示验证码--}}
                </span>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="button" id="login">Login</button>
            <button class="btn btn-info btn-lg btn-block" type="button">Signup</button>
        </div>
      </form>

    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/layer/layer.js')}}"></script>
    <script src="{{asset('http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            //$('form').submit(function () {
            $("#login").click(function () {
               // loginCheck();
                 login();


            });
        });
        function loginCheck() {
            //验证规则
            var event = event || window.event;


                var userName = $("input[name=userName]").val();
                var userPass = $("input[name=userPass]").val();
                var userCode = $("input[name=userCode]").val();
                if(!userName){
                    layer.alert('用户名不能为空！');
                    event.preventDefault(); // 兼容标准浏览器
                   return window.event.returnValue = false; // 兼容IE6~8
                    /* return false;*/
                  }
                  if(!userPass){
                      layer.alert('密码不能为空!');
                      event.preventDefault(); // 兼容标准浏览器
                     return window.event.returnValue = false; // 兼容IE6~8
                      /* return false;*/
                     }
                     if(!userCode){
                         layer.alert('验证码不能为空!');
                         event.preventDefault(); // 兼容标准浏览器
                        return window.event.returnValue = false; // 兼容IE6~8
                         /* return false;*/
                       }


               }
               function login() {
                   var event = event || window.event;


                   var userName = $("input[name=userName]").val();
                   var userPass = $("input[name=userPass]").val();
                   var userCode = $("input[name=userCode]").val();
                   if(!userName){
                       layer.alert('用户名不能为空！');
                       event.preventDefault(); // 兼容标准浏览器
                      return window.event.returnValue = false; // 兼容IE6~8
                   }
                   if(!userPass){
                       layer.alert('密码不能为空!');
                       event.preventDefault(); // 兼容标准浏览器
                      return window.event.returnValue = false; // 兼容IE6~8
                   }
                   if(!userCode){
                       layer.alert('验证码不能为空!');
                       event.preventDefault(); // 兼容标准浏览器
                      return window.event.returnValue = false; // 兼容IE6~8
                   }
            var loadIndex = layer.load();
            $.ajax({
                type:'post',
                url:'{{action('Admin\LoginController@login')}}',
                data:$("form").serialize(),
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                },
                success:function (data) {
                    layer.close(loadIndex);
                    if(data.status){
                     location.href = "{{Url('admin')}}";
                    }else{
                        layer.msg(data.msg,{icon:5})
                    }
                }
            })
        }
 function initFormCheck() {
     $(".login-form").validate({
         rules: {
             userName: {
                 required: true,//必填
                 maxlength: 64
             },
             userPass: {
                 required: true,//必填
                 maxlength: 64
             },
             userCode: {
                 required: true,//必填
                 maxlength: 64
             }
         },
         messages: {
             userName: {
                 required: "用户名不能为空",
                 maxlength: "长度不能超过64个字"
             },
             userPass: {
                 required: "用户名不能为空"
             },
             userCode: {
                 required: "用户名不能为空"
             }
         },
         errorElement: "em",
         errorPlacement: function (error, element) {
             // Add the `help-block` class to the error element
             error.addClass("help-block");

             if (element.prop("type") === "checkbox") {
                 error.insertAfter(element.parent("label"));
             } else {
                 error.insertAfter(element);
             }
         },
         highlight: function (element, errorClass, validClass) {
             $(element).parents(".col-sm-10").addClass("has-error").removeClass("has-success");
         },
         unhighlight: function (element, errorClass, validClass) {
             $(element).parents(".col-sm-10").addClass("has-success").removeClass("has-error");
         }
     });
 }
    </script>
  </body>
</html>
