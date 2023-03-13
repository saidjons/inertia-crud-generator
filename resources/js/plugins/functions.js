export  function jsonHighlight(json) {
    json=JSON.stringify(json, undefined, 4)
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
  }

export function getUrlWithoutQuery () {
  let url=  window.location.protocol +"//"+ window.location.host + window.location.pathname
  if(!url.endsWith('/')){
    return url+"/"
  }
  return url
}
export function getUniqueQuizUrl (link) {
    let getWordCat = function() {
        let lang = this.$page.props.wordlist.to
        switch (lang) {

            case 'uz': return 'word_cats_uz/'; break;
            case 'ru': return 'word_cats_ru/'; break;

            default: return 'word_cats/'; break;
        }
    }
   let  getUniqueQuizUrl = function () {
        return "/grammar/challenge/" + this.getWordCat() + this.getCatId()
    }
    let getCatId = function() {
        let url = this.$page.url
        return url.split('/')[url.split('/').length - 1]
    }
}
export function filterLongmanAudioLink (link) {
    return link.substring(0, link.indexOf('?'))
}

export function convertFileLinktoFull (link) {
    let host = window.location.origin
    if (link.startsWith('/')) {
        return host + link
    } else {
        return host + '/' + link
    }
}

export function makeID (length) {
    var result = ''
    var characters =
        'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
    var charactersLength = characters.length
    for (var i = 0; i < length; i++) {
        result += characters.charAt(
            Math.floor(Math.random() * charactersLength)
        )
    }
    return result
}

export function randomString(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
export function flattenObject(ob) {
      var toReturn = {};

      for (var i in ob) {
        if (!ob.hasOwnProperty(i)) continue;

        if (typeof ob[i] == "object" && ob[i] !== null) {
          var flatObject = this.flattenObject(ob[i]);
          for (var x in flatObject) {
            if (!flatObject.hasOwnProperty(x)) continue;

            toReturn[i + "." + x] = flatObject[x];
          }
        } else {
          toReturn[i] = ob[i];
        }
      }
      return toReturn;
    }
