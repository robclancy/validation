validation
================

This isn't ready for use.





The following is a dump to explain things for feedback.


First we have an alias, `Validatable` will alias `RobClancy\Validation\Illuminate`.

To use this for model validation you would do...

```php
// Note most of this would be in a base class
class Post extends Eloquent {
	
	// We import the validator methods
	use Validatable;
	
	// Define the input and rules to validate, basic post validation
	public function defineInput()
	{
		$this->input('user_id')->required()->integer();
		$this->input('post')->required();
	}
	
	// Then we have our save method
	public function save()
	{
		if ( ! $this->validate($this->attributes))
		{
			return false;
			// User can now call $this->getErrors() for a list of errors
		}
		
		// Doing this means we can push Input::all() into the model and the validator will filter out what we need
		$this->attributes = $this->getValidatedInput();
		
		return parent::save();
	}
}```

Then I had a use case for logging in, didn't want to validate input before sending to authentication on a model so can do this instead...
```php
class LoginController extends Controller {

	use Validatable;

	// getLogin method etc here

	// Define the input to validate against
	public function defineInput()
	{
		$this->input('email')->required()->email();
		$this->input('password')->required();
	}

	// And once again use the new methods here
	public function postIndex()
	{
		if ( ! $this->validate())
		{
			return Redirect::back()->withErrors($this->getErrors());
		}
		
		// run authentication
	}
}```