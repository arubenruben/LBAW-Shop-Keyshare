!function(e){"undefined"==typeof ProgressBar?e.ProgressBar=function(){var e={singleStepAnimation:1e3},n=function(e,n,t,r){var i=document.createElement(e);for(var o in i.className=n,t)i.style[o]=t[o];return i.innerHTML=r,i},t=function(t,r,i){var o=100/r.length,a=r.indexOf(i),s=function(t,r,i){var o=n("div","status-bar",{width:100-r+"%"},""),a=n("div","current-status",{},"");return setTimeout(function(){a.style.width=100*i/(t.length-1)+"%",a.style.transition="width "+i*e.singleStepAnimation+"ms linear"},200),o.appendChild(a),o}(r,o,a);t.appendChild(s);var d=function(t,r,i){for(var o=n("ul","progress-bar-adapted",{},""),a=200,s=0;s<t.length;s++){var d=n("li","section",{width:r+"%"},t[s]);i>=s&&(setTimeout(function(e,n,t){e.className+=n>t?" visited":" visited current"},a,d,i,s),a+=e.singleStepAnimation),o.appendChild(d)}return o}(r,o,a);return t.appendChild(d),t};return e.init=function(e,r,i){if(function(e,n,t){return"object"==typeof e&&e.length&&"string"==typeof e[0]?"string"!=typeof n?(console.error('Expecting string for "current stage" parameter.'),!1):"string"==typeof t||void 0===t||(console.error('Expecting string for "container" parameter.'),!1):(console.error('Expecting Array of strings for "stages" parameter.'),!1)}(e,r,i)){var o=document.getElementsByClassName(i);o.length>0?o=o[0]:(o=n("div","progressbar-wrapper",{},""),document.body.appendChild(o)),t(o,e,r)}},e}():console.log("Progress bar loaded")}(window);