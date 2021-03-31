<?php
/**
 * @package    TWOCLICKPRIVACY
 *
 * @author     Lukas Schneider
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Plugin\CMSPlugin;

defined('_JEXEC') or die;

class plgSystemTwoclickprivacy extends CMSPlugin
{
    function __construct( $subject, $params )
	{
		parent::__construct($subject, $params);

    }
    
	function onBeforeCompileHead()
	{
        $app = JFactory::getApplication();
        $document = JFactory::getDocument();

        if ($app->isSite()){
            $js = "
                /**
                 * DSGVO Video Embed, v1.0.3
                 * (c) 2021 Arndt von Lucadou
                 * MIT License
                 * https://github.com/a-v-l/dsgvo-video-embed
                 */

                (function() {
                // Config
                var text = {
                    youtube: '<strong>Eingebettetes YouTube-Video</strong><div><p><b>Hinweis:</b> Dieses eingebettete Video wird von YouTube, LLC, 901 Cherry Ave., San Bruno, CA 94066, USA bereitgestellt.<br>Beim Abspielen wird eine Verbindung zu den Servern von YouTube hergestellt. Dabei wird YouTube mitgeteilt, welche Seiten Sie besuchen. Wenn Sie in Ihrem YouTube-Account eingeloggt sind, kann YouTube Ihr Surfverhalten Ihnen persönlich zuzuordnen. Dies verhindern Sie, indem Sie sich vorher aus Ihrem YouTube-Account ausloggen.</p><p>Wird ein YouTube-Video gestartet, setzt der Anbieter Cookies ein, die Hinweise über das Nutzerverhalten sammeln.</p><p>Wer das Speichern von Cookies für das Google-Ads-Programm deaktiviert hat, wird auch beim Anschauen von YouTube-Videos mit keinen solchen Cookies rechnen müssen. YouTube legt aber auch in anderen Cookies nicht-personenbezogene Nutzungsinformationen ab. Möchten Sie dies verhindern, so müssen Sie das Speichern von Cookies im Browser blockieren.</p><p>Weitere Informationen zum Datenschutz bei „YouTube“ finden Sie in der Datenschutzerklärung des Anbieters unter: <a href=\"https://www.google.de/intl/de/policies/privacy/\" rel=\"noopener\" target=\"_blank\">https://www.google.de/intl/de/policies/privacy/</a></p></div><a class=\"video-link\" href=\"https://youtu.be/%id%\" rel=\"noopener\" target=\"_blank\" title=\"Video auf YouTube ansehen\">Link zum Video: https://youtu.be/%id%</a><button title=\"Video auf dieser Seite ansehen\">Video abspielen</button>',
                    vimeo: '<strong>Eingebettetes Vimeo-Video</strong><div><p><b>Hinweis:</b> Dieses eingebettete Video wird von Vimeo, Inc., 555 West 18th Street, New York, New York 10011, USA bereitgestellt.<br>Beim Abspielen wird eine Verbindung zu den Servern von Vimeo hergestellt. Dabei wird Vimeo mitgeteilt, welche Seiten Sie besuchen. Wenn Sie in Ihrem Vimeo-Account eingeloggt sind, kann Vimeo Ihr Surfverhalten Ihnen persönlich zuzuordnen. Dies verhindern Sie, indem Sie sich vorher aus Ihrem Vimeo-Account ausloggen.</p><p>Wird ein Vimeo-Video gestartet, setzt der Anbieter Cookies ein, die Hinweise über das Nutzerverhalten sammeln.</p><p>Weitere Informationen zum Datenschutz bei „Vimeo“ finden Sie in der Datenschutzerklärung des Anbieters unter: <a href=\"https://vimeo.com/privacy\" rel=\"noopener\" target=\"_blank\">https://vimeo.com/privacy</a></p></div><a class=\"video-link\" href=\"https://vimeo.com/%id%\" rel=\"noopener\" target=\"_blank\" title=\"Video auf Vimeo ansehen\">Link zum Video: https://vimeo.com/%id%</a><button title=\"Video auf dieser Seite ansehen\">Video abspielen</button>'
                };
                window.video_iframes = [];
                document.addEventListener(\"DOMContentLoaded\", function() {
                    var video_frame, wall, video_platform, video_src, video_id, video_w, video_h;
                    for (var i=0, max = window.frames.length - 1; i <= max; i+=1) {
                    video_frame = document.getElementsByTagName('iframe')[0];
                    video_src = video_frame.src;
                    // Only process video iframes [youtube|vimeo]
                    if (video_src.match(/youtube|vimeo/) == null) {
                        continue;
                    }
                    
                    video_iframes.push(video_frame);
                    video_w = video_frame.getAttribute('width');
                    video_h = video_frame.getAttribute('height');
                    wall = document.createElement('article');
                    
                    
                    // Prevent iframes from loading remote content
                    if (typeof (window.frames[0].stop) === 'undefined'){
                        setTimeout(function() {window.frames[0].execCommand('Stop');},1000);
                    }else{
                        setTimeout(function() {window.frames[0].stop();},1000);
                    }
                    video_platform = video_src.match(/vimeo/) == null ? 'youtube' : 'vimeo';
                    video_id = video_src.match(/(embed|video)\/([^?\s]*)/)[2];
                    wall.setAttribute('class', 'video-wall');
                    wall.setAttribute('data-index', i);
                    if (video_w && video_h) {
                        wall.setAttribute('style', 'width:'+video_w+'px;height:'+video_h+'px');
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
            ";

            $document->addScriptDeclaration($js);   

            $css = "
              iframe {
                display: inline-block;
              }
              .video-wall {
                position: relative;
                font: 400 1em/1.46 Helvetica, Arial, sans-serif;
                color: #333;
                display: inline-block;
                min-height: 18em;
                min-width: 28em;
                margin: 0;
                background-color: #eee;
                box-sizing: border-box;
                border: 1.5em solid #ccc;
                padding: 1em;
              }
              .video-wall strong {
                display: block;
                text-align: center;
                font-size: 1.1em;
                margin: 0;
              }
              .video-wall div {
                position: absolute;
                width: calc(100% - 2em);
                top: 3em;
                bottom: 7em;
                overflow-y: auto;
              }
              .video-wall p {
                font-size: 0.8em;
                margin: 0 0 1em;
              }
              .video-wall a {
                color: inherit;
              }
              .video-wall .video-link {
                display: block;
                white-space: nowrap;
                font-size: 0.8em;
                margin: 0;
                position: absolute;
                left: 50%;
                bottom: 6em;
                transform: translateX(-50%);
              }
              .video-wall button {
                -webkit-appearance: none;
                cursor: pointer;
                color: #eee;
                font: 700 0.8em/1.2 Helvetica, Arial, sans-serif;
                display: block;
                width: 11.5em;
                height: 4.25em;
                border: 0 none;
                border-radius: 0.75em;
                padding: 0 0 0 5.5em;
                text-align: left;
                margin: 0;
                position: absolute;
                left: 50%;
                bottom: 1em;
                transform: translateX(-50%);
                background: url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 28 28'%3E%3Cpath fill='%23eee' d='M11.109 17.625l7.562-3.906-7.562-3.953v7.859zM14 4.156c5.891 0 9.797 0.281 9.797 0.281 0.547 0.063 1.75 0.063 2.812 1.188 0 0 0.859 0.844 1.109 2.781 0.297 2.266 0.281 4.531 0.281 4.531v2.125s0.016 2.266-0.281 4.531c-0.25 1.922-1.109 2.781-1.109 2.781-1.062 1.109-2.266 1.109-2.812 1.172 0 0-3.906 0.297-9.797 0.297v0c-7.281-0.063-9.516-0.281-9.516-0.281-0.625-0.109-2.031-0.078-3.094-1.188 0 0-0.859-0.859-1.109-2.781-0.297-2.266-0.281-4.531-0.281-4.531v-2.125s-0.016-2.266 0.281-4.531c0.25-1.937 1.109-2.781 1.109-2.781 1.062-1.125 2.266-1.125 2.812-1.188 0 0 3.906-0.281 9.797-0.281v0z'%3E%3C/path%3E%3C/svg%3E\") no-repeat 1em center #666;
                background-size: 3.5em;
                transition: background-color 0.3s;
              }
              .video-wall button:hover {
                background-color: #444;
              }
            ";

            $document->addStyleDeclaration($css);
        }
    }
}