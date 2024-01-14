/**
 * DSGVO Video Embed, v1.0.3
 * (c) 2021 Arndt von Lucadou
 * MIT License
 * https://github.com/a-v-l/dsgvo-video-embed
 */

function twoclickprivacy(text){
    window.video_iframes = [];
    
    document.addEventListener("DOMContentLoaded", function() {
        for (var i = window.frames.length - 1; i >= 0; i--) {
            let video_frame = document.getElementsByTagName('iframe')[i];
            let video_src = video_frame.src || video_frame.dataset.src;
            
            /* Only process video iframes [youtube|vimeo] */
            if (video_src.match(/youtube|vimeo/) == null) {
                continue;
            }

            video_iframes[i] = video_frame;
            if (!!video_frame.src) {
                if (typeof (video_frame.contentWindow.stop) === 'undefined'){
                    video_frame.contentWindow.document.execCommand('Stop');
                }else{
                    video_frame.contentWindow.stop();
                }
            }
            
            let video_platform = video_src.match(/vimeo/) == null ? 'youtube' : 'vimeo';
            let video_id = video_src.match(/(embed|video)\/([^?\s]*)/)[2];
            
            let wall = document.createElement('article');
            wall.setAttribute('class', 'video-wall');
            wall.setAttribute('data-index', i);
            wall.innerHTML = text[video_platform].replace(/\%id\%/g, video_id);

            let wall_container = document.createElement('div');
            wall_container.setAttribute('class', 'video-container');
            wall_container.appendChild(wall);

            video_frame.parentNode.replaceChild(wall_container, video_frame);
        }

        let wallButtons = document.querySelectorAll('.video-wall button');
        wallButtons.forEach((button) => {
            button.addEventListener('click', function() {
                let video_frame = this.parentNode;
                
                let index = video_frame.dataset.index;
                if (!!video_iframes[index].dataset.src) {
                    video_iframes[index].src = video_iframes[index].dataset.src;
                    video_iframes[index].removeAttribute('data-src');
                }

                video_iframes[index].src = video_iframes[index].src.replace(/www\.youtube\.com/, 'www.youtube-nocookie.com');

                let video_container = document.createElement('div');
                video_container.classList.add('video-container');
                video_container.appendChild(video_iframes[index]);
                video_frame.parentNode.replaceChild(video_container, video_frame);
            }, false);
        });
    });
}