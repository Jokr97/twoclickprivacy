<?php
/**
 * @package    TWOCLICKPRIVACY
 *
 * @author     Lukas Schneider
 * @license    GNU General Public License v3.0
 */

defined('_JEXEC') or die;

class plgSystemPlg_SystemTwoclickprivacyInstallerScript
{
    public function install(JAdapterInstance $adapter) {
        $db=Jfactory::getDbo();
        $query="update #__extensions set params='' where element='plg_SystemTwoclickprivacy' limit 1";
        $db->setQuery($query);
        $db->query();
    } 
}