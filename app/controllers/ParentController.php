<?php

class ParentController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$students = ClassRoom::getClassWiseStudents();
		$relations = Config::get('sitevars.relation_ship');
		$response = array (
			'students' => $students,
			'relations' => $relations
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
		$validator = Validator::make(Input::all(), Parents::rules(), Parents::messages());

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
			//$user->parent()->associate($parent);
			$user->save();
			$parent = new Parents;
			$parent->fname = ucfirst(Input::get('fname'));
			$parent->lname = ucfirst(Input::get('lname'));
			$parent->mobile = Input::get('mobile');
			$parent->relation = Input::get('relation');
			$parent->student_id = Input::get('student_id');
			$parent->user_id = $user->id;
			$parent->save();
			$response  = array('success' => true, 'error_code' => 0, 'message' => 'Parent added successfully');
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
		$parent = Parents::find($id);
		$parentDetails = $parent->toSoA();
		$response = array ('parent' => $parentDetails, 'success' => true);

		return Response::json($response);
	}

	public function listView()
	{
		$parents = Parents::getParentsList();
		return Response::json(array('parents' =>$parents));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$students = ClassRoom::getClassWiseStudents();
		$relations = Config::get('sitevars.relation_ship');
		
		$parent = Parents::find($id);
		$parent['email'] = $parent->user()->first()->email;
		$response = array (
			'students' => $students,
			'relations' => $relations,
			'parent' => $parent
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
		$parent = Parents::find($id);			
		$validator = Validator::make(Input::all(), Parents::rules($parent->id, $parent->user_id), Parents::messages());

		if ($validator->fails()) {
			$errorMsg = '';
			$messages = $validator->messages();
			foreach ($messages->all() as $message) {
				$errorMsg = $message;
				break;
			}
			$response  = array('success' => false, 'error_code' => 1, 'message' => $errorMsg);		
		} else {
			$parent->fname = ucfirst(Input::get('fname'));
			$parent->lname = ucfirst(Input::get('lname'));
			$parent->mobile = Input::get('mobile');
			$parent->relation = Input::get('relation');
			$parent->student_id = Input::get('student_id');
			$parent->user()->update(array('email' => Input::get('email')));

			/*$u = $parent->user()->first();
			$u->email = Input::get('email');
			*/
			$parent->save();
			$response  = array('success' => true, 'error_code' => 0, 'message' => 'Parent updated successfully');
		}

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
