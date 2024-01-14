'use strict';/**
 * DSGVO Video Embed, v1.0.3
 * (c) 2021 Arndt von Lucadou
 * MIT License
 * https://github.com/a-v-l/dsgvo-video-embed
 */function twoclickprivacy(a){window.video_iframes=[],document.addEventListener('DOMContentLoaded',function(){for(var b=window.frames.length-1;0<=b;b--){var c=document.getElementsByTagName('iframe')[b],d=c.src||c.dataset.src;/* Only process video iframes [youtube|vimeo] */if(null!=d.match(/youtube|vimeo/)){video_iframes[b]=c,!c.src||('undefined'==typeof c.contentWindow.stop?c.contentWindow.document.execCommand('Stop'):c.contentWindow.stop());var e=null==d.match(/vimeo/)?'youtube':'vimeo',f=d.match(/(embed|video)\/([^?\s]*)/)[2],g=document.createElement('article');g.setAttribute('class','video-wall'),g.setAttribute('data-index',b),g.innerHTML=a[e].replace(/\%id\%/g,f);var h=document.createElement('div');h.setAttribute('class','video-container'),h.appendChild(g),c.parentNode.replaceChild(h,c)}}var j=document.querySelectorAll('.video-wall button');j.forEach(function(a){a.addEventListener('click',function(){var a=this.parentNode,b=a.dataset.index;!video_iframes[b].dataset.src||(video_iframes[b].src=video_iframes[b].dataset.src,video_iframes[b].removeAttribute('data-src')),video_iframes[b].src=video_iframes[b].src.replace(/www\.youtube\.com/,'www.youtube-nocookie.com');var c=document.createElement('div');c.classList.add('video-container'),c.appendChild(video_iframes[b]),a.parentNode.replaceChild(c,a)},!1)})})}