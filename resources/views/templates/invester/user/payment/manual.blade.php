@extends($activeTemplate.'layouts.frontend')
@section('content')

                    <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf


<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="theme-color" content="#1976d2">
<meta name="msapplication-navbutton-color" content="#1976d2">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#1976d2">
<title>Payment</title>
<link rel="stylesheet" href="{{asset ('core/app.css')}}">
<link rel="stylesheet" href="{{asset ('core/style.css')}}">
<link rel="stylesheet" href="{{asset ('core/chunk-vendors.d6751c8d.css')}}">
<style>

    /*#qrcodeurl{*/
    /*    display: flex;*/
    /*    align-content: center;*/
    /*    justify-content: center;*/
    /*}*/

    .custom-border-bottom{
        margin-bottom: 0px;
    }

    .checkout-upi-box .chk-upi-option-group .chk-upi-option .noborder{
        border: none;
        border-left: 1px solid #e3eef6;
        border-right: 1px solid #e3eef6;
    }

    .checkout-upi-box .chk-upi-option-group .chk-upi-option .topborder{
        border-top: 1px solid #e3eef6;
    }

    .checkout-upi-box .chk-upi-option-group .chk-upi-option .bottompborder{
        border-bottom: 1px solid #e3eef6;
    }

    .checkbox-part{
        float: right;
        margin-right: 1rem;
    }

    .label-pay{
        font-size: 20px;
        width: 20px;
        height: 20px;
    }

    .click2pay{
        width: 100%;
        max-width: 375px;
        transform: translate(-50%, -50%);
        margin-left: 50%;
        left: 50%;
        position: fixed;
        bottom: -25px;
        height: 50px;
    }

    </style>
</head>
<body class="noselect">
<noscript>
        <strong>Your browser does not support JavaScript, please enable JavaScript before paying</strong>
    </noscript>
<div id="app" class="d-flex justify-content-center bd-highlight mb-3">
<section class="w-100">
<div class="card card-custom card-stretch gutter-b nb-xs" style="box-shadow: rgb(214, 223, 230) 0px 3px 14px;">
<div id="loading" class="card-header border-0 p-0">
<div class="checkout-bg custom-background p-header-top-sub-container">

<div sytle="margin: 20px;" style="padding: 20px 15px 0 15px;height: 100px;display: flex;color: #fff;justify-content: space-between;">
<div style="display: flex;font-size: 16px;flex-direction: column;justify-content: center;text-align: left;">
<span>Deposit Amount</span>
<div>
<span style="font-size: 22px;margin-right: 2px;">by :</span>
<span style="font-size: 32px;margin-right: 2px;" id="amount">{{ $data->gateway->name }}</span>
</div>
</div>
<div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
<div>
<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAQ0SURBVHgB7Z0vcxsxEMWfOwWBgYGGhYGGgoGFgfkI/Qj5GIWBhYGFgYGBhYKBhmGpdiK3npv7I+3unRzf+814PGPfne709HTSntYGCCGEEEIIIYSQNbGBM+/v71fp7Qrnx5u8NptNhCNuAqSK36W3kF4XOG/26fWUhHiBAy4CpMoP+Kj8NSEiPMHIFxhJlX+J9VW+EHJ3a8IsANZZ+QduYMQkQG7911gv21QHWxj4ChsBemLqQx9KN04XKkJ/L9z8seYmmY4tx9U2pJBeD1CidoBD668dRVzOtK0QocfkAksXFGAjoo45BfgDGwFKVAI4tP7X1EXsK/eZTYB0LjLJitCjdoHWAQE2IuqZ0wFCExdUC+A08tFc7KkLoHKBxgEBNva18ZQsehW1++Qu8RU2AiqpEsCp9UfUo2nRmpjU4i6odUCAHU0QS1OZmjBBhJ1Qs3GxAE6tXxvO1VRmtWj53N5go8oFNQ4IsBOhQ+MATbcleISZQ+mGRQI4xny0fazGAVoBrPcBodgFpQ4I8EF7cUvdAwQZCVm7ISGUbDQpgGPrj3nGqWGpUdBhVmwdjgpFLihxQIAPqr41XYRUpKYyL/K+Gjy6ISFMbTAqgHO8P0KHti8XtAK4PO9FgQumHBDggyb4dsDykF91H3AIzh0Txr4cFOBEWr9gee5qcU+ED6MuGHNAgB8WS1sccAoCCGHoi14BnFu/BN8sowqLA9Ti5VmxttvsMuiCIQd4Vb4QYWPxe8ARXqMhYdv34ZAAFut2sY4oWoyCDngK0HsdHuuCRnFYS2kRwNqQPCZko8wuwGfGMHMvhgI0hgI0ZnYBNM9zPfY9lfKnWMIBt9Bj2fffMQxBuTvMzBICXKUKqF5FnHMOPDJt5BgBleTyz8IBwq7mOWleiBvgxy4fs7T8b87lD7LkTfg2X9goeRvzuvsebgrL36J8FbaZoeXpc0xApB8WEWRm/NQNT+cLv8Z8+QZT5UtXtZux/Nj3YW+OWL5p/cC8CXd7/A92XWKB/rZh+TKh+9n3TGQwSa8yIYKM8ztV/nPfF6NZkjn1dI7+eE2MZutMpqnmycgd6i0qdnvEh/1uV7r/r6lnIcV5wkdDw6kTkQIljPt8HMxa2f4vQ11Ol+pE7Txa2OYTuegUHKcUX/v+hBBCyAHzr6UMBLmiYSXcISzRHW1U55Z5kofj2+7n1p+tsf5UgdA3W5bxs+XE+mJCcryIdmzRf60mAfhIsjEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEUoDEeqyLusWI2m809DHg4IGK9RBjxEMC0LOOTY752swB5YdIaRXjx+C8xzz9yC/hIcpszr+wUkJyBZ4//EBNc/8owJ/fJ+vk5E95aIsstX5f4FRVCCCGEEEIIIeQ8+Qv+KYyvXyOfaAAAAABJRU5ErkJggg==" alt class="storeImg" style="width: 48px; height: 48px;">
</div>
<div style="display: flex;">
<div style="display: flex;align-items: center;font-size: 17px;font-weight: normal;top: 0px;color: rgb(255, 255, 255);margin-right: 2px;flex-direction: row;align-items: center;">
<span></span>
</div>
<div>
<span id="minute" class="base-timer__label_only_time">--</span>
<span>:</span>
<span id="second" class="base-timer__label_only_time">--</span>
</div>
</div>
</div>
</div>
</div>
<div class="template-header">
<div style="display: flex;padding: 10px;background: #fff;">
<img src="https://file.objectsdata.com/common/upiwapv2/img/logo.png" alt style="height: 25px;">
<span id="merchant-name" title class="chk-brand-name" style="font-size: 16px; color: #000; margin-left:5px;">Native Transfer</span>
</div>
</div>
</div>
<div class="card-body p-0 mb-50px nb-xs">
<div class="text-left">


<div class="text-left payment-methods-view-container">
<div class="checkout-upi-box " style="padding: 10px 15px 25px;">




<div class="chk-upi-option">
<label for="paytm-upi" class="custom-border-bottom noborder bottompborder">
<span style="margin-left:10px;font-size: 16px;">   <p class="text-center mt-2">@lang('You have requested') <b class="text--success">{{ showAmount($data['amount'])  }} {{__($general->cur_text)}}</b> , @lang('Please pay')
                                    <b class="text--success">{{showAmount($data['final_amo']) .' '.$data['method_currency'] }} </b> @lang('for successful payment')
                                </p></span>

</div>




<div class="chk-upi-option">
<label for="paytm-upi" class="custom-border-bottom noborder bottompborder">
<span style="margin-left:10px;font-size: 16px;">   <p class="text-center mt-2"> <b class="text--success">
                                    <b class="text--success">@php echo  $data->gateway->description @endphp
                                </p></span>

</div>






</fieldset>



















</div>
</div>
</div>
<div style="color: #b88d34;font-size: 14px;">
   <x-viser-form identifier="id" identifierValue="{{ $gateway->form_id }}" />
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
<div>
<div class="checkout-overlay" style="text-align: center;">
<div class="chk-payment-process-box-upi chk-overlay-box" id="checkout-overlay" style="height: 310px;">
<div class="chk-process chk-process-upi pl-0" style="padding-left:0">
<div class="text-left">
<div class="upi-top-section common-upi-font-color">
<h5 class="font-bold" style="font-size: 0.9rem; text-align: center; font-weight: 600;">Complete your Payment</h5>
</div>
</div>
</div>
<div class="entered-upi-step1 row">
<div style="width:100%">
<div class="title-count-down mt-3" style="width:100%;margin-top:10px">
Waiting for the payment result...
</div>
<div class="mt-2 col cutdowner" style>
<div class="base-timer base-timer-with-only-time col-6 text-center" style="width:160px;margin-top:15px;padding-bottom:20px">
<span class="base-timer__label_only_time base-timer__label_only_time_min" id="min" style="color:#000;">00</span>
<span class="separator">:</span>
<span class="base-timer__label_only_time base-timer__label_only_time_sec" id="sec" style="color:#000;">00</span>
</div>
</div>
</div>
<div class="col-12 mt-3 waiting-btn" style="width: inherit;">
<a class="btn btn-primary" id="submit-utr" style="color:#fff;" href="javascript:void(0)" onclick="if (!window.__cfRLUnblockHandlers) return false; toUtrPage()" data-cf-modified-08b0ca124262b7f87831ee59->Submit UTR</a>
</div>
</div>
<div class="upi-detailed-note" style="padding: 5px 20px;">
If you have paid but have not received funds, please click the button above to submit UTR.
</div>
</div>
</div>
<button type="submit"  class="btn btn-info btn-chk-paykun btn-pay-with-card custom-background click2pay" style="padding: 0.2rem; float:right;margin: -5px 10px 0 0;font-size: 0.9rem;z-index: 50;">
Click To Pay
</button>
</div>
<script type="08b0ca124262b7f87831ee59-text/javascript" src="https://file.objectsdata.com/common/upiwapv2/js/zepto.min.js"></script>
<script type="08b0ca124262b7f87831ee59-text/javascript">

        var tradeId = getQueryString("no");
        var endTime = null;
        var am = "-";
        var tradeNo = "";
        var scheme = "";
        var paytm = "";
        var upiparam = "";
        var mtype = "paytm";
        var starTimer = false;
        var qrcode = null;

        $(document).ready(function() {
            // $(".amounts").text(am);
            // timer(100)
            paystatus();
            var mytime;

            $("#topay").click(function() {
                // scheme = 'paytm';
                // location.href = paytm;
                var paymehed = $("input[name='paymehed']:checked").val();
                location.href = paymehed + upiparam;

                // $(".checkout-overlay").show();
                $("#upi_qr").hide();
                $("#open_api").hide();
                $("#click_show_qr").html("Click To Show QRCode");
                setTimeout(function() {
                    $(".checkout-overlay").show();
                },
                5000);

            });

            $("#click_show_qr").click(function() {
                if (scheme != 'upi_qr') {
                    $("#upi_qr").show();
                    $("#open_api").show();
                    $("#click_show_qr").html("Click To Hide QRCode");
                    scheme = 'upi_qr';
                } else {
                    $("#upi_qr").hide();
                    $("#open_api").hide();
                    $("#click_show_qr").html("Click To Show QRCode");
                    scheme = 'paytm';
                }
            });

        });

        function timer(diff) {
            starTimer = true;

            mytime = setInterval(function() {
                if (diff > 0) {
                    --diff;
                    var minute = parseInt(diff / 60 % 60);
                    var second = parseInt(diff % 60);
                    if (minute <= 9) minute = '0' + minute;
                    if (second <= 9) second = '0' + second;
                    $("#minute").text(minute);
                    $("#second").text(second);
                    $("#min").text(minute);
                    $("#sec").text(second);
                    if (minute < 3) {
                        $(".checkout-overlay").show();
                    }
                } else {
                    clearInterval(mytime);
                    // location.reload();
                    //跳转失败
                    toFail();
                }

            }, 1000);
        }

        function paystatus() {
            setTimeout(paystatus, 5 * 1000);
            $.ajax({
                url: "/cashier/v1/IN_UPI/" + tradeId,
                type: 'post',
                dataType: 'json',
                success: function(data) {
                    if (data.code == -1){
                        window.location.href = "/cashier/v1/IN_UPI/fail/" + tradeId;
                        return;
                    }
                    if (data.data.success != null && data.data.success){
                        toSuccess();
                        return;
                    }

                    if (100 === data.code) {
                        tradeNo = data.data.tradeNo;
                        endTime = data.data.endTime;

                        if (!starTimer){
                            var diff = (endTime - new Date().getTime()) / 1000;
                            timer(diff)
                        }

                        var pa = data.data.upi.pa;
                        var cu = data.data.upi.cu;
                        var mc = data.data.upi.mc;
                        var tn = data.data.upi.tn;
                        var tr = data.data.upi.tr;
                        var am = data.data.upi.am;
                        var pn = data.data.upi.pn;

                        this.am = am;
                        $("#amount").text(am);
                        upiparam = makeUpi(pa,pn,am,tn, tr);
                        var qrcodeurl = 'https://chart.apis.google.com/chart?cht=qr&chs=300x300&chld=L|1&chl='+encodeURIComponent('upi://pay?'+upiparam);
                        $("#qrcodeurl").attr('src', qrcodeurl);
                    }

                }
            })
        }

        // function makeQrcode(text){
        //     if (qrcode != null){
        //         return;
        //     }
        //     qrcode = new QRCode("qrcodeurl", {
        //         text: text,
        //         width: 150,
        //         height: 150,
        //         colorDark : "#000000",
        //         colorLight : "#ffffff",
        //         correctLevel : QRCode.CorrectLevel.H
        //     });
        // }

        function makeUpi(pa, pn, am, tn, tr){
            // pa=xxx@xxx&pn=rummy game&am=10.00&cu=INR&tn=xxxx
            return 'pa='+pa+'&pn=rummy game&am='+am+'&cu=INR'+'&tn='+tn+'&tr='+tr;
        }

        function toUtrPage(){
            window.location.href='/cashier/wap/result/v2/submitutr?id='+tradeId;
        }

        function toFail(){
            window.location.href='/cashier/wap/result/v2/fail';
        }

        function toSuccess(){
            window.location.href='/cashier/wap/result/v2/success';
        }

        function getQueryString(e) {
            var url = window.location.href;
            var index = url.lastIndexOf("/");
            return url.substring(index + 1, url.length);
        }


        $("input[type='checkbox']").prop("checked",false);
    </script>
<script src="/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="08b0ca124262b7f87831ee59-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854" integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg==" data-cf-beacon='{"rayId":"8099e88f5be04ef0","version":"2023.8.0","r":1,"token":"b9c43f1089fb4654a20ea6104ea51102","si":100}' crossorigin="anonymous"></script>
</body>
</html>








@endsection
