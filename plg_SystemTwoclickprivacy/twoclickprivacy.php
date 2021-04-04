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