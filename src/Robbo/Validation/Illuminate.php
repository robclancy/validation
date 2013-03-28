<?php namespace Robbo\Validation;

use App;
use Robbo\ValidationRules\Builder\Illuminate as Builder;

trait Illuminate {
	
	use Validate;
	
	protected function setupValidation()
	{
		// We use use the global App object here which feels wrong but oh well will work for 99% of users
		$this->setInputFactory(new InputFactory(new Builder));
		$this->setValidator(new Validator\Illuminate(App::make('validator')));
	}
}