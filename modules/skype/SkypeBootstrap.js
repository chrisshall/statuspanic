!function(){var a={platformId:905,urls:["https://a.config.skype.com/config/v1","https://b.config.skype.com/config/v1"],team:"SkypeLyncWebExperience",maximumAttempts:3,waitDuration:3e3};window.Skype=window.Skype||{};var b="1.1.23.0";!function(a){function d(a,b){var c=a;return b=void 0===b?1:b,"object"!=typeof c&&(c={message:a||"unknown error"}),void 0===c.code&&(c.code=b),c}function f(a){return d(a,0)}function h(a){if(void 0===a||null===a)throw"settings object is required"}function i(a){if("function"!=typeof a)throw"onSuccess callback is required"}a.getVersion=function(){return b},a.initialize=function(b,j,k){"use strict";function l(a){k&&k(d(a))}function m(c){if(!c.packageUrl)return void l(f("no package to load for this config"));var d=(new Date).getTime(),e={};a.onExperienceLoaded=function(e){var f=(new Date).getTime();e.init({initParams:b,config:c,configLoadDuration:d-n,packageLoadDuration:f-d},j,l),delete a.onExperienceLoaded},c.corsScript&&(e.crossOrigin=""),g.loadScript(c.packageUrl,null,l,e)}var n=(new Date).getTime();h(b),i(j),b.fingerprint=e.get(window),c.loadConfig(b,m,l)}}(window.Skype);var c=function(){"use strict";function c(b){var c=[];return a&&a.urls&&(c=e(a.urls,b)),c}function e(c,e){var f,g,h=d.get(window),i=[];for(f=0;f<c.length;f++)g=c[f]+"/"+a.team+"/"+a.platformId+"_"+b,g+="?apikey="+e.apiKey,e.fingerprint&&(g+="&fingerprint="+e.fingerprint),h&&(g+="&ecsoverride="+h),i.push(g);return i}function g(b,d,e){function g(a){n++,f.request(a,"onConfigurationLoaded",j,k,"ecsConfig")}function i(){return n/m.length>=(a.maximumAttempts||h)}function j(b){if(!l&&(l=!0,d&&b)){var c=b[a.team];c&&d(c)}}function k(){i()?e&&e("configuration service unreachable"):g(m[++o%m.length])}var l,m,n=0,o=0;return b&&b.apiKey?(m=c(b),m&&m.length?void g(m[o]):void(e&&e("no configuration service endpoint"))):void(e&&e("apiKey is required"))}var h=2;return{loadConfig:g}}(),d=function(){"use strict";function a(a){a=a||window;var b=a.location.search.match(new RegExp(c,"i"));return b&&b[1]?b[1]:(b=a.document.cookie.match(new RegExp(d,"i")),b&&b[1]?b[1]:void 0)}var b="ecsoverride",c="\\b"+b+"=([^&]+)",d="\\b"+b+"=([^;]+)";return{get:a}}(),e=function(){"use strict";function a(){return("0000000"+Date.now().toString(16)).slice(-8)+"-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g,function(a){var b=Math.floor(16*Math.random());return("x"===a?b:8+b%4).toString(16)})}function b(b){b=b||window;var d=b.localStorage.getItem(c);if(!d){d=a();try{b.localStorage.setItem(c,d)}catch(e){}}return d}var c="skype.fingerprint";return{get:b}}(),f=function(b){"use strict";function c(c,e,f,h,i){if(!c||!e)throw"mandatory options missing";var j,k,l=function(){b.clearInterval(k),h&&(h(),h=null,f=null)};j=c+(/\?/.test(c)?"&":"?")+"callback=Skype."+e,b.Skype[e]=function(){b.clearInterval(k),f&&f.apply(null,arguments)},g.loadScript(j,d,l,{id:i}),k=b.setTimeout(l,a.timeout||2e4)}var d=function(){};return{request:c}}(window),g=function(){"use strict";function a(a,b,c,d){var e=document.createElement("script");d=d||{},e.src=a,e.type="text/javascript",e.defer=!0,b&&(e.onload=b),c&&(e.onerror=c),Object.keys(d).forEach(function(a){void 0!==d[a]&&(e[a]=d[a])}),document.head.appendChild(e)}return{loadScript:a}}()}();