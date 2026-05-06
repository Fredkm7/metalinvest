
function getLanguage() {
    const chooseLanguage = getCookie('sun-language')
    if (chooseLanguage) return chooseLanguage
    return 'zh'
  }

  function getCookie(name){
    var strcookie = document.cookie;//èŽ·å–cookieå­—ç¬¦ä¸²
    var arrcookie = strcookie.split("; ");//åˆ†å‰²
    //éåŽ†åŒ¹é…
    for ( var i = 0; i < arrcookie.length; i++) {
    var arr = arrcookie[i].split("=");
    if (arr[0] == name){
    return arr[1];
    }
    }
    return "";
    }

    function setCookie(val){
        document.cookie=`sun-language=${val}`
    }

    const enLanguage = getLanguage() === 'en'

    $('.en-text')[enLanguage ? 'show' : 'hide']()
    $('.zh-text')[enLanguage ? 'hide' : 'show']()