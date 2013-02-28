<?php

/**
 * @file controllers/tab/settings/submissions/form/SubmissionsForm.inc.php
 *
 * Copyright (c) 2003-2013 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class JournalSetupStep2Form
 * @ingroup manager_form_setup
 *
 * @brief Form for Step 2 of journal setup.
 */

import('lib.pkp.classes.controllers.tab.settings.form.ContextSettingsForm');

class SubmissionsForm extends ContextSettingsForm {
	/**
	 * Constructor.
	 */
	function SubmissionsForm($wizardMode = false) {
		$settings = array(
			'restrictReviewerFileAccess' => 'bool',
			'reviewerAccessKeysEnabled' => 'bool',
			'mailSubmissionsToReviewers' => 'bool',
			'authorSelectsEditor' => 'bool',
			'notifyAllAuthorsOnDecision' => 'bool'
		);
		parent::ContextSettingsForm($settings, 'controllers/tab/settings/submissions/form/submissionsForm.tpl', $wizardMode);

		$this->addCheck(new FormValidatorEmail($this, 'envelopeSender', 'optional', 'user.profile.form.emailRequired'));
	}

	/**
	 * Display the form.
	 */
	function fetch($request) {
		$templateMgr = TemplateManager::getManager($request);
		if (Config::getVar('general', 'scheduled_tasks')) {
			$templateMgr->assign('scheduledTasksEnabled', true);
		}

		return parent::fetch($request);
	}
}

?>
