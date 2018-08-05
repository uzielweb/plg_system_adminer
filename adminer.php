<?php
/**
 * @author     mediahof, Kiel-Germany
 * @link       http://www.mediahof.de
 * @copyright  Copyright (c) 2013 - 2015 mediahof. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;

class plgSystemAdminer extends JPlugin
{
    private $layout = array(
        'width'  => '100%',
        'height' => '500',
        'style'  => 'border: 0;',
        'onload' => 'this.height=this.contentWindow.document.body.scrollHeight'
    );

    private $styles = array(
        '.icon-48-database{background-image:url(../media/adminer/adminer.png);}',
        '#toolbar{display:none;}'
    );

    public function onBeforeRender()
    {
        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();

        if ($app->isSite())
        {
            return;
        }

        if ($app->input->get('adminer') && $app->input->get('option') == 'com_admin' && $app->input->get('view') == 'sysinfo')
        {
            JToolbarHelper::title(JText::_('Adminer'), 'database');

            $doc->setBuffer('', 'modules', 'submenu');

            $doc->addStyleDeclaration(implode($this->styles));

            $iframe = JHtml::_('iframe', JUri::root(true) . '/media/adminer/loader.php', 'adminer', $this->layout);

            $doc->setBuffer($iframe, 'component');
        }
    }

    public function onGetIcons()
    {
        return array(
            array(
                'link'   => 'index.php?option=com_admin&view=sysinfo&adminer=true',
                'image'  => (version_compare(JVERSION, '3', '>=') ? 'database' : JUri::root() . 'media/adminer/adminer.png'),
                'text'   => JText::_('Adminer'),
                'id'     => 'plg_system_adminer',
                'access' => array(
                    'core.manage',
                    'com_config',
                    'core.admin',
                    'com_config'
                ),
                'group'  => 'MOD_QUICKICON_MAINTENANCE'
            )
        );
    }
}