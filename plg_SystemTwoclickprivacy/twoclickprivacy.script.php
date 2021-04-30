<?php
/**
 * @package    TWOCLICKPRIVACY
 *
 * @author     Lukas Schneider
 * @license    GNU General Public License v3.0
 */

defined('_JEXEC') or die;

class plgSystemTwoclickprivacyInstallerScript
{
    public function install(JAdapterInstance $adapter) {
        $db=Jfactory::getDbo();
        $query="update #__extensions set params='' where element='twoclickprivacy' limit 1";
        $db->setQuery($query);
        $db->query();
    } 
}