@extends($activeTemplate.'layouts.master')
@section('content')

<link rel="stylesheet" href="{{asset ('assets/mb/r.css')}}">
    

    


    <script src="{{asset ('assets/mb/static/login/rem.js')}}"></script>


</head>
<style>
   .container{
       min-height: 100vh;
       background-color: #FCFFFD;
   }

   .content {
       padding: 0 0.5rem;
   }
   .types {
       display: flex;
       flex-wrap: wrap;
   }
   .types span {
    font-size: 0.24rem;
    padding: 0.2rem 0.32rem;
    border-radius: 0.4rem;
    margin-bottom: 0.16rem;
    background: #51DA88;
    /* margin-right: 0.16rem; */
   }
   .types span:not(:nth-of-type(3n)) {
    margin-right: 0.16rem;
   }
   .types .active {
    background: #FEDF4C; 
   }
   .no-data {
       display: flex;
       justify-content: center;
       align-items: center;
       margin-top: 3.32rem;
   }
   .no-data img{
       width: 3.34rem;
       height:2.84rem;
   }
   .no-data p {
    font-weight: 500;
    color: rgba(0,0,0,0.4);
    font-size: 0.48rem;
    text-align: center;
   }
   .list {
      margin-top: 0.16rem;
      display: none;
   }
   .list .item {
       background: #FFFFFF;
       border-radius: 0.18rem;
       padding: 0.16rem 0.3rem 0.18rem 0.3rem;
       margin-bottom: 0.24rem;
       font-weight: 400;
       color: rgba(0,0,0,0.3000);
       font-size: 0.2rem;
       display: flex;
       line-height: 0.23rem;
       justify-content: space-between;
       box-shadow: 0 1px 10px #e3e3e3, inset 0 1px 0 #fff;
   }
   .list .item .num {
    font-weight: 500;
    color: #132219;
    font-size: 0.32rem; 
    line-height: 0.38rem;
    margin: 0.12rem 0;
   }
   .list .item .num span {
       font-size: 0.2rem;
       margin-right: 0.1rem;
   }
   .list .item .time{
    text-align: right;
   }
   .list .item .time p:first-child {
    margin-bottom: 0.04rem;
   }
   .list .item .status {
       margin-top: 0.34rem;
       font-weight: 400;
      color: #000000;
   }
   .list .item .status .circle {
       display: inline-block;
       width: 0.14rem;
        height: 0.14rem;
        
        border-radius: 0.15rem;
        margin-right: 0.12rem;
   }
   .list .item .success {
    background: #51DA88;
   }
   .list .item .failure {
    background: #E40E0E;
   }
   .list .item .processing {
    background: #979797;
   }
   .list .item .done {
    background: #FFD600;
   }
   .list .item .active {
    background: #06B3BA;
   }
</style>
<body>
   <div class="container">
    <style>
    .header {
        background: #ffffff;
        height: 1rem;
        line-height: 1rem;
        color: #131A22;
        font-size: 0.32rem;
        z-index: 3;
        margin-bottom: 0.3rem;
        border-bottom: #d5d5d7 1px solid;
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
</style>

<a href="{{route ('user.home')}}">
    <div class="header">
        <div class="img-box">
            <img src="{{asset ('assets/img/back.png')}}" alt=""> &nbsp; <span>My Bill</span>
        </div>
    </div>
</a>
 <div class="content">
        <link rel="stylesheet" href="{{asset ('core/swiper-bundle.css')}}"/>
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide"><a href="{{route ('user.deposit.history')}}">Recharge</a></div>
        <div class="swiper-slide"><a href="{{route ('user.withdraw.history')}}">Withdrawal</a></div>
        <div class="swiper-slide" ><a href="{{ route('user.transactions') }}">Statments</a></div>
        
       
        <div class="swiper-slide"></div>
        <div class="swiper-slide"></div>
        <div class="swiper-slide"></div>
    </div>
</div>


<style>
    .swiper {
        width: 100%;
        border-radius: 0.5rem;
        margin-bottom: 0.3rem;

    }
    .swiper-slide {
        font-size: 0.2rem;
        height: 0.6rem;
        line-height: 0.6rem;
        text-align: center;
        padding: 0px 0.1rem;
    }
    .swiper-slide a{
        color: #132219;
    }

    .swiper-slide-active{
        background: #1e347b;
        border-radius: 0.5rem;

    }
    .swiper-slide-active a{
        color: #ffffff;
    }

</style>
<script src="{{asset ('core/swiper-bundle.min.js')}}"></script>
<!-- Initialize Swiper -->
<script>
    var selectIt = 0
        selectIt = 0                                                        
        var swiper = new Swiper(".mySwiper", {
            watchSlidesProgress: true,
            slidesPerView: 4,
            initialSlide: selectIt,
        });
    swiper.on('slideChange', function (event) {

        switch (event.activeIndex) {
            case 0:
                document.location.href = ""
                break
            case 1:
                document.location.href = ""
                break
            case 2:
                document.location.href = ""
                break
           
            default:
                break
        }

    });

</script>

  
          
      
   @forelse($transactions as $transaction)
        <div class="recharge list">
                    <div class="item">
                <div>
                    <p>{{ __(keyToTitle($transaction->wallet_type)) }}</p>
                    <p class="num"><span>{{ $general->cur_text }}</span> {{ showAmount($transaction->amount ) }} </p>
                    <p>Post Amount: {{ showAmount($transaction->post_balance) }} {{ $general->cur_text }}</p>
                </div>
                <div class="time">
                    <p>{{showDateTime($transaction->created_at,'M d Y @g:i:a')}}</p><br><br>
                    <p>Status: checked</p>
                </div>
               
            </div>
          @empty
               <div class="no-data">
            <div>
            <img src="{{asset ('assets/img/no-data.png')}}" alt="">
            <p>No Data</p>

           </div>
            @endforelse
            
                   </div>
            </div>  


   </div>



</body>
</html>



<script src="{{asset ('core/jquery-3.3.1.min.js')}}"></script>


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

<script>

$('.img-box').click(function(){

})

const types = $('.types span')
// 显示第一个
$('.recharge').show()
types.click(function(){
    var url = $(this).data('url');
    document.location.href=url;

})

</script>

 

  

    
    
     

@endsection
@push('style')
    <style>
        .trx-search{
            position: relative;
        }
        .trx-search .icon-area{
            position: absolute;
            top: 10px;
            right: 8px;
            font-size: 20px;
            background: transparent;
            border: none;
        }
    </style>
@endpush
