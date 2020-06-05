<?php

namespace App\Models\EmailTemplates\Traits\Attribute;

/**
 * Class EmailTemplateAttribute.
 */
trait EmailTemplateAttribute {
	/**
	 * @return string
	 */
	public function getActionButtonsAttribute() {
		return '<div class="btn-group action-btn">'
		.$this->getEditButtonAttribute('edit-email-template', 'admin.emailtemplates.edit').
		$this->getDeleteButtonAttribute('delete-email-template', 'admin.emailtemplates.destroy').
		'</div>';
	}

	/**
	 * @return string
	 */
	public function getStatusLabelAttribute() {
		if ($this->isActive()) {
			return "<span class='badge badge-success'>".trans('global.email_template.active').'</span>';
		}

		return "<span class='badge badge-danger'>".trans('global.email_template.inactive').'</span>';
	}

	/**
	 * @return bool
	 */
	public function isActive() {
		return $this->status == 1;
	}
}
