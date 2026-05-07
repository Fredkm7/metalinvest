function Toast(msg,duration){
        duration=isNaN(duration)?3000:duration;
          var m = document.createElement('div');
          m.innerHTML = msg;
          m.style.cssText="font-family:'Prompt', sans-serif;width:70%;padding:0 14px;color: rgb(255, 255, 255);padding:10px;text-align: center;border-radius: 8px;position: fixed;bottom: 50%;left: 50%;transform: translate(-50%, -50%);-webkit-transform: translate(-50%,-50%); -moz-transform: translate(-50%,-50%);z-index: 999999;background: rgba(0, 0, 0,.7);font-size: 14px;";
         document.body.appendChild(m);
          setTimeout(function() {
            var d = 0.5;
            m.style.webkitTransition = '-webkit-transform ' + d + 's ease-in, opacity ' + d + 's ease-in';
            m.style.opacity = '0';
            setTimeout(function() { document.body.removeChild(m) }, d * 1000);
          }, duration);
        
        }
    function loading(){

    }