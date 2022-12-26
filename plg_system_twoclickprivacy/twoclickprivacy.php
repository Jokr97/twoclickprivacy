<?php
/**
 * @package    TWOCLICKPRIVACY
 *
 * @author     Lukas Schneider
 * @license    GNU General Public License v3.0
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
        $language = JFactory::getLanguage()->load('plg_system_plg_systemtwoclickprivacy', JPATH_ADMINISTRATOR);

        if ($app->isClient('site')){
            $youtubeheading = $this->params->get("youtubeheading") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_YOUTUBEHEADING_DEFAULT');
            $youtubetext = $this->params->get("youtubetext") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_YOUTUBETEXT_DEFAULT');
            $youtubetext = str_replace(array("\r\n", "\r", "\n", "\t"), '', $youtubetext);
            $youtubelinktitle = $this->params->get("youtubelinktitle") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_YOUTUBELINKTITLE_DEFAULT');
            $youtubelinktext = $this->params->get("youtubelinktext") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_YOUTUBELINKTEXT_DEFAULT');
            $youtubebuttontitle = $this->params->get("youtubebuttontitle") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_YOUTUBEBUTTONTITLE_DEFAULT');
            $youtubebuttontext = $this->params->get("youtubebuttontext") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_YOUTUBEBUTTONTEXT_DEFAULT');

            $vimeoheading = $this->params->get("vimeoheading") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_VIMEOHEADING_DEFAULT');
            $vimeotext = $this->params->get("vimeotext") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_VIMEOTEXT_DEFAULT');
            $vimeotext = str_replace(array("\r\n", "\r", "\n", "\t"), '', $vimeotext);
            $vimeolinktitle = $this->params->get("vimeolinktitle") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_VIMEOLINKTITLE_DEFAULT');
            $vimeolinktext = $this->params->get("vimeolinktext") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_VIMEOLINKTEXT_DEFAULT');
            $vimeobuttontitle = $this->params->get("vimeobuttontitle") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_VIMEOBUTTONTITLE_DEFAULT');
            $vimeobuttontext = $this->params->get("vimeobuttontext") ?? JText::_('PLG_SYSTEM_TWOCLICKPRIVACY_VIMEOBUTTONTEXT_DEFAULT');

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