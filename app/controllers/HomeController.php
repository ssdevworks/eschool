<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	
	public function doLogin()
	{
		$response  = array('success' => true, 'error_code' => 0, 'message' => '');		
		// validate the info, create rules for the inputs
		$rules = array(
			'email'    => 'required|email', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			$response  = array('success' => false, 'error_code' => 1, 'message' => "Form fields are invalid");		
		} else {

			// create our user data for the authentication
			$userdata = array(
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password')
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) {
			$userName = Auth::user()->username;
			$response  = array('success' => true, 'error_code' => 0, 'message' => "User authentication successful",'user_name' =>$userName);

			} else {	 	
				$response  = array('success' => false,'error_code' => 2, 'message' => "User authentication failed");

			}

		}
		return Response::json($response);
	}

}
