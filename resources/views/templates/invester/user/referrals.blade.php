@extends($activeTemplate.'layouts.master')
@section('content')


<style>
    .container {
        background: #003fb2 url("{{asset ('assets/img/team_bg.png')}}") repeat-y;
        background-size: contain;
    }
    .content {

        padding: 0 0.6rem;
        background: #ffffff;
        border-radius: 0.6rem 0.6rem 0px 0px;
    }
    .header {
        padding: 0 0.6rem;
        padding-top: 0.44rem;
        height: 1rem;
        color: #131A22;
        font-size: 0.41rem;
        font-weight: bold;
        text-align: center;
        position: relative;
        z-index: 3;
    }
    .title {
        height: 1rem;
        line-height:1rem;
        font-weight: 500;
        color: #131A22;
        font-size: 0.32rem;

    }
    .tasks .item {
        height: 2.48rem;
        background-size: contain;
        padding: 0.34rem 0.46rem 0 0.5rem;
        color: white;
        font-weight: 500;
        font-size: 0.28rem;
    }
    .tasks .invite-benefit {
        height: 2.4rem;
        background: url("{{asset ('assets/img/invite-benefit-bg.png')}}") no-repeat;
        background-size: contain;
        font-weight: 500;
        color: #F9FDFA;
        font-size: 0.4rem;
        line-height: 0.47rem;
    }
    .tasks .benefit {
        margin-top: 0.28rem;
        height: 0.68rem;
        line-height: 0.68rem;
        background: #FFA15E;
        border-radius: 0.96rem;
        font-weight: 500;
        font-size: 0.24rem;
        text-align: center;
        width: 2.04rem;


    }

    .copy {
        margin-top: 0.2rem;
        background: #E8F3ED;
        border-radius: 0.24rem;
        font-weight: 600;
        color: #132219;
        font-size: 0.28rem;
        line-height: 0.4rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.36rem;
    }
    .copy img {
        width: 0.75rem;
    }
    .copy .left {
        flex: 1;
        overflow: hidden;
    }
    .copy .code {
        font-weight: 400;
        color: #99A18F;
    }
    .received {
        height: 2.4rem;
        background: url("{{asset ('assets/img/received-bg.png')}}") no-repeat;
        background-size: contain;
        font-weight: 300;
        color: #FFFFFF;
        font-size: 0.24rem;
        line-height: 0.28rem;
        padding: 0.7rem 0.6rem;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.32rem;
    }
    .received .left {
        text-align: left;
    }
    .received .right {
        padding-right: 0.6rem;
    }
    .received .num {
        font-size: 0.48rem;
        margin-top: 0.14rem;
        line-height: 0.56rem;
        width: 100%;
    }
    .division .team {
        height: 2.68rem;
        margin-bottom: 0.32rem;
        background-size: contain;
        padding: 0.26rem 0.26rem 0 0.26rem;
        font-size: 0.2rem;
        color: white;
        box-sizing: border-box;
        display: inline-block;
        width: 100%;
    }
    .team1 {
        background: url("{{asset ('assets/img/team-bg1.png')}}") no-repeat;
    }
    .team2 {
        background: url("{{asset ('assets/img/team-bg2.png')}}") no-repeat;
        background-size: contain;
    }
    .team3 {
        background: url("{{asset ('assets/img/team-bg3.png')}}") no-repeat;
        background-size: contain;
    }
    .team .top {
        display: flex;
        margin-top: 0.2rem;
    }
    .team .bottom span {
        font-size: 0.38rem;
        color: #034937;
        margin: 0 0.03rem;
    }
    .team .bottom  {
        font-size: 0.28rem;
        color: rgba(255,255,255,0.6000);
    }
    .team .top .left {
        font-size: 0.44rem;
        font-weight: 500;
        line-height: 0.32rem;
        min-width: 1.8rem;
        width: auto;
    }
    .team .top .right {
        font-weight: 400;
        color: rgba(255,255,255,0.6000);
        font-size: 0.29rem;
        padding-left: 0.5rem;
    }

    .team .top .num {
        line-height: 0.39rem;
        margin-top: 0.1rem;
        font-size: 0.23rem;

    }
    .team .top .num span {
        font-size: 0.33rem;
        margin-left: 0.1rem;
    }
    .img-list {
        margin-top: 0.02rem;
        display: flex;
        padding-left: 0.14rem;
        align-items: center;
        position: relative;
    }
    .team .top .left .tag {
        display: inline-block;
        position: absolute;
        background: white;
        font-weight: 500;
        font-size: 0.09rem;
        font-weight: 500;
        border-radius: 100%;
        width: 0.4rem;
        height: 0.4rem;
        color: black;
        top: -0.1rem;
        right: -0.3rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .img-list > div {
        width: 0.57rem;
        height: 0.57rem;
        border-radius: 100%;
        overflow: hidden;
        margin-left: -0.14rem;
        border: 0.02rem solid #279C7E;
    }
    .team_title{
        font-size: 0.44rem;
        font-weight: 500;
        line-height: 0.32rem;
    }
    .team2 .img-list > div {
        border: 0.02rem solid #FFB12A;
    }
    .team3 .img-list > div {
        border: 0.02rem solid #00CC96;
    }
    .img-list img {
        width: 100%;
        height: 100%;
    }
    .team_title span {
        font-size: 0.64rem;
        margin: 0 0.1rem;
    }
    .team .bottom {
        padding-top: 0.1rem;
    }
    .fix_height{
        height: 1.9rem;
    }
</style>


<body>
    
    
    @php
  $authUser = Auth::user();
  $userCount = App\Models\User::where('ref_by', $authUser->id)->count();
@endphp
    
@php
    use App\Models\Transaction;
    $authUserId = Auth::id();
    $referralCommission = Transaction::where('user_id', $authUserId)
                                    ->where('remark', 'referral_commission')
                                    ->sum('amount');
    $formattedReferralCommission = number_format($referralCommission, 0, '.', '');
@endphp

    
<div class="container">
    <div class="fix_height"></div>
    <div class="content">
        <div class="header">
            <span>My Invitation</span>
        </div>
        <div class="received">
            <div class="left">
                <p>Assets</p>
                <span class="num">{{ $general->cur_text }}  {{ $referralCommission }}</span>
            </div>
            <div class="right">
                <p>Team Size</p>
                <span class="num" style=" margin-left: 25px;">      {{ $userCount }}</span>
            </div>
        </div>
        <div class="division">
            <div class="title">Team Division</div>
            <a href="#" class="team team1">
                <p class="team_title">Level <span>1</span>Team</p>
                <div class="top">

                    <div class="left">
                        <div class="img-list">
                            <div>
                                <img src="{{asset ('assets/img/sun_default.png')}}" alt="">
                            </div>
                            <section class="team_num">
                                <p style="font-weight: 400;color: rgba(255,255,255,0.6000);font-size: 0.29rem; width: 50%; margin-left: 4%;">people</p>
                                <p class="num" style="text-align: center"><span>      {{ $userCount }}</span></p>
                            </section>
                        </div>
                    </div>
                    <div class="right">
                        <p>Team Commission</p>
                        <p class="num">{{ $general->cur_text }} <span>  {{ $referralCommission }}</span></p>
                    </div>
                </div>
                <p class="bottom">
                    Get a  reward on team members' equipment

                    <!--
                    Get a  10% reward on team member equipment--> </p>
            </a>
            <a href="#" class="team team2">
                <p  class="team_title">Level <span>2</span>Team</p>
                <div class="top">
                    <div class="left">

                        <div class="img-list">

                            <div>
                                <img src="{{asset ('assets/img/sun_default.png')}}" alt="">

                            </div>

                            <section class="team_num">
                                <p  style="font-weight: 400;color: rgba(255,255,255,0.6000);font-size: 0.29rem; width: 50%; margin-left: 4%;">people</p>
                                <p class="num" style="text-align: center"><span>0</span></p>
                            </section>
                        </div>
                    </div>
                    <div class="right">
                        <p>Team Commission</p>
                        <p class="num">{{ $general->cur_text }}<span> 0</span></p>
                    </div>
                </div>
                <p class="bottom">
                    Get a reward on team members' equipment

                    <!--  Get a  6% reward on team member equipment-->
                </p>
            </a>
            <a href="#" class="team team3">
                <p class="team_title">Level <span>3</span>Team</p>
                <div class="top">
                    <div class="left">
                        <div class="img-list">

                            <div>
                                <img src="{{asset ('assets/img/sun_default.png')}}" alt="">

                            </div>
                            <section class="team_num">
                                <p  style="font-weight: 400;color: rgba(255,255,255,0.6000);font-size: 0.29rem; width: 50%; margin-left: 4%;">people</p>
                                <p class="num" style="text-align: center"><span>0</span></p>
                            </section>


                        </div>
                    </div>
                    <div class="right">
                        <p>Team Commission</p>
                        <p class="num">{{ $general->cur_text }}<span>0</span></p>
                    </div>
                </div>
                <p class="bottom">
                    Get a reward on team members' equipment

                    <!-- Get a  3% reward on team member equipment--></p>
            </a>
        </div>

        <div class="fix_height"></div>
    </div>


@endsection

@push('style')
    <link href="{{ asset('assets/global/css/jquery.treeView.css') }}" rel="stylesheet" type="text/css">
@endpush
@push('script')
<script src="{{ asset('assets/global/js/jquery.treeView.js') }}"></script>
<script>
    (function($){
    "use strict"
        $('.treeview').treeView();
        $('.copyBoard').click(function(){
                var copyText = document.getElementsByClassName("copyURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);

                /*For mobile devices*/
                document.execCommand("copy");
                $('.copyText').text('Copied');
                setTimeout(() => {
                    $('.copyText').text('Copy');
                }, 2000);
        });
    })(jQuery);
</script>
@endpush
