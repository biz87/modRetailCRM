<?php
include_once dirname(__FILE__). '/ApiClient.php';
include_once dirname(__FILE__). '/Http/Client.php';

class ModRetailCrm extends ApiClient
{
	public $modx;

	protected $url;

	protected $apiKey;

	protected $siteCode;

	public function __construct(modX &$modx)
	{
		$this->modx =& $modx;
		$this->apiKey = $this->modx->getOption('modretailcrm_apiKey');
		$this->url = $this->modx->getOption('modretailcrm_urlCrm');
		$this->siteCode = $this->modx->getOption('modretailcrm_siteCode');
		parent::__construct($this->url, $this->apiKey, $this->siteCode);
	}
}