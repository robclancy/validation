<?php namespace Robbo\Validation\Built;

use Illuminate\Database\Eloquent\Model;
use Robbo\Validation\Illuminate as Validate;

class Eloquent extends Model {
	
	use Validate;
	
	public function save(array $options = [])
	{
		if ( ! $this->validate($this->attributes))
		{
			return false;
		}
		
		$this->attributes = $this->getValidatedInput();
		
		return parent::save();
	}
}