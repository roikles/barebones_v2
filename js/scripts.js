/**
 * Rem Polyfil
 * https://github.com/chuckcarpenter/REM-unit-polyfill
 */

(function(e,t){var n=function(){var e=document.createElement("div");e.style.cssText="font-size: 1rem;";return/rem/.test(e.style.fontSize)},r=function(){var e=document.getElementsByTagName("link"),t=[];for(var n=0;n<e.length;n++)if(e[n].rel.toLowerCase()==="stylesheet"&&e[n].getAttribute("data-norem")===null)t.push(e[n]);return t},i=function(){var e=[];v=r();v.og=v.length;for(var t=0;t<v.length;t++){e[t]=v[t].href;f(e[t],s,t)}},s=function(e,t){var n=l(h(e.responseText)),r=/[\w\d\s\-\/\\\[\]:,.'"*()<>+~%#^$_=|@]+\{[\w\d\s\-\/\\%#:;,.'"*()]+\d*\.?\d+rem[\w\d\s\-\/\\%#:;,.'"*()]*\}/g,i=n.match(r),s=/\d*\.?\d+rem/g,u=n.match(s);if(i!==null&&i.length!==0){m=m.concat(i);g=g.concat(u)}if(t===v.og-1)o()},o=function(){var e=/[\w\d\s\-\/\\%#:,.'"*()]+\d*\.?\d+rem[\w\d\s\-\/\\%#:,.'"*()]*[;}]/g;for(var t=0;t<m.length;t++){d=d+m[t].substr(0,m[t].indexOf("{")+1);var n=m[t].match(e);for(var r=0;r<n.length;r++){d=d+n[r];if(r===n.length-1&&d[d.length-1]!=="}")d=d+"\n}"}}u()},u=function(){for(var e=0;e<g.length;e++)y[e]=Math.round(parseInt(g[e].substr(0,g[e].length-3)*w,10))+"px";a()},a=function(){for(var e=0;e<y.length;e++)if(y[e])d=d.replace(g[e],y[e]);var t=document.createElement("style");t.setAttribute("type","text/css");t.id="remReplace";document.getElementsByTagName("head")[0].appendChild(t);if(t.styleSheet)t.styleSheet.cssText=d;else t.appendChild(document.createTextNode(d))},f=function(t,n,r){try{var i=p();i.open("GET",t,true);i.send();var s=function(){var e,t=3,n=document.createElement("div"),r=n.getElementsByTagName("i");while(n.innerHTML="<!--[if gt IE "+ ++t+"]><i></i><![endif]-->",r[0]);return t>4?t:e}();if(s>=7)i.onreadystatechange=function(){if(i.readyState===4)n(i,r)};else i.onreadystatechange=new function(){if(i.readyState===4)n(i,r)}}catch(o){if(e.XDomainRequest){var u=new XDomainRequest;u.open("get",t);u.onload=function(){n(u,r)};u.onerror=function(){return false};u.send()}}},l=function(e){var t=e.search(/\/\*/),n=e.search(/\*\//);if(t>-1&&n>t){e=e.substring(0,t)+e.substring(n+2);return l(e)}else return e},c=function(){if(e.matchMedia||e.msMatchMedia)return true;return false},h=function(e){if(!c())while(e.match(/@media/)!==null){var t=e.match(/@media/).index,n=e.match(/\}\s*\}/);e=e.substring(0,t)+e.substring(n.index+n[0].length)}return e},p=function(){if(e.XMLHttpRequest)return new XMLHttpRequest;else try{return new ActiveXObject("MSXML2.XMLHTTP")}catch(t){try{return new ActiveXObject("Microsoft.XMLHTTP")}catch(n){}}};if(!n()){var d="",v=[],m=[],g=[],y=[],b=document.getElementsByTagName("body")[0],w="";if(b.currentStyle)if(b.currentStyle.fontSize.indexOf("px")>=0)w=b.currentStyle.fontSize.replace("px","");else if(b.currentStyle.fontSize.indexOf("em")>=0)w=b.currentStyle.fontSize.replace("em","");else if(b.currentStyle.fontSize.indexOf("pt")>=0)w=b.currentStyle.fontSize.replace("pt","");else w=b.currentStyle.fontSize.replace("%","")/100*16;else if(e.getComputedStyle)w=document.defaultView.getComputedStyle(b,null).getPropertyValue("font-size").replace("px","");i()}})(window);

jQuery(document).ready(function($) { 

	// script execution

});

/* Google Analytics */

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'XX-XXXXXXXX-X', '');
ga('send', 'pageview');

