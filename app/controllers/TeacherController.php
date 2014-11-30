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
		$validator = Validator::make(Input::all(), Teacher::rules());

		if ($validator->fails()) {
			$errorMsg = '';
			$messages = $validator->messages();
			foreach ($messages->all() as $message) {
				$errorMsg = $message;
				break;
			}
			$response  = array('success' => false, 'error_code' => 1, 'message' => $errorMsg);		
		} else {
			
			$user = new User;
			$user->email = Input::get('email');
			$user->password = Hash::make('testpassword');
			//$user->teacher()->associate($teacher);
			$user->save();
			$teacher = new Teacher;
			$teacher->fname = ucfirst(Input::get('fname'));
			$teacher->lname = ucfirst(Input::get('lname'));
			$teacher->gender = Input::get('gender');
			$teacher->dob = date('Y-m-d', strtotime(Input::get('dob')));
			$teacher->mobile = Input::get('mobile');
			$teacher->doj = date('Y-m-d', strtotime(Input::get('doj')));
			$teacher->subject = Input::get('subject');
			$teacher->qualification = Input::get('qualification');
			$teacher->experience = Input::get('experience');
			$teacher->marital_status = Input::get('marital_status');
			$teacher->blood_group = Input::get('blood_group');
			$teacher->user_id = $user->id;
			$teacher->save();

			$response  = array('success' => true, 'error_code' => 0, 'message' => 'Teacher added successfully');

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

	public function listView()
	{
		$teachers = Teacher::getTeacherList();
		
		return Response::json($teachers);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$gender = Config::get('sitevars.gender');
		$maritalStatus = Config::get('sitevars.marital_status');
		$bloodGroup = Config::get('sitevars.blood_groups');
		$subjects = Subject::getSubjectList();
		$teacher = Teacher::find($id);
		$teacher['email'] = $teacher->user()->first()->email;
		$response = array (
			'genders' => $gender,
			'subjects' => $subjects,
			'marital_status' => $maritalStatus,
			'blood_groups' => $bloodGroup,
			'teacher' => $teacher
		);

		return Response::json($response);		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$response  = array('success' => true, 'error_code' => 0, 'message' => '');	
		$teacher = Teacher::find($id);			
		$validator = Validator::make(Input::all(), Teacher::rules($teacher->id, $teacher->user_id));

		if ($validator->fails()) {
			$errorMsg = '';
			$messages = $validator->messages();
			foreach ($messages->all() as $message) {
				$errorMsg = $message;
				break;
			}
			$response  = array('success' => false, 'error_code' => 1, 'message' => $errorMsg);		
		} else {
			$teacher->fname = ucfirst(Input::get('fname'));
			$teacher->lname = ucfirst(Input::get('lname'));
			$teacher->gender = Input::get('gender');
			$teacher->dob = date('Y-m-d', strtotime(Input::get('dob')));
			$teacher->mobile = Input::get('mobile');
			$teacher->doj = date('Y-m-d', strtotime(Input::get('doj')));
			$teacher->subject = Input::get('subject');
			$teacher->qualification = Input::get('qualification');
			$teacher->experience = Input::get('experience');
			$teacher->marital_status = Input::get('marital_status');
			$teacher->blood_group = Input::get('blood_group');
			$teacher->user()->update(array('email' => Input::get('email')));
			/*$u = $teacher->user()->first();
			$u->email = Input::get('email');
			*/
			$teacher->save();
			$response  = array('success' => true, 'error_code' => 0, 'message' => 'Teacher updated successfully');
		}

		return Response::json($response);
	}

	public function details($id)
	{
		$gender = Config::get('sitevars.gender');
		$maritalStatus = Config::get('sitevars.marital_status');
		$bloodGroup = Config::get('sitevars.blood_groups');
		$teacher = Teacher::find($id);
		$teacher->gender = $gender[$teacher->gender];
		$teacher->email = $teacher->user()->first()->email;
		$teacher->subject = ucfirst($teacher->subject()->first()->subject_name);
		$teacher->marital_status = isset($teacher->marital_status) ? $maritalStatus[$teacher->marital_status] : '-';
		$teacher->blood_group = isset($teacher->blood_group) ? $bloodGroup[$teacher->blood_group] : '-';
		$response = array ('teacher' => $teacher, 'success' => true);

		return Response::json($response);		
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
