/**
 * DSGVO Video Embed, v1.0.3
 * (c) 2021 Arndt von Lucadou
 * MIT License
 * https://github.com/a-v-l/dsgvo-video-embed
 */

function twoclickprivacy(text){
    window.video_iframes = [];
    
    document.addEventListener("DOMContentLoaded", function() {
        for (var i=0, max = window.frames.length - 1; i <= max; i+=1) {
            let video_frame = document.getElementsByTagName('iframe')[0];
            let video_src = video_frame.src;
            
            // Only process video iframes [youtube|vimeo]
            if (video_src.match(/youtube|vimeo/) == null) {
                return;
            }
            
            video_iframes.push(video_frame);
            let video_w = video_frame.clientWidth;
            let video_h = video_frame.clientHeight;
            let wall = document.createElement('article');

            if (typeof (video_frame.contentWindow.stop) === 'undefined'){
                video_frame.contentWindow.document.execCommand('Stop');
              }else{
                  video_frame.contentWindow.stop();
              }

            let video_platform = video_src.match(/vimeo/) == null ? 'youtube' : 'vimeo';
            let video_id = video_src.match(/(embed|video)\/([^?\s]*)/)[2];

            wall.setAttribute('class', 'video-wall');
            wall.setAttribute('data-index', i);

            if (video_w && video_h) {
                wall.setAttribute('style', `width: ${video_w}px; height: ${video_h}px`);
            }

            wall.innerHTML = text[video_platform].replace(/\%id\%/g, video_id);

            video_frame.parentNode.replaceChild(wall, video_frame);

            document.querySelectorAll('.video-wall button')[i].addEventListener('click', function() {
                var video_frame = this.parentNode,
                    index = video_frame.getAttribute('data-index');
                video_iframes[index].src = video_iframes[index].src.replace(/www\.youtube\.com/, 'www.youtube-nocookie.com');
                video_frame.parentNode.replaceChild(video_iframes[index], video_frame);
            }, false);
        }
    });
}