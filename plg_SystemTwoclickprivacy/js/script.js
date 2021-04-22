'use strict';/**
 * DSGVO Video Embed, v1.0.3
 * (c) 2021 Arndt von Lucadou
 * MIT License
 * https://github.com/a-v-l/dsgvo-video-embed
 */function twoclickprivacy(a){window.video_iframes=[],document.addEventListener('DOMContentLoaded',function(){for(var b,c=function(){var b=document.getElementsByTagName('iframe')[d],c=b.src;/* Only process video iframes [youtube|vimeo] */if(null==c.match(/youtube|vimeo/))return'continue';video_iframes.push(b),'undefined'==typeof b.contentWindow.stop?b.contentWindow.document.execCommand('Stop'):b.contentWindow.stop();var e=null==c.match(/vimeo/)?'youtube':'vimeo',f=c.match(/(embed|video)\/([^?\s]*)/)[2],g=document.createElement('article');g.setAttribute('class','video-wall'),g.setAttribute('data-index',d),g.innerHTML=a[e].replace(/\%id\%/g,f);var h=document.createElement('div');h.setAttribute('class','video-container'),h.appendChild(g),b.parentNode.replaceChild(h,b),fetch('index.php?option=com_ajax&group=system&plugin=twoclickprivacy&format=json',{method:'POST',body:JSON.stringify({id:f})}).then(function(a){return a.blob()}).then(function(a){var b=document.createElement('div');b.setAttribute('class','bg-image');var c=window.URL||window.webkitURL,d=c.createObjectURL(a);b.style.background='url('+d+') no-repeat center center',b.style.backgroundSize='cover',g.appendChild(b)})},d=window.frames.length-1;0<=d;d--)b=c(),'continue'===b;var e=document.querySelectorAll('.video-wall button');e.forEach(function(a){a.addEventListener('click',function(){var a=this.parentNode,b=a.getAttribute('data-index');video_iframes[b].src=video_iframes[b].src.replace(/www\.youtube\.com/,'www.youtube-nocookie.com');var c=document.createElement('div');c.classList.add('video-container'),c.appendChild(video_iframes[b]),a.parentNode.replaceChild(c,a)},!1)})})}