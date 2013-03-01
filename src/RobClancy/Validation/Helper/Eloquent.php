<?php namespace RobClancy\Validation\Helper;

use Illuminate\Database\Eloquent\Model;
use RobClancy\Validation\Illuminate as Validatable;

class Eloquent extends Model {
	
	use Validatable;
	
	public function save()
	{
		if ( ! $this->validate($this->attributes))
		{
			return false;
		}
		
		$this->attributes = $this->getValidatedInput();
		
		return parent::save();
	}
}