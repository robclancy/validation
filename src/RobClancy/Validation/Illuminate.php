<?php namespace RobClancy\Validation;

use App;
use RobClancy\ValidationRules\Builder\Illuminate as Builder;

trait Illuminate {
	
	use Validatable;
	
	protected function setupValidation()
	{
		// We use use the global App object here which feels wrong but oh well will work for 99% of users
		$this->setInputFactory(new Input\Factory(new Builder));
		$this->setValidator(new Validator\Illuminate(App::make('validator')));
	}
}