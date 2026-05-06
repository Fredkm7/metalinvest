@extends($activeTemplate.'layouts.master')
@section('content')



<style>


.dialog {
    position: absolute;
    z-index: 100;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #FFFFFF;
    border-radius: 0.2rem;
    width: 5.8rem;
  }
  .dialog-header {
    padding-top: 0.32rem;
    box-sizing: border-box;
    display: flex;
    justify-content: flex-end;
  }
  .dialog-header img {
    width: 0.48rem;
    height: 0.48rem;
  }
  .dialog-content .success {
    width: 1rem;
    height: 1rem;
  }
  .dialog .close {
    position: absolute;
    top: 0px;
    right: 0px;
    font-size: 25px;
    line-height: 1em;
    width: 50px;
    padding-right: 9px;
    padding-top: 2px;
    text-align: right;
    color: white;
  }

  .dialog-mask {
    background: rgba(63,89,74,0.7000);
    z-index: 99;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: none;
  }

</style>
 <style>
 html, body, div, span, applet, object, iframe,
 h1, h2, h3, h4, h5, h6, p, blockquote, pre,
 a, abbr, acronym, address, big, cite, code,
 del, dfn, em, img, ins, kbd, q, s, samp,
 small, strike, strong, sub, sup, tt, var,
 b, u, i, center,
 dl, dt, dd, ol, ul, li,
 fieldset, form, label, legend,
 table, caption, tbody, tfoot, thead, tr, th, td,
 article, aside, canvas, details, embed, 
 figure, figcaption, footer, header, hgroup, 
 menu, nav, output, ruby, section, summary,
 time, mark, audio, video{
   margin: 0;
   padding: 0;
   border: 0;
   font-size: 100%;
   font: inherit;
   font-weight: normal;
   vertical-align: baseline;
 }
 /* HTML5 display-role reset for older browsers */
 article, aside, details, figcaption, figure, 
 footer, header, hgroup, menu, nav, section,input,img{
   display: block;
 }
 ol, ul, li{
   list-style: none;
 }
 blockquote, q{
   quotes: none;
 }
 blockquote:before, blockquote:after,
 q:before, q:after{
   content: '';
   content: none;
 }
 table{
   border-collapse: collapse;
   border-spacing: 0;
 }
  
 /* custom */
 a{
   color: #7e8c8d;
   text-decoration: none;
   -webkit-backface-visibility: hidden;
 }
 ::-webkit-scrollbar{
   width: 5px;
   height: 5px;
 }
 ::-webkit-scrollbar-track-piece{
   background-color: rgba(0, 0, 0, 0.2);
   -webkit-border-radius: 6px;
 }
 ::-webkit-scrollbar-thumb:vertical{
   height: 5px;
   background-color: rgba(125, 125, 125, 0.7);
   -webkit-border-radius: 6px;
 }
 ::-webkit-scrollbar-thumb:horizontal{
   width: 5px;
   background-color: rgba(125, 125, 125, 0.7);
   -webkit-border-radius: 6px;
 }
 html, body{
   width: 100%;
   font-family: "Arial", "Microsoft YaHei", sans-serif;
 }
 body{
   line-height: 1;
   -webkit-text-size-adjust: none;
   -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
 }
 html{
   overflow-y: scroll;
 }
  
 /*Ã¦Â¸â€¦Ã©â„¢Â¤Ã¦ÂµÂ®Ã¥Å Â¨*/
 .clearfix:before,
 .clearfix:after{
   content: " ";
   display: inline-block;
   height: 0;
   clear: both;
   visibility: hidden;
 }
 .clearfix{
   *zoom: 1;
 }
  
 /*Ã©Å¡ÂÃ¨â€”Â*/
 .dn{
   display: none;
 }


      /* footer */
      .footer {
        background: #FFFFFF;
        position: fixed;
        bottom: 0;
        z-index: 2;
        width: 100%;
        font-weight: 500;
       }
       .footer .icons {
           display: flex;
           align-items: center;
           padding: 0rem 0.3rem 0rem 0.3rem;
           justify-content: space-between;
       }
       .footer .icon {
           padding: 0.35rem 0;
           color: #979797;
           font-size: 0.2rem;
           width: 25%;
           text-align: center;
       }
       .footer .icon img {
           width: 0.48rem;
           height: 0.48rem;
           margin: auto;
           margin-bottom: 0.02rem;
       }
       .footer-active {
        color: #3e84ed;
       }
       /* footer end */

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    -webkit-transition-delay: 111111s;
    -webkit-transition: color 11111s ease-out, background-color 111111s ease-out;
}
 </style>
    <title>User Info</title>
    
    <title>User Info</title>
    <script src="{{asset ('core/rem.js')}}"></script>
</head>
<style>
    body{
      background: #ffffff;
    }
    .container {
        min-height: 100vh;
    }
    .content {
        padding: 0.2rem 0.2rem 2.0rem 0.2rem;
    border-radius: 0.2rem 0.2rem 0 0;
    background-color: white;
    margin: 0px 0.3rem 0px 0.3rem;
    box-shadow: 0 1px 6px #a7a7a7, inset 0 1px 0 #fff;

  }
  .content .item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: inset 0 -0.02rem 0 0 rgba(0,0,0,0.1);
    padding: 0.36rem 0;
    box-sizing: border-box;
    font-weight: 500;
color: #132219;
font-size: 0.32rem;

  }
  .content .item img {
      width: 0.48rem;
      height: 0.48rem;
  }
  .content .item span {
      flex: 1;
      padding-left: 0.16rem;
  }
  .headbgPic {
      background: linear-gradient(160deg, #0a2463 0%, #1a56db 100%);
      padding: 0.5rem 0.4rem 0.8rem;
  }
  .hello {
      display: flex;
      align-items: center;
      gap: 0.25rem;
      margin-bottom: 0.4rem;
  }
  .hello-avatar {
      width: 1rem; height: 1rem;
      border-radius: 50%;
      background: rgba(255,255,255,0.15);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
      border: 2px solid rgba(255,255,255,0.3);
  }
  .hello-avatar svg { width: 0.55rem; height: 0.55rem; }
  .hello-name {
      font-size: 0.36rem;
      font-weight: 700;
      color: #fff;
  }
  .hello-sub {
      font-size: 0.22rem;
      color: rgba(255,255,255,0.6);
      margin-top: 0.04rem;
  }
  .balance {
      display: flex;
      gap: 0;
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.15);
      border-radius: 0.2rem;
      overflow: hidden;
  }
  .balance > div {
      flex: 1;
      padding: 0.28rem 0.25rem;
      text-align: center;
  }
  .balance > div:first-child {
      border-right: 1px solid rgba(255,255,255,0.15);
  }
  .balance .title {
      font-size: 0.22rem;
      color: rgba(255,255,255,0.6);
      margin-bottom: 0.08rem;
  }
  .balance .amount {
      font-size: 0.42rem;
      font-weight: 700;
      color: #fff;
      line-height: 1.1;
  }

  /* bank start */
  .bank-mask {
      font-weight: 500;
      color: #131A22;
      line-height: 0.56rem;
      font-size: 0.48rem;
      text-align: center;
  }
  .bank-mask .dialog-content {
      padding: 0 0.4rem 0.72rem 0.4rem;
      box-sizing: border-box;
      text-align: center;

  }
  .bank-box input {
      pointer-events: none;
  }
  .bank-mask .dialog {
      width: 4.5rem;
      background: #003eb2;
  }
  .bank-mask .img-box {
      padding-right: 0.4rem;
  }
  .bank-mask ul {
      margin: 0.5rem 0;
      color: #9DA1AE;
      font-size: 0.37rem;
      line-height: 0.7rem;
  }
  .bank-mask ul li {
      margin: 0.1rem 0;
  }
  .bank-mask ul li a {
      color: #ffffff;
  }
  .bank-mask ul .active {
      color: #000;
      border-top: 1px solid #E9E9EE;
      border-bottom: 1px solid #E9E9EE;
  }
  .rechargeAndWithdraw{
      background: #ffffff;
      border-radius: 0.6rem 0.6rem 0px 0px;
      font-size: 0.32rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.5rem 0.5rem;
      text-align: center;

  }
  .rechargeAndWithdraw a{

      display: block;
  }
      .rechargeAndWithdraw p{
          padding-top: 0.2rem;
      }
  /* bank end*/

  .full_content{
      background: #ffffff;
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
   .rechargeAndWithdraw img{
               width: 50px;
           }
    .rechargeAndWithdraw a p{
        font-size: 0.25rem;
    }
</style>
<body>
   <div class="container">
       <section class="headbgPic">
           <div class="hello">
               <div class="hello-avatar">
                   <svg viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
               </div>
               <div>
                   <div class="hello-name">{{ auth()->user()->username }}</div>
                   <div class="hello-sub">Membre METAL INVEST</div>
               </div>
           </div>
           @php $totalBalance = auth()->user()->deposit_wallet + auth()->user()->interest_wallet; @endphp
           <div class="balance">
               <div>
                   <p class="title">Solde disponible</p>
                   <p class="amount">{{ showAmount($totalBalance, 0) }}</p>
               </div>
               <div>
                   <p class="title">Total retiré</p>
                   <p class="amount">{{ showAmount($successfulWithdrawals ?? 0, 0) }}</p>
               </div>
           </div>
           <ul class="rechargeAndWithdraw">
               <li>
                   <a href="{{ route('user.deposit.index') }}">
                       <img  src="{{asset ('assets/img/widraw_1.png')}}" alt="">
                       <p>Recharge</p>
                   </a>
               </li>
               <li>
                   <a  href="{{route ('user.withdraw')}}">
                       <img src="{{asset ('assets/img/recharge_1.png')}}" alt="">
                       <p>Retrait</p></a>
               </li>
               <li>
                   <a href="javascript:void(0)" id="inviteFriends" style="cursor:pointer;">
                       <img src="{{asset ('assets/img/share_1.png')}}" alt="">
                       <p>Parrainer</p></a>
               </li>
           </ul>
       </section>

       <section class="full_content">


           <div class="content">
             <a class="item" href="{{route ('user.deposit.history')}}">
                 <img src="{{asset ('assets/img/home3.png')}}" alt="">
                 <span>Historique des dépôts</span>
                 <img src="{{asset ('assets/img/my-right.png')}}" alt="">
             </a>
             <a class="item" href="{{ route('user.withdraw.history') }}">
                 <img src="{{asset ('assets/img/recharge_1.png')}}" alt="">
                 <span>Historique des retraits</span>
                 <img src="{{asset ('assets/img/my-right.png')}}" alt="">
             </a>
             <a class="item" href="{{ route('user.transaction.password') }}">
                 <img src="{{asset ('assets/img/my-essential.png')}}" alt="">
                 <span>Mot de passe de transaction</span>
                 @if(!auth()->user()->transaction_password_set)
                     <span style="background:#dc2626;color:#fff;font-size:0.2rem;padding:0.05rem 0.15rem;border-radius:0.3rem;margin-right:0.1rem;white-space:nowrap;">Non défini</span>
                 @endif
                 <img src="{{asset ('assets/img/my-right.png')}}" alt="">
             </a>
             <a class="item" href="{{ route('user.change.password') }}">
                 <img src="{{asset ('assets/img/my-essential.png')}}" alt="">
                 <span>Changer le mot de passe</span>
                 <img src="{{asset ('assets/img/my-right.png')}}" alt="">
             </a>
             <a class="item" href="{{ route('ticket.index') }}">
                 <img src="{{asset ('assets/img/my-service.png')}}" alt="">
                 <span>Service Client</span>
                 <img src="{{asset ('assets/img/my-right.png')}}" alt="">
             </a>
             <a class="item" href="https://t.me/METALINVEST01" target="_blank">
                 <img src="{{asset ('assets/img/home5.png')}}" alt="">
                 <span>Canal Telegram officiel</span>
                 <img src="{{asset ('assets/img/my-right.png')}}" alt="">
             </a>
             <a class="item" href="{{route ('user.logout')}}">
                 <img src="{{asset ('assets/img/my-logoout.png')}}" alt="">
                 <span>Déconnexion</span>
                 <img src="{{asset ('assets/img/my-right.png')}}" alt="">
             </a>
           </div>
       </section>




   </div>

   

   <div class="dialog-mask invite-dialog">
       <div class="dialog">
           <div class="dialog-header" style="background:linear-gradient(135deg,#0e3a8c,#1a56db);border-radius:0.4rem 0.4rem 0 0;height:60px;display:flex;align-items:center;justify-content:space-between;padding:0 0.3rem;">
               <span style="color:#fff;font-size:0.32rem;font-weight:700;">Parrainer un ami</span>
               <div class="dialog_close"><img src="{{asset ('assets/img/close.png')}}" alt=""></div>
           </div>
           <div class="dialog-content" style="padding: 0.3rem 0.3rem 0.5rem">

               <p style="font-size:0.24rem;color:#64748b;margin-bottom:0.3rem;">Partagez votre lien et gagnez <strong style="color:#1a56db;">20%</strong> sur chaque investissement de vos filleuls.</p>

               <div class="copy">
                   <div class="left">
                       <div>Lien d'invitation</div>
                       <span class="code" id="link">{{ route('home') }}?reference={{ auth()->user()->username }}</span>
                   </div>
                   <img id="copy-link" src="{{asset ('assets/img/copy.png')}}" alt="" style="cursor:pointer;">
               </div>

               <div class="copy">
                   <div class="left">
                       <div>Code de parrainage</div>
                       <span class="code" id="code">{{ auth()->user()->username }}</span>
                   </div>
                   <img id="copyCode" src="{{asset ('assets/img/copy.png')}}" alt="" style="cursor:pointer;">
               </div>

               <button onclick="shareInvite()" style="width:100%;margin-top:0.3rem;padding:0.3rem;background:linear-gradient(135deg,#0e3a8c,#1a56db);color:#fff;border:none;border-radius:0.2rem;font-size:0.3rem;font-weight:700;cursor:pointer;">
                   Partager le lien
               </button>

           </div>
       </div>
   </div>



<style>
    .notice-dialog .dialog-content{
        overflow-y: scroll;
        max-height: 6rem;
        height: auto;
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
</style>





<script src="{{asset ('core/language.js')}}"></script>




@endsection

@push('script')
<script>
function clipBoard(text) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Copié !');
        });
    } else {
        var input = document.createElement('input');
        document.body.appendChild(input);
        input.value = text;
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand('copy');
        document.body.removeChild(input);
        alert('Copié !');
    }
}

$(document).on('click', '#inviteFriends', function(e) {
    e.preventDefault();
    $('.invite-dialog').show();
});

$(document).on('click', '.invite-dialog .dialog_close', function() {
    $('.invite-dialog').hide();
});

$(document).on('click', '.invite-dialog-overlay', function() {
    $('.invite-dialog').hide();
});

$(document).on('click', '#copy-link', function() {
    clipBoard($('#link').text().trim());
});

$(document).on('click', '#copyCode', function() {
    clipBoard($('#code').text().trim());
});

function shareInvite() {
    var link = $('#link').text().trim();
    if (navigator.share) {
        navigator.share({
            title: 'METAL INVEST',
            text: 'Rejoignez METAL INVEST avec mon lien de parrainage et gagnez des revenus quotidiens !',
            url: link
        });
    } else {
        clipBoard(link);
    }
}
</script>
@endpush
