<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var modretailcrm $modretailcrm */
$modretailcrm = $modx->getService('modretailcrm', 'modretailcrm', $modx->getOption('modretailcrm_core_path', null,
        $modx->getOption('core_path') . 'components/modretailcrm/') . 'model/modretailcrm/');
$modx->lexicon->load('modretailcrm:default');

// handle request
$corePath = $modx->getOption('modretailcrm_core_path', null,
    $modx->getOption('core_path') . 'components/modretailcrm/');
$path = $modx->getOption('processorsPath', $modretailcrm->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location'        => '',
));