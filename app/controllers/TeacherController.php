<?php

class TeacherController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$gender = Config::get('sitevars.gender');
		$maritalStatus = Config::get('sitevars.marital_status');
		$bloodGroup = Config::get('sitevars.blood_groups');
		$subjects = Subject::getSubjectList();
		
		$response = array (
			'genders' => $gender,
			'subjects' => $subjects,
			'marital_status' => $maritalStatus,
			'blood_groups' => $bloodGroup,
		);

		return Response::json($response);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$response  = array('success' => true, 'error_code' => 0, 'message' => '');		
		$validator = Validator::make(Input::all(), Teacher::$rules);

		if ($validator->fails()) {
			$errorMsg = '';
			$messages = $validator->messages();
			foreach ($messages->all() as $message) {
				$errorMsg = $message;
				break;
			}
			$response  = array('success' => false, 'error_code' => 1, 'message' => $errorMsg);		
		} else {
			
			$teacher = new Teacher;
			$teacher->fname = Input::get('fname');
			$teacher->lname = Input::get('lname');
			$teacher->gender = Input::get('gender');
			$teacher->dob = Input::get('dob');
			$teacher->mobile = Input::get('mobile');
			$teacher->doj = Input::get('doj');
			$teacher->subject = Input::get('subject');
			$teacher->qualification = Input::get('qualification');
			$teacher->experience = Input::get('experience');
			$teacher->marital_status = Input::get('marital_status');
			$teacher->blood_group = Input::get('blood_group');

			$user = new User;
			$user->email = Input::get('email');
			$user->password = Hash::make('testpassword');
			$user->teacher()->associate($teacher);
			$user->save();
			$response  = array('success' => true, 'error_code' => 0, 'message' => 'success');

		}
		return Response::json($response);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}