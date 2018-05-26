<?php

/**
 * The home manager controller for modretailcrm.
 *
 */
class modretailcrmHomeManagerController extends modretailcrmMainController
{
    /* @var modretailcrm $modretailcrm */
    public $modretailcrm;


    /**
     * @param array $scriptProperties
     */
    public function process(array $scriptProperties = array())
    {
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('modretailcrm');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->modretailcrm->config['cssUrl'] . 'mgr/main.css');
        $this->addCss($this->modretailcrm->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        $this->addJavascript($this->modretailcrm->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->modretailcrm->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->modretailcrm->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->modretailcrm->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->modretailcrm->config['jsUrl'] . 'mgr/sections/home.js');
        $this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "modretailcrm-page-home"});
		});
		</script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->modretailcrm->config['templatesPath'] . 'home.tpl';
    }
}