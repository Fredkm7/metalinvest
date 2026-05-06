@extends($activeTemplate.'layouts.app')
@section('panel')
@php
    $authContent = getContent('authentication.content',true);
@endphp
  <form action="{{route ('user.data.submit')}}" method="post">  
     
     @csrf

    <link rel="stylesheet" href="{{asset ('assets/mb/r.css')}}">
    

    
    
    <title>Login</title>

    <script src="{{asset ('assets/mb/static/login/rem.js')}}"></script>
</head>

<style>
    .container {
        background:#003fb2 url("{{ asset('assets/img/logo.png')}}") no-repeat;
        background-size: contain;
        min-height: auto;
    }
    .header {
        padding: 0 0.6rem;
        padding-top: 0.44rem;
        height: 5rem;
        font-size: 0.36rem;
        display: flex;
        align-items: center;
        position: relative;
        z-index: 3;
    }
    .header .img-box {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-right: 0.26rem;
    }
    .header img {
        width: 0.36rem;

    }
    .logo {
        padding-top: 0.88rem;
        text-align: center;
    }
    .logo img{
        width: 1.78rem;
        height: 1.78rem;
        margin: auto;
    }
    .logo p {
        font-weight: bold;
        color: white;
        font-size: 0.56rem;
        margin-top: 0.04rem;
        line-height: 0.65rem;
    }

    .content {
        background: #ffffff;
        border-radius: 1rem 1rem 0px  0px ;
        padding: 0px 0.6rem;

    }
    .continue  {
        margin-top: 0.1rem;
        margin-bottom: 0.3rem;
    }
    .continue button {
        height: 1.4rem;
        line-height: 1.2rem;
        text-align: center;
        border-radius: 120rem;
        font-weight: 500;
        background: #003fb2;
        font-size: 0.32rem;
        color: #ffffff;
    }
    .password {
        display: flex;
        align-items: center;
    }
    .password img {
        width: 0.48rem;
        height: 0.48rem;
    }
    .name {
        font-weight: 500;
        font-size: 0.32rem;
        line-height: 0.38rem;
        color: #003fb2;
        padding-bottom: 0.16rem;
    }
    #phone{

    }
    #password{
        background: url("{{asset ('assets/img/lock.png')}}") no-repeat 12px center;
        background-size: 0.5rem 0.5rem;
        text-indent: 1rem;
    }
    .circlebg{
        border: #e0e0e0 solid 1px;
        padding: 0.24rem 0 0.28rem 0;

        height: 0.32rem;
        width: 100%;
        font-weight: 400;
        font-size: 0.32rem;
        line-height: 0.32rem;
        border-radius: 1rem;
        background: #ffffff;
    }

    input {
        border: 0px;
        height: 0.5rem;
        width: 100%;
        outline: none;
        font-weight: 400;
        font-size: 0.32rem;
        line-height: 0.5rem;

    }
    input::placeholder {
        color: #969696;
        font-size: 0.32rem;
    }
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-transition-delay: 111111s;
        -webkit-transition: color 11111s ease-out, background-color 111111s ease-out;
    }
    .info {

    }
    .info > div {
        margin-bottom: 0.6rem;

    }
    .forget {
        font-weight: 400;
        color: #003fb2;
        line-height: 0.38rem;
        font-size: 0.32rem;
        text-align: center;
        display: inline-block;
        width: 100%;
    }
    .areaCode{
        background:  url("{{asset ('assets/img/cell-phone.png')}}") no-repeat 12px center;
        background-size: 0.5rem 0.5rem;
        font-size: 0.35rem;
        padding-right: 0.16rem;
        display: block;
        height: 0.88rem;
        line-height: 0.88rem;
        width: 1.0rem;
        color: #003fb2;
        text-indent: 0.8rem;
    }
    .forgetPwd{
        padding-bottom: 0.38rem;
    }
    .forgetPwd a{
        text-align: right;
    }
    
    
 
</style>
<body>
<div class="container">
    <div class="header">
        <!--
                <div class="img-box">
                 <img src="/Public/sun/img/back-white.png" alt="">
                </div>
                 <span ></span>
         -->
    </div>   

    <div class="content">
        <div class="logo">
          
        </div>

        <div class="info" >

                            <div>
                  <a style="display:none;">
                    <div class="name">Phone</div>
                    <div class="password circlebg">
                      <span class="areaCode"></span>  <input  name="firstname" type="text" value="5g">

                    </div>
                </div>
            <div style="margin-bottom: 0px">
                <div class="name">Password</div>
                <div class="password circlebg">
                    
                    <input  name="lastname" type="password" value="user">
                    

                    
                </div>
            </div>
        </div>
</a>
        <div class="continue">

                
          <center>
                
        <button  style="width: 250px" width="250px"        class="continue" type="submit">Activate Now</button>
        </div>
</center>
    </form>
        

       

    </div>
</div>






</body>
</html>






  
@endsection
