<?php
/**
 * @package    TWOCLICKPRIVACY
 *
 * @author     Lukas Schneider
 * @license    MIT License
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
            $youtubeheading = $this->params->get("youtubeheading");
            $youtubetext = $this->params->get("youtubetext");
            $youtubetext = str_replace(array("\r\n", "\r", "\n", "\t"), '', $youtubetext);
            $youtubelinktitle = $this->params->get("youtubelinktitle");
            $youtubelinktext = $this->params->get("youtubelinktext");
            $youtubebuttontitle = $this->params->get("youtubebuttontitle");
            $youtubebuttontext = $this->params->get("youtubebuttontext");

            $vimeoheading = $this->params->get("vimeoheading");
            $vimeotext = $this->params->get("vimeotext");
            $vimeotext = str_replace(array("\r\n", "\r", "\n", "\t"), '', $vimeotext);
            $vimeolinktitle = $this->params->get("vimeolinktitle");
            $vimeolinktext = $this->params->get("vimeolinktext");
            $vimeobuttontitle = $this->params->get("vimeobuttontitle");
            $vimeobuttontext = $this->params->get("vimeobuttontext");

            $text = "
            (function(){
                var text = {
                    youtube: '<strong>". $youtubeheading . "</strong>" . $youtubetext . "<a class=\"video-link\" href=\"https://youtu.be/%id%\" rel=\"noopener\" target=\"_blank\" title=\"" . $youtubelinktitle . "\">". $youtubelinktext . " https://youtu.be/%id%</a><button title=\"" . $youtubebuttontitle . "\">" . $youtubebuttontext . "</button>',
                    vimeo: '<strong>" . $vimeoheading . "</strong>" . $vimeotext . "<a class=\"video-link\" href=\"https://vimeo.com/%id%\" rel=\"noopener\" target=\"_blank\" title=\"" . $vimeolinktitle . "\">" . $vimeolinktext . " https://vimeo.com/%id%</a><button title=\"" . $vimeobuttontitle . "\">" . $vimeobuttontext . "</button>'
                }

               twoclickprivacy(text);
            })();";
            
            $document->addScriptDeclaration($text);
            $document->addScript(Juri::base() . 'media/plg_twoclickprivacy/js/script.js');

            $fontcolor = $this->params->get("fontcolor", "#333");
            $bordercolor = $this->params->get("bordercolor", "#ccc");
            $backgroundcolor = $this->params->get("backgroundcolor", "#eee");

            $buttoncolor = $this->params->get("buttoncolor", "#eee");
            $buttoncolorhover = $this->params->get("buttoncolorhover", "#444");
            $buttoncolorbackground = $this->params->get("buttoncolorbackground", "#666");

            $color_override = "
            :root{
                --twoclickprivacy-font-color: " . $fontcolor . ";
                --twoclickprivacy-border-color: " . $bordercolor . ";
                --twoclickprivacy-background-color: " . $backgroundcolor . ";
                
                --twoclickprivacy-button-color: " . $buttoncolor .";
                --twoclickprivacy-button-color-hover: " . $buttoncolorhover . ";
                --twoclickprivacy-button-background-color: " . $buttoncolorbackground . ";
            }";

            $document->addStyleDeclaration($color_override);
            $document->addStyleSheet(Juri::base() . 'media/plg_twoclickprivacy/css/styles.css');
        }
    }
}