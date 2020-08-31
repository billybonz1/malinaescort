<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class SmsForm extends CFormModel
{
	public $text;
	public $id;
	public $phone;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('id, text, phone', 'required'),
			array('text', 'length', 'max'=>140),
			array('phone', 'length', 'max'=>14),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'text'=>L::t('SMS message text (140 chars max)'),
            'phone'=>L::t('Your cell phone'),
			'verifyCode'=>L::t('Verification Code'),
		);
	}
}