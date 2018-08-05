<?php
/**
 * @author     mediahof, Kiel-Germany
 * @link       http://www.mediahof.de
 * @copyright  Copyright (c) 2013 - 2015 mediahof. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

class AdminerJoomla
{

    var $sameOrigin;

    function __construct()
    {
        $config = JFactory::getConfig();
        $_SESSION['pwds']['server'][$config->get('host')][$config->get('user')] = $config->get('password');
        $_SESSION['db']['server'][$config->get('host')][$config->get('user')][$config->get('db')] = true;

        $_GET['server'] = $config->get('host');
        $_GET['username'] = $config->get('user');
        $_GET['db'] = $config->get('db');
    }

    function head()
    {
        echo '<style>p.logout{display:none;}</style>';
    }

    function credentials()
    {
        $config = JFactory::getConfig();
        return array($config->get('host'), $config->get('user'), $config->get('password'));
    }

    function database()
    {
        return JFactory::getConfig()->get('db');
    }

    function name()
    {
        $config = JFactory::getConfig();
        return '<a href="./loader.php?server=' . $config->get('host') . '&amp;username=' . $config->get('user') . '&amp;db=' . $config->get('db') . '" id="h1">Adminer</a>';
    }

    function AdminerFrames()
    {
        $this->sameOrigin = false;
    }

    function headers()
    {
        header("X-XSS-Protection: 0");
        return false;
    }

    function navigation()
    {
        echo '<script>verifyVersion = function(){};</script>';
    }
}

$plugins[] = new AdminerJoomla;