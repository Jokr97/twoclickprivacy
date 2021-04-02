/**
 * DSGVO Video Embed, v1.0.3
 * (c) 2021 Arndt von Lucadou
 * MIT License
 * https://github.com/a-v-l/dsgvo-video-embed
 */

(() => {
    let text = {
        youtube: '<strong>Eingebettetes YouTube-Video</strong><div><p><b>Hinweis:</b> Dieses eingebettete Video wird von YouTube, LLC, 901 Cherry Ave., San Bruno, CA 94066, USA bereitgestellt.<br>Beim Abspielen wird eine Verbindung zu den Servern von YouTube hergestellt. Dabei wird YouTube mitgeteilt, welche Seiten Sie besuchen. Wenn Sie in Ihrem YouTube-Account eingeloggt sind, kann YouTube Ihr Surfverhalten Ihnen persönlich zuzuordnen. Dies verhindern Sie, indem Sie sich vorher aus Ihrem YouTube-Account ausloggen.</p><p>Wird ein YouTube-Video gestartet, setzt der Anbieter Cookies ein, die Hinweise über das Nutzerverhalten sammeln.</p><p>Wer das Speichern von Cookies für das Google-Ads-Programm deaktiviert hat, wird auch beim Anschauen von YouTube-Videos mit keinen solchen Cookies rechnen müssen. YouTube legt aber auch in anderen Cookies nicht-personenbezogene Nutzungsinformationen ab. Möchten Sie dies verhindern, so müssen Sie das Speichern von Cookies im Browser blockieren.</p><p>Weitere Informationen zum Datenschutz bei „YouTube“ finden Sie in der Datenschutzerklärung des Anbieters unter: <a href="https://www.google.de/intl/de/policies/privacy/" rel="noopener" target="_blank">https://www.google.de/intl/de/policies/privacy/</a></p></div><a class="video-link" href="https://youtu.be/%id%" rel="noopener" target="_blank" title="Video auf YouTube ansehen">Link zum Video: https://youtu.be/%id%</a><button title="Video auf dieser Seite ansehen">Video abspielen</button>',
        vimeo: '<strong>Eingebettetes Vimeo-Video</strong><div><p><b>Hinweis:</b> Dieses eingebettete Video wird von Vimeo, Inc., 555 West 18th Street, New York, New York 10011, USA bereitgestellt.<br>Beim Abspielen wird eine Verbindung zu den Servern von Vimeo hergestellt. Dabei wird Vimeo mitgeteilt, welche Seiten Sie besuchen. Wenn Sie in Ihrem Vimeo-Account eingeloggt sind, kann Vimeo Ihr Surfverhalten Ihnen persönlich zuzuordnen. Dies verhindern Sie, indem Sie sich vorher aus Ihrem Vimeo-Account ausloggen.</p><p>Wird ein Vimeo-Video gestartet, setzt der Anbieter Cookies ein, die Hinweise über das Nutzerverhalten sammeln.</p><p>Weitere Informationen zum Datenschutz bei „Vimeo“ finden Sie in der Datenschutzerklärung des Anbieters unter: <a href="https://vimeo.com/privacy" rel="noopener" target="_blank">https://vimeo.com/privacy</a></p></div><a class="video-link" href="https://vimeo.com/%id%" rel="noopener" target="_blank" title="Video auf Vimeo ansehen">Link zum Video: https://vimeo.com/%id%</a><button title="Video auf dieser Seite ansehen">Video abspielen</button>'
    };
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
})();