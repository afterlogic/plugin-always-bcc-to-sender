<?php

/* -AFTERLOGIC LICENSE HEADER- */

class_exists('CApi') or die();

class CAlwaysBccToSenderPlugin extends AApiPlugin
{

	/**
	 * @param CApiPluginManager $oPluginManager
	 */
	public function __construct(CApiPluginManager $oPluginManager)
	{
		parent::__construct('1.0', $oPluginManager);

		$this->AddHook('api-smtp-send-rcpt', 'ApiSmtpSendRcpt');
	}

	/**
	 * @param CAccount $oAccount
	 * @param array $aRcpt
	 */
	public function ApiSmtpSendRcpt($oAccount, &$aRcpt)
	{
		if ($oAccount && \is_array($aRcpt))
		{
			$aRcpt[] = \MailSo\Mime\Email::NewInstance(\trim($oAccount->Email));
		}
	}
}

return new CAlwaysBccToSenderPlugin($this);
