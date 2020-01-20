<?php

class Validator
{
	protected $di;

	protected $rules = ['required', 'minlength', 'maxlength', 'unique', 'email','phone'];

	protected $messages = [
		'required' => 'The :field field is required',
		'minlength' => 'The :field field must be a minimum of :satisfier character',
		'maxlength' => 'The :field field must be a maximum of :satisfier character',
		'email' => 'That is not a valid email address',
		'unique' => 'That :field is already taken',
		'phone' => 'That is not a valid phone number'

	];

	public function __construct($di){
		$this->di = $di;
	}

	public function check($items, $rules)
	{
		foreach($items as $item => $value)
		{
			if(in_array($item, array_keys($rules)))
			{
				$this->validate([
					'field' => $item,
					'value' => $value,
					'rules' => $rules[$item]
				]);
			}
		}

		return $this;
	}

	public function fails()
	{
		return $this->di->get("ErrorHandler")->hasErrors();
	}

	public function errors()
	{
		return $this->di->get("ErrorHandler");
	}

	protected function validate($item)
	{
		$field = $item['field'];

		foreach($item['rules'] as $rule => $satisfier)
		{
			if(in_array($rule, $this->rules))
			{
				if(!call_user_func_array([$this, $rule], [$field, $item['value'], $satisfier]))
				{
					$this->di->get("ErrorHandler")->addError(
						str_replace([':field', ':satisfier'], [$field, $satisfier], $this->messages[$rule]),
						$field
					);
				}
			}
		}
	}

	protected function required($field, $value, $satisfier)
	{
		return !empty(trim($value));
	}

	protected function minlength($field, $value, $satisfier)
	{
		return mb_strlen($value) >= $satisfier;
	}

	protected function maxlength($field, $value, $satisfier)
	{
		return mb_strlen($value) <= $satisfier;
	}

	protected function email($field, $value, $satisfier)
	{
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	protected function phone($field, $value, $satisfier)
	{
		return strlen(preg_replace('/[^0-9]/', '', $value)) == 10; 
	}

	protected function unique($field, $value, $satisfier)
	{
		return !$this->di->get("Database")->exists($satisfier, [
			$field => $value
		]);
	}
}