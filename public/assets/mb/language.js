
function getLanguage() {
    const chooseLanguage = getCookie('sun-language')
    if (chooseLanguage) return chooseLanguage
    return 'zh'
  }

  function getCookie(name){
    var strcookie = document.cookie;//Ã¨Å½Â·Ã¥Ââ€“cookieÃ¥Â­â€”Ã§Â¬Â¦Ã¤Â¸Â²
    var arrcookie = strcookie.split("; ");//Ã¥Ë†â€ Ã¥â€°Â²
    //Ã©ÂÂÃ¥Å½â€ Ã¥Å’Â¹Ã©â€¦Â
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