<?php

class StudentController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$gender = Config::get('sitevars.gender');
		$bloodGroup = Config::get('sitevars.blood_groups');
		$classRooms = ClassRoom::getClassRoomList();
		$response = array (
			'genders' => $gender,
			'blood_groups' => $bloodGroup,
			'class_rooms' => $classRooms
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
		$validator = Validator::make(Input::all(), Student::rules());

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
			//$user->student()->associate($student);
			$user->save();
			$student = new Student;
			$student->fname = ucfirst(Input::get('fname'));
			$student->lname = ucfirst(Input::get('lname'));
			$student->gender = Input::get('gender');
			$student->dob = date('Y-m-d', strtotime(Input::get('dob')));
			$student->mobile = Input::get('mobile');
			$student->doj = date('Y-m-d', strtotime(Input::get('doj')));			
			$student->native_place = ucfirst(Input::get('native_place'));
			$student->blood_group = Input::get('blood_group');
			$student->class_room_id = Input::get('class_room_id');
			$student->user_id = $user->id;
			$student->save();
			$response  = array('success' => true, 'error_code' => 0, 'message' => 'Student added successfully');
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
		
	}
    
    public function listView()
	{
		$students = Student::getStudentsList();
		$classRooms = ClassRoom::getClassRoomList();
		return Response::json(array('students' =>$students, 'filters' => $classRooms));
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
		$bloodGroup = Config::get('sitevars.blood_groups');
		$classRooms = ClassRoom::getClassRoomList();
		$student = Student::find($id);
		$student['email'] = $student->user()->first()->email;
		$response = array (
			'genders' => $gender,
			'blood_groups' => $bloodGroup,
			'class_rooms' => $classRooms,
			'student' => $student
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
		$student = Student::find($id);			
		$validator = Validator::make(Input::all(), Student::rules($student->id, $student->user_id));

		if ($validator->fails()) {
			$errorMsg = '';
			$messages = $validator->messages();
			foreach ($messages->all() as $message) {
				$errorMsg = $message;
				break;
			}
			$response  = array('success' => false, 'error_code' => 1, 'message' => $errorMsg);		
		} else {
			$student->fname = ucfirst(Input::get('fname'));
			$student->lname = ucfirst(Input::get('lname'));
			$student->gender = Input::get('gender');
			$student->dob = date('Y-m-d', strtotime(Input::get('dob')));
			$student->mobile = Input::get('mobile');
			$student->doj = date('Y-m-d', strtotime(Input::get('doj')));			
			$student->native_place = ucfirst(Input::get('native_place'));
			$student->blood_group = Input::get('blood_group');
			$student->class_room_id = Input::get('class_room_id');
			$student->user()->update(array('email' => Input::get('email')));
			/*$u = $student->user()->first();
			$u->email = Input::get('email');
			*/
			$student->save();
			$response  = array('success' => true, 'error_code' => 0, 'message' => 'Student updated successfully');
		}

		return Response::json($response);
	}

	public function details($id)
	{
		$gender = Config::get('sitevars.gender');
		$bloodGroup = Config::get('sitevars.blood_groups');
		$student = Student::find($id);
		$student->gender = $gender[$student->gender];
		$student->email = $student->user()->first()->email;
		$student->class_name = ucfirst($student->classRoom()->first()->class_name);
		$student->blood_group = isset($student->blood_group) ? $bloodGroup[$student->blood_group] : '-';
		$response = array ('student' => $student, 'success' => true);

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
