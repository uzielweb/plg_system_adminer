<?php
/**
 * @author     mediahof, Kiel-Germany
 * @link       http://www.mediahof.de
 * @copyright  Copyright (C) 2013 - 2014 mediahof. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

define('_JEXEC', 1);

define('DS', DIRECTORY_SEPARATOR);

define('JPATH_BASE', dirname(__FILE__) . '/../../');

require_once JPATH_BASE . '/includes/defines.php';

require_once JPATH_BASE . '/includes/framework.php';

JFactory::getApplication('administrator');

if (!JFactory::getUser()->authorise('core.admin'))
{
    exit;
}

function adminer_object()
{
    JLoader::import('joomla.filesystem.folder');

    $files = JFolder::files(dirname(__FILE__) . '/plugins/');

    $plugins = array();
    foreach ($files as $file)
    {
        include_once dirname(__FILE__) . DS . 'plugins' . DS . $file;
    }

    return new AdminerPlugin($plugins);
}

include_once dirname(__FILE__) . '/adminer.php';