@extends($activeTemplate . 'layouts.app')
@section('panel')
    @php
        $authContent = getContent('authentication.content', true);
    @endphp

                    <form action="{{ route('user.register') }}" method="POST" class="verify-gcaptcha account-form">
                        @csrf
                        
                        
                        
                            <link rel="stylesheet" href="{{asset ('assets/mb/r.css')}}">
    

    
    
    <title>register</title>

    <script src="{{asset ('assets/mb/static/login/rem.js')}}"></script>
</head>

                        
             <style>
    body{
        background: #003fb2;
    }
    .container {
        background: url("{{asset ('assets/mb/logo_bg.png')}}") no-repeat;
        background-size: contain;
        min-height: 100vh;
        color: white;
    }
     .header {
       padding: 0 0.6rem;
       padding-top: 0.44rem;
       height: 1rem;
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
        padding-top: 0.68rem;
        text-align: center;
    }
    .logo img{
        width: 1.68rem;
        height: 1.68rem;
        margin: auto;
    }
    .logo p {
    font-weight: bold;
   color: white;
   font-size: 0.48rem;
   margin-top: 0.24rem;
   line-height: 0.55rem;
}
   
   .content {
       padding: 0 0.86rem;
   }
   .continue {
       margin-top: 0.5rem;
       margin-bottom: 0.96rem;
   }
  .continue button {
   height: 1.0rem;
   line-height: 1.0rem;
   text-align: center;
   border-radius: 0.5rem;
   font-weight: 500;
   background: #132219;
   font-size: 0.32rem;
  }

  .circlebg{

      padding: 0.24rem 0 0.28rem 0;
      height: 0.32rem;
      width: 100%;
      font-weight: 400;
      font-size: 0.32rem;
      line-height: 0.32rem;
      border-radius: 1rem;
      background: #ffffff;
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
      padding-bottom: 0.16rem;
  }
    #phone{
        text-indent: 0.6rem;
    }
    .lockcls{
        background:  url("{{asset ('assets/img/lock.png')}}") no-repeat 12px center;
        background-size: 0.5rem 0.5rem;
        text-indent: 1rem;
        height: 0.38rem;
    }
    input {
        border: 0px;
        padding: 0.15rem 0 0.15rem 0;
        height: 0.38rem;
        width: 100%;
        outline: none;
        color: #969696;
        font-weight: 400;
        font-size: 0.32rem;
        line-height: 0.38rem;
        background: none;


    }
    input::placeholder {
        color: #969696;
        font-size: 0.32rem;
    }
  .info {
      margin-top: 3.5rem;
  }
  .info > div {
      margin-bottom: 0.6rem;

  }
 .get {
     background: #003eb2;
     color: #ffffff;
     text-align: center;
     font-size: 0.32rem;
     font-weight: 400;
     width:30%;
     height:32px;
     padding: 0.06rem 0.1rem;
     border: 0px;
     margin-right: 0.2rem;
 }
 .on{
     color: #2b2b2b;
     background: #f7f4f49e;
 }
 .directLogin{
     font-size: 0.32rem;
     text-align: center;
     padding-bottom: 1rem;
 }
.directLogin a{
        color: #ffffff;
    }
  .areaCode{
        background:  url("{{asset ('assets/img/cell-phone.png')}}") no-repeat 6px center;
     
        background-size: 0.5rem 0.5rem;
    font-size: 0.35rem;
    padding-right: 0.16rem;
    display: block;
    height: 0.88rem;
    line-height: 0.88rem;
   
    color: #003fb2;
    text-indent: 0.8rem;
    

       
    }


.otp{
    background:  url("{{asset ('assets/mb/otp.png')}}") no-repeat 12px center;
    background-size: 0.5rem 0.5rem;
    font-size: 0.35rem;
    padding-right: 0.16rem;
    display: block;
    height: 0.88rem;
    line-height: 0.88rem;
    width: 1rem;
    color: #003fb2;
    text-indent: 0.8rem;
}

.invite{
    background:  url("{{asset ('assets/mb/add-user.png')}}") no-repeat 12px center;
    background-size: 0.5rem 0.5rem;
    font-size: 0.35rem;
    padding-right: 0.16rem;
    display: block;
    height: 0.88rem;
    line-height: 0.88rem;
    width: 1rem;
    color: #003fb2;
    text-indent: 0.8rem;
}
.textIndent{
    text-indent: 0.2rem;
}

    .verifyCode-mask .dialog{
        z-index: 100;
    }
    #verifyCodeClose{
        margin-bottom: 0.2rem;
    }
    #showRandCode{
        text-align: center;
        font-size: 0.3rem;
    }
    .verifyCode-mask .dialog-content{
        padding: 0px 0.4rem 0.4rem 0.4rem;
    }
    #confirm_rand_code{
        height: 0.8rem;
        line-height: 0.8rem;
        text-align: center;
        border-radius: 0.6rem;
        font-weight: 500;
        background: #6676F5;
        font-size: 0.32rem;
        color: #ffffff;
        border: 0px;
        width: 100%;
    }
    #input_rand_code{
        border: #eeeeee 1px solid;
        text-indent: 0.2rem;
        margin: 0.2rem 0px;
    }
    #showRandCode{
        background: #003eb2;
        line-height: 0.8rem;
        color: #ffffff;
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
        <div class="info">
        
           			          <div class="tel-phone">
     
                <div class="name">Phone</div>
               
                <div class="password circlebg">
                 
              <input  name="username" class="areaCode"    type="text" placeholder="Please Input Phone">
                </div>
            </div>
			
			
			
            <div>
                <div class="name">Mot de passe de transaction</div>
                <div class="password circlebg">
                    <input type="password" class="lockcls" name="transaction_password" placeholder="Mot de passe de transaction">
                </div>
            </div>
            <div>
                <div class="name">Confirmer le mot de passe de transaction</div>
                <div class="password circlebg">
                    <input type="password" class="lockcls" name="transaction_password_confirmation" placeholder="Confirmer le mot de passe de transaction">
                </div>
            </div>
            <div>
                <div class="name">Password</div>
                <div class="password circlebg">
                    <input  name="password" class="lockcls"   type="password" placeholder="Please Input Password">
                    
                </div>
            </div>
            <div>
                <div class="name">Confirm Password</div>
                <div class="password circlebg">
                    <input  name="password_confirmation" class="lockcls"   type="password" placeholder="Please Input Confirm Password">

                </div>
            </div>

            <div>
                <div class="name">Pays</div>
                <div class="password circlebg" style="padding-left:0.2rem;">
                    <select id="countrySelect" style="border:none;width:100%;outline:none;font-size:0.32rem;color:#969696;background:none;height:0.68rem;padding:0 0.1rem;" onchange="updateCountryCode(this)">
                        <option value="">-- Sélectionnez votre pays --</option>
                        <option value="CM">🇨🇲 Cameroun</option>
                        <option value="CI">🇨🇮 Côte d'Ivoire</option>
                        <option value="BJ">🇧🇯 Bénin</option>
                        <option value="BF">🇧🇫 Burkina Faso</option>
                        <option value="TG">🇹🇬 Togo</option>
                    </select>
                    <input type="hidden" name="country_code" id="countryCode" value="">
                </div>
            </div>

            <div>
                <div class="name">Code d'invitation (optionnel)</div>
                <div class="password circlebg">
                    <span class="invite"></span>
                    @if(session()->get('reference') != null)
                        <input name="referral_code" class="textIndent" type="text"
                               value="{{ session()->get('reference') }}" readonly
                               placeholder="Code d'invitation">
                    @else
                        <input name="referral_code" class="textIndent" type="text"
                               value="{{ old('referral_code') }}"
                               placeholder="Code d'invitation (optionnel)">
                    @endif
                </div>
            </div>
        </div>
    
        
              <div class="continue">   
          <center>
                
        <button  style="width: 250px" width="300px"        class="add-btn" type="submit"><font style="color:white;">Continue</button></font>
        </div>
</center>
        
        
        <div class="directLogin">
            <a href="{{route ('user.login')}}" class="forget">Existing Account , Login?</a>
        </div>

     </div>
   </div>

   

</body>
</html>
           
                        
                  
                       
                           


   
@endsection

@if ($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
        function updateCountryCode(select) {
            document.getElementById('countryCode').value = select.value;
        }
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif
            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
