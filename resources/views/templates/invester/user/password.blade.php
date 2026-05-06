@extends($activeTemplate . 'layouts.master')
@section('content')




     <link rel="stylesheet" href="{{asset ('assets/swiper.css')}}">

    <link rel="stylesheet" href="{{asset ('assets/reset.css')}}">
    
 
<link rel="stylesheet" href="{{asset ('assets/dialog.css')}}">
    <title>Home</title>
  <style>
.container {
    background: #f6f7fb;
    min-height: 100vh;
}
.header {
    height: 1.5rem;
    padding: 0.2rem  0.6rem 0.2rem 0.6rem;
}
 .hello {
  padding: 0.16rem 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: 500;
  font-size: 0.48rem;
}

.hello .name {
line-height: 0.33rem;
font-size: 0.28rem; 
margin-top: 0.04rem;
}
.language {
display: flex;
align-items: center;
}
.language-img {
  width: 0.58rem;
  height: 0.58rem;
}
.language-arrow-img {
  width: 0.28rem;
  height: 0.28rem;
  margin: 0 0.18rem;
}
.language-top {
    height: 0.62rem;
}
.select {
  display: flex;
  align-items: center;
  position: relative;
}
.option {
position: absolute;
bottom: -1.38rem;
left: 0;
background: #E8FFF1;
border-radius: 0.20rem;
padding: 0 0.26rem;
font-weight: 600;
color: #131A22;
line-height: 0.28rem;
font-size: 0.24rem;
height: 1.38rem;
z-index: 3;
/* display: flex;
flex-direction: column;
justify-content: space-between; */
display: none;
}
.option img {
 width: 0.36rem;
 height: 0.36rem; 
 margin-right: 0.02rem;
 visibility:hidden;
}
.option .item {
padding: 0 0.04rem;
display: flex;
align-items: center;
height: 50%;
  /* padding: 0.2rem 0 0.1rem 0 */
}
.option .english {
border-bottom: 0.02rem solid rgba(38,193,101,0.3100); 
}
.green {
color: #d49e12;
}
.content {
  padding: 0 0.2rem;
}
.title {
  height: 1rem;
  line-height:1rem;
  font-weight: 500;
  color: #ffffff;
  font-size: 0.32rem;
}
.feature .items {
   display: flex;
   align-items: center;
   justify-content: space-between;
   margin-top: 0.08rem;
  
}
.feature .items img {
   width: 1rem;
   height: 1rem;
   margin-bottom: 0.16rem;
}
.feature .items p {
font-size: 0.26rem;
   color: #131A22;
line-height: 0.33rem;
font-weight: 400;
text-align: center;
}
.sub_title{
    background: url("{{asset ('assets/img/item_list_bg.png')}}") no-repeat left center;
    background-size: 0.5rem 0.5rem;
    text-indent: 0.6rem;
    font-size: 0.3rem;
    height: 0.8rem;
    line-height: 0.8rem;
}
.project {

    padding-bottom: 1.85rem;
    margin: 0.33rem 0.3rem;

    background: #2564d6;
    border-radius: 0.1rem;
}
.project .item {

background: #ffffff;
border-radius: 0.20rem;
padding: 0.24rem 0.3rem;
margin-bottom: 0.20rem;
box-sizing: border-box;
    box-shadow: 0 1px 10px #e3e3e3, inset 0 1px 0 #fff;
}
.project .item .top {
   display: flex;
    justify-content: space-between;
}
.project .item  .right {
font-weight: 500;
color: #9a9a9a;
line-height: 0.42rem;
font-size: 0.26rem;
    padding-right: 0.1rem;

}
.project .item  .right .des {
font-weight: 400;
color: #838383;  
font-size: 0.28rem;
display: -webkit-box;
word-break: break-all;
-webkit-box-orient: vertical;
white-space: normal;
overflow: hidden;
-webkit-line-clamp: 1;
}
.project .item .top .left {
   width: 2rem;
   overflow: hidden;
   border-radius: 0.18rem;
   flex-shrink: 0;
}
.project .item .top .left img {
   width: 100%;

}
.project .item  .bottom {
font-weight: 400;
color: #838383;
line-height: 0.23rem;
font-size: 0.2rem;
margin-top: 0.2rem;
display: flex;
justify-content: space-between;
align-items: center;
}
.project .item  .right .num {
font-weight: 500;
color: #000000;
line-height: 0.38rem;
font-size: 0.36rem;
margin-bottom: 0.18rem;
font-weight: bold;
    display: block;

}
.project .item  .right .usdt_num{
    color: #0a16ff;
}


  .continue button {
        height: 0.7rem;
        line-height: 0.5rem;
        text-align: center;
        border-radius: 150rem;
        font-weight: 500;
        background: #0F1010;
        font-size: 0.32rem;
        color: #ffffff;
    }


.project button .{
font-weight: 500;
color: #F9FDFA;
font-size: 0.28rem;
padding: 0.2rem 0.1rem;
    margin: 0.2rem 0px 0px 0px;
    text-align: center;
    background: url("{{asset ('assets/img/buybuttonbg.png')}}") no-repeat ;
    background-size:contain;

}
.project .item_title{
    color: #303030;
}
.project .subtitle{
    color: #303030;
    font-weight: bold;
    font-size: 0.3rem;
}
.project .item_price{
    margin-top: 0.66rem;
    display: flex;
    justify-content: space-between;
}
.banner {
   margin-bottom: 0.16rem;
}
.swiper-container {
   height: 3rem;
}
.swiper-container img {
   width: 100%;
   height: 100%;
}
.swiper-slide > div {
   padding: 0 0.35rem;
}
.swiper-container-horizontal>.swiper-pagination-bullets {
   bottom: 0
}
.item_check{
    background: #ffffff;
    border-radius: 0.3rem;
    margin: 0px 0.28rem;
}
.check {
  margin: 0.48rem 0px 0px 0px;
  height: 1.44rem;
  box-sizing: border-box;
  
  padding: 0 0.48rem 0 2.08rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.uncheck {
  background: url(home-check11.png.) no-repeat;
  background-size: contain;
}
.uncheck .left {
  color: #FFA32E;
}
.checked {
  background: url(home-check2.png) no-repeat;
  background-size: cover;
}
.checked .left {
  color: #E27F00;
}
.uncheck .right > div{
  background: #C0F0D4;
  color: #d49e12;
}
.checked .right > div{
  background: #d49e12;
  color:white;
}
.check .left {
  font-weight: 500;
 
  font-size: 0.32rem;
  line-height: 0.38rem;
  height: 1.64rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 0.45rem 0 0.33rem 0.1rem;
  box-sizing: border-box;
}
.uncheck .left .tip {
font-weight: 400;
 color: #FF9002;
 font-size: 0.16rem;
}
.uncheck .left .tips{
  display: none;
}
.uncheck .has-check{
  display: none;
}
.checked .not-check{
  display: none;
}
.checked .left .tip{
  display: none;
}
.checked .left .tips {
  font-weight: 400;
 color: #E17E00;
 font-size: 0.16rem;
}
.checked .left .tips .red {
  color: #FF3B30;
  font-size: 0.28rem;
}
.check .right {
  height: 0.92rem;
    background: #F9FDFA;
    box-shadow: 0 0 0.08rem 0 rgb(255 166 59);
    border-radius: 0.46rem;
    padding: 0.1rem;
    box-sizing: border-box;
    display: flex;
    width: 1.6rem;
    align-items: center;
}
.check .right > div {
  width: 1.4rem;
  height: 0.72rem;
 
  border-radius: 0.46rem;
  font-weight: 500;
 
  font-size: 0.2rem;
    padding: 0.1rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    text-align: center;
}
/* Ã¥Â¼Â¹Ã§Âªâ€”Ã¦ Â·Ã¥Â¼Â */
/* product-dialog */
.product-dialog {
 font-size: 0.2rem; 
 font-weight: 400;
color: #838383;
line-height: 0.23rem;
}
.product-dialog  .dialog {
  width: 6.32rem;
}
.product-dialog .dialog-content {
padding: 1px 0.35rem 0.56rem 0.35rem;
}
.product-dialog .top {
  display: flex;
  align-items: center;
}
.product-dialog .top  .price {
height: 2.4rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  font-size: 0.32rem;
  font-weight: 500;
color: #000000;
line-height: 0.38rem;
}
.product-dialog .top  .price .tk {
font-weight: 400;
color: #838383;
font-size: 0.28rem;
}
.product-dialog .top  .tk-price {
font-weight: 500;
color: #d49e12;
line-height: 0.47rem;
}
.product-dialog .top .img-box {
width: 2.4rem;
height: 2.4rem;
overflow: hidden;
border-radius: 0.2rem;
flex-shrink: 0;
margin-right: 0.32rem;
}

.product-dialog .top .dialog_close {
    border-radius: 0.2rem;
    flex-shrink: 0;
}

.product-dialog .top .dialog_close img {
    width: 1.6rem;
}
.product-dialog .total{

    margin: 0.34rem 0;
    font-size: 0.20rem;
}
.product-dialog .total div{
  display: flex;
  justify-content: space-between;
}
.product-dialog .total .num {
font-weight: 500;
color: #e8ac5d;
font-size: 0.32rem;
line-height: 0.5rem;
}

.product-dialog .introduce {
    position: relative;
margin-top: 0.4rem;
margin-bottom: 0.16rem;
color: #696969;
font-size: 0.28rem;
font-weight: bold;
    text-indent: 0.3rem;
}
.product-dialog .introduce::before{
    content: '';
    position: absolute;
    top: -3px;
    left: 0px;
    height: 16px;
    width: 4px;
    background: #d49e12;

}

#item_content{
    margin-top: 0.3rem;
    font-size: 0.28rem;
    line-height: 0.5rem;
}
.product-dialog .button {
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    font-weight: 500;
    color: #FFFFFF;
    font-size: 0.26rem;
    
}
.product-dialog .cancel {
box-sizing: border-box;
background: rgba(76,217,100,0.4700);
border-radius: 0.96rem;
text-align: center;
padding: 0.2rem 0.64rem;
}
.product-dialog .buy-now {
box-sizing: border-box;
border-radius: 0.1rem;
background: #223b68;
text-align: center;
padding: 0.2rem 0.3rem;
}
/* product-dialog end */
/* pay-dialog */
.pay-dialog  .img-box {
padding-right: 0.4rem;
}
.dialog_close {
    padding-right: 0.4rem;
}

.pay-dialog {
  font-weight: 500;
color: #132219;
line-height: 0.42rem;
font-size: 0.36rem;
}
.pay-dialog .dialog-content {
  padding: 0 0.4rem 0.72rem 0.4rem;
  box-sizing: border-box;
  text-align: center;
}
.pay-dialog .code {
  padding: 0.38rem 0;
  box-sizing: border-box;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.pay-dialog .code-select {
  position:relative
}
.pay-dialog .target {
  width: 2.24rem;
  height: 0.52rem;
  border-radius: 0.14rem;
  border: 0.01rem solid #132219;
  display: flex;
  align-items: center;
  position: relative;
  font-size: 0.28rem;
  padding-left: 0.18rem;
  box-sizing: border-box;
}
.pay-dialog .target:after {
  content: '';
  display: inline-block;
  position: absolute;
  right: 0.16rem;
  width: 0;
  height: 0;
  border-top: 0.08rem solid #6D6D6D;
  border-right: 0.08rem solid transparent;
  border-left: 0.08rem solid transparent;

}
.pay-dialog .list {
  box-sizing: border-box;
  position: absolute;
  left: 0;
  box-shadow: 0 0.18rem 0.49rem 0 rgba(0,0,0,0.06);
    border-radius: 0.16rem;
    border: 0.01rem solid rgba(19,34,25,0.2000);
    font-weight: 400;
    color: #CECECE;
    font-size: 0.28rem;
    background: white;
    display: none;
    width: 100%;
}
.pay-dialog .list span.active {
  color:#132219
}
.pay-dialog .list span {
  border-bottom:0.01rem solid rgba(0,0,0,0.0500);
  padding: 0.1rem 0;
  box-sizing: border-box;
  display: inline-block;
}
.pay-dialog .code, .pay-dialog .discount {
  border-bottom: 0.02rem dashed rgba(184,184,184,0.5000);
}
.pay-dialog .discount {
  font-size:0.28rem;
  margin-top: 0.36rem;
}
.pay-dialog .name {
  font-weight: 400;
color: #B8B8B8;
line-height: 0.28rem;
font-size:0.24rem;
}
.pay-dialog .pay {
  padding: 0 0.3rem;
  margin-top: 0.32rem;
}
.pay-dialog .pay div {
  height: 1.0rem;
  line-height: 1.0rem;
  text-align: center;
  background: #1c3a6b;
  border-radius: 0.60rem;
  font-weight: 500;
color: #ffffff;
font-size: 0.32rem;
}
.pay-dialog .discount > div {
  margin-bottom: 0.4rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.pay-dialog .payment {
  margin-top: 0.24rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-weight: 400;
color: #d49e12;
font-size: 0.36rem;
}
/* .pay-dialog .payment .payment-num */
/* pay-dialog end */
/* success-dialog  */
.success-dialog .success {
margin: 0.08rem auto 0.32rem;
}
.success-dialog .img-box {
padding-right: 0.4rem;
}
.success-dialog .green {
color: #06B3BA;
}
.success-dialog .guide {
font-weight: 400;
color: #B8B8B8;
font-size: 0.24rem;
line-height: 0.28rem;
margin-top: 0.16rem;
}
.success-dialog .dialog-content {
padding: 0.08rem 0.84rem 0.52rem 0.84rem;
font-weight: 500;
color: #131A22;
line-height: 0.56rem;
font-size: 0.48rem;
text-align: center;
}
/* success-dialog end */
/* no-amount-dialog  */
.no-amount-dialog .dialog-content {
padding: 0.08rem 0.84rem 0.52rem 0.84rem;
font-weight: 500;
color: #131A22;
line-height: 0.56rem;
font-size: 0.48rem;
text-align: center;
}
.no-amount-dialog .fail {
margin: 0.08rem auto 0.32rem;
width: 1rem;
height: 1rem;
}
.no-amount-dialog .img-box {
padding-right: 0.4rem;
}


.no-amount-dialog .guide {
font-weight: 400;
color: #06B3BA;
font-size: 0.24rem;
line-height: 0.28rem;
margin-top: 0.44rem;
}
/* no-amount-dialog end */
/* voucher-dialog  */
.voucher-dialog .dialog {
    background: none;
    font-weight: 500;
   color: #FFFFFF; 
   font-size: 0.4rem;
   line-height: 0.47rem;
   width: 6.3rem;
}

.center {
    text-align: center;
}
.voucher-dialog .voucher {
    margin-top: 0.4rem;
}
.voucher-dialog .voucher1 {
    background: url(voucher1.png) no-repeat;
    color: #FFFFFF;
}
.voucher-dialog .item {
    height: 3.04rem;
    background-size: cover;
    margin-bottom: 0.32rem;
    padding: 0.22rem 0.68rem 0.22rem 0.6rem;
    box-sizing: border-box;
    font-weight: 500;
    
     line-height: 0.28rem;
     font-size: 0.24rem;
     display: flex;
     flex-direction: column;
     justify-content: space-between;
}

.voucher-dialog .item .bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.28rem;
}
.voucher-dialog .item .bottom .day {
 font-weight: 500;
}
.voucher-dialog .item .top {
    font-size: 0.48rem;
    line-height: 0.56rem;
}
.voucher-dialog .item .top .num {
    font-size: 0.72rem;
}
.voucher-dialog .item .top .line {
 width: 1.28rem;
 height: 0.04rem;
 background: #FFFFFF;
 border-radius: 0.30rem;
 margin: 0.2rem 0;
}
.voucher-dialog .gift {
 font-weight: 500;
 font-size: 0.24rem;
}

.voucher-dialog .pack {
    font-weight: 500;
    font-size: 0.28rem;
    line-height: 0.33rem;
    text-decoration: underline;
    margin-top: 0.42rem;
    color: white;
    display: inline-block;
    text-align: center;
    width: 100%;
}
/* voucher-dialog end */
/* check-dialog  */
.check-dialog .dialog {
    background: none;
    width: 6.06rem;
}
.check-dialog .dialog-content{
    
    width: 6.06rem;
    height: 6.96rem;
    background: url(check-success.png) no-repeat;
    background-size: cover;
    font-weight: 400;
    color: #FFFBF3;
    line-height: 0.28rem;
    font-size:0.24rem;
    text-align: center;
    
}
.check-dialog .award {
  margin-top:1rem;
  font-weight: 500;
color: #FD4D39;
line-height: 0.84rem;
font-size: 0.48rem;

}
.check-dialog .award span{
  font-size: 0.72rem;
}
.check-dialog .check-title {
  font-weight: 600;
  color: #EA8300;
  line-height: 0.56rem;
  font-size:0.48rem;
  padding-top: 2.5rem;
}
/* check-dialog end */

.notice-dialog {
    font-weight: 500;
    color: #132219;
    line-height: 0.42rem;
    font-size: 0.36rem;
}
.notice-dialog .dialog-content {
    padding: 0.33rem;
    word-break: break-all;
    line-height: 0.58rem;
}
.notice-dialog .dialog-header{
    background: #ebf5ea url("{{asset ('assets/img/noticeBg.png')}}") no-repeat;
    border-radius: 0.4rem  0.4rem 0px 0px;
    height: 55px;
}
.notice-dialog .dialog-footer{
    text-align: center;
    padding-bottom: 0.36rem;
}
.notice-dialog .dialog-footer span{
    box-sizing: border-box;
    border-radius: 0.96rem;
    background: #003fb3;
    color: #ffffff;
    text-align: center;
    padding: 0.1rem 0.34rem;
    display: inline-block;
}


</style>
    <script src="{{asset ('assets/mb/static/login/rem.js')}}"></script>
</head>

<style>
    .semi-circle{
        height: 100%;
        width: 100%;
        background: url("{{asset ('assets/img/index_t_bg.png')}}") no-repeat;
        background-size: contain;

    }
    .feature .items a{
        display: inline-block;
        flex: 1;
        text-align: center;
    }
    .feature .items a img{
        display: inline-block;
    }
</style>
<body>
                    <form action="" method="post">
                        @csrf
                        
           
                        


</head>
<style>
    .container {
        background: #ffffff;
        min-height: 100vh;
    }
    .header {
        background: #ffffff;
        height: 1rem;
        line-height: 1rem;
        color: #131A22;
        font-size: 0.32rem;
        z-index: 3;
        margin-bottom: 0.3rem;
        border-bottom: #e2e2e2 0.8px solid;
        padding-left: 0.3rem;
    }
    .header .img-box {
        height: 100%;
        display: flex;
        align-items: center;
        padding-right: 0.26rem;
    }
    .header img {
        width: 0.36rem;

    }
   .header a {
       color: #131A22;
    }
   input {
    border: none;
    padding: 0.3rem 0;
    height: 0.38rem;
    width: 100%;
    outline: none;
    font-weight: 400;
    color: #131A22;
    font-size: 0.32rem;
    line-height: 0.38rem;
  }
  input::placeholder {
    color: #B8B8B8;
    font-size: 0.32rem;
  }
  .info {
      padding: 0.82rem 0.36rem;
  }
  .info input {
      padding: 0.24rem 0 0.28rem 0;
  }
  .info .name {
    font-weight: 500;
    color: #131A22;
    font-size: 0.32rem;
    line-height: 0.38rem;
  }
  .info .tk-withdraw > div, .info .ustd-withdraw > div {
      margin-bottom: 0.6rem;
      border-bottom: 0.02rem solid #E8ECEA;
  }

  .ustd-withdraw {
      display: none;
  }
  /* switch */
  .switch {
    display: flex;
    height: 1.12rem;
    line-height: 1.12rem;
    background: #007eff;
    font-weight: 600;
    font-size: 0.32rem;
    border-radius: 0.6rem;
    margin-top: 0.52rem;
    position: relative;
    color: #353535;
  }
  .inner {
      content: '';
      display: inline-block;
      position: absolute;
      width: 50%;
      left: 0.08rem;
      top: 0.08rem;
      height: 0.96rem;
      border-radius: 0.6rem;
      background-color: #FFFFFF;
      box-shadow: 0 0.2rem 0.4rem 0 rgba(19,34,25,0.1);
      transition: left 0.3s;
  }
  .switch div {
    width: 50%;
    text-align: center;
    position: relative;
    z-index: 2;
  }
  .white {
      color: white;
  }
  /* switch end */

  .continue {
       margin-top: 0.16rem;
       margin-bottom: 0.6rem;
   }
  .continue div {
   height: 1.2rem;
   line-height: 1.2rem;
   text-align: center;
   background: #007eff;
   border-radius: 0.2rem;
   font-weight: 500;
   color: #FFFFFF;
   font-size: 0.32rem;
  }
  .content {
      padding: 0 0.5rem;
  }
  .password {
    display: flex;
    align-items: center;
  }
  .password img {
      width: 0.48rem;
      height: 0.48rem;
  }
  .bank-box {
      display: flex;
      align-items: center;
      justify-content: space-between;
  }
  .bank-box img {
      width: 0.48rem;
      height: 0.48rem;
  }
  .introduce {
        background: #FFFFFF;
        box-shadow: 0 0 0.4rem 0 rgba(0,0,0,0.05);
        border-radius: 0.4rem;
        padding: 0.32rem 0.48rem;
        color: #7A9283;
        font-size: 0.2rem;
        line-height: 0.46rem;
        word-wrap: break-word;
  }
  .introduce .title {
        color: #486252;
        line-height: 0.33rem;
        font-size: 0.28rem;
        margin-bottom: 0.14rem;
    }
    .amount-tk {
        display: flex;
        font-weight: 500;
        color: #007eff;
        font-size: 0.4rem;
        align-items: center;
        justify-content: space-between;
    }
</style>
<body>
   <div class="container">
    <div class="header">
        <a href="{{route ('user.home')}}">
            <div class="img-box">
             <img src="{{asset ('assets/img/back.png')}}" alt=""> &nbsp;<span>Change Password</span>
            </div>

        </a>
     </div>
     <div class="content">
        <div class="switch" style="display: none;">
            <span class="inner"></span>
            <div>₹</div>
            <div class="white">USDT</div>
        </div>
        <div class="info">

          <div class="tk-withdraw">

           <div>
                <div class="name">Old Pass</div>
                  <div class="amount-tk"> 
                      <div class="input-box">
                          <input type="password" placeholder="old Password" name="current_password" required autocomplete="current-password">
                          
                          
                          
                          
                        
                      </div>

                  </div>
           </div>

            <div>
                <div class="name">New Pass</div>
                <div class="bank-box">
                  
                       <input type="password" placeholder="New Password" name="password" required autocomplete="current-password">
                
                             
                   
                  
                </div>
                     
            </div>

                                <div>
                      

                  </div>
                  







     <div class="name">Confirm Pass</div>
                <div class="bank-box">
                  
                       <input type="password" Placeholder="confirm New Password" name="password_confirmation" required autocomplete="current-password">
                
                             
                   
                  
                </div>
                     
            </div>

                                <div>
                      

                  </div>
                  










        
             

              <div class="continue" style="border: 0px">
                  <button class="add-btn" type="submit">Continue</button>
              </div>

             
         </div>




</body>
</html>


<script>
  

 function withdraw(){
        

        if(!$("#money").val()){
  Toast('Please enter the amount');return;
}

if(!$("#pwd").val()){
  Toast('Please enter the payment password');return;
}
    var json='{"type":"withdraw","amo":"'+$("#money").val()+'","password":"'+$("#pwd").val()+'"}';
   

    $.ajax({
        type:"post",
url:"withdraw.php",
data:json,
success:function(op){
   
   var res=JSON.parse(op);
   var rescode=res.code;
   var msg=res.msg
Toast(msg);
if(rescode=='200'){
    setTimeout(() => {
        
    }, 800);
}
}
    })


    }
       
    </script>

<script>


    // switch
$('.switch div').click(function(){
    const current = !$(this).hasClass('white')
    if (current) {
        return
    }
    $(this).removeClass('white')
    const isTK =  $(this).text() === '₹'

    if (isTK) {
        $('.inner').css('left', '0.08rem')
        $(this).next().addClass('white')
        $('.tk-withdraw').show()
        $('.ustd-withdraw').hide()
        withdrawTK = true
    } else {
        $('.tk-withdraw').hide()
        $('.ustd-withdraw').show()
        $(this).prev().addClass('white')
        $('.inner').css('left', 'calc(50% - 0.08rem)')
        withdrawTK = false
    }

})

$(document).on('click','#selectBank',function () {
    let bank = $('#tk-bank').val();
    if(!bank){
        document.location.href = "/user/bank.html"
    }
})

/*select

const bankData = [
    {name: '2 ****2', value: '2'},{name: '8 ****8', value: '8'},{name: 'P ****P', value: 'P'},{name: ' ****', value: ''},{name: '9 ****9', value: '9'},{name: 'B ****B', value: 'B'},{name: ' ****', value: ''},{name: ' ****', value: ''},{name: ' ****', value: ''},{name: ' ****', value: ''},];

const bankInput = $('#selectBank')
if(bankData.length>0){
    $('#selectBank').val(bankData[0].name)
    $("#tk-bank").val(bankData[0].value)
}

bankInput.mPicker({
    level: 1,
    dataJson: bankData,
    Linkage: false,
    idDefault: true,
    footer: `<div class="mPicker-footer mPicker-confirm">Confirm</div>`,
    confirm: function () {
      const value = bankInput.data('value1');
      if(typeof(value) == "undefined"){
          document.location.href = "/user/bank.html"
      }
      $("#tk-bank").val(value)
    }
});
*/

</script>

<style>
    .my_customer_service{
        height: 1rem;
        width: 1rem;
        position: fixed;
        bottom: 3rem;
        right: 0.28rem;
    }
    .my_customer_service img{
        width: 1rem;
    }
</style>
<script>
    /*
    $(function () {
        var url = "/handle/userOwn";
        let params = {};
        $.ajax({
            type: "POST",
            url: url,
            data: params,
            cache: false,
            async: true,
            success: function (result) {
                console.log(result);
            },
            error: function (param) {
                console.log(param);
            }
        });

    })
     */
</script> 
                
                       
                    </form>
                </div>
            </div>
      
        </div>
    </div>
</div>

    
     
    </div>
@endsection

@if ($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
