<?php namespace App\Http\Controllers;


use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return "this is the index of the user";
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{


		return view('pages.register');
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

        $validator =  Validator::make($request->all(), [
				'name' => 'required|max:255',
				'email' => 'required|email|max:255|unique:users',
				'password' => 'required|confirmed|min:6',
				'contact' => 'required|unique:users',

		]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->withErrors($validator)
					->withInput();
		}

	    User::create([
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'contact' => $request->get('contact'),
				'password' => bcrypt($request->get('password'))
		]);


		return redirect()
				->back()
				->with('status', 'New contact successfully created');
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
		$user  = User::find($id);
		return view('pages.profile-edit', compact('user', $user));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id)
	{

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}

	public function deleteUser($id)
	{
		User::find($id)->delete();

		return redirect()
				->back()
				->with('status', 'Successfully deleted.');
	}

	public function getProfile()
	{
		$user  = User::find(Auth::user()->id);
		return view('pages.profile', compact('user', $user));
	}

	public function updateProfile(Request $request, $id=null)
	{

		if(!empty($id)) {
			$user = User::find($id);
		} else {
			$user = User::find(Auth::user()->id);
		}

		//dd($user);

		if(!empty($request->get('name')) and ($user->name != $request->get('name')))
		{
			$user->name = $request->get('name');
		} else if(!empty($request->get('email')) and ($user->email != $request->get('email')))
		{
			$user->email = $request->get('email');
		}else if(!empty($request->get('contact')) and ($user->contact != $request->get('contact')))
		{
			$user->contact = $request->get('contact');
		}

		$validator =  Validator::make($request->all(), [
					'name'=>'max:255|unique:users',
					'email'=>'email|max:255|unique:users',
					'contact'=>'unique:users'
		]);

		if ($validator->fails()) {
			return redirect()
					->back()
					->withErrors($validator, 'profile')
					->withInput();
		}

		$user->save();

		return redirect()
				->back()
				->with('statusProfile', 'Profile successfully updated.');
	}

	public function updatePassword(Request $request, $id=null)
	{
		if(!empty($id)) {
			$user = User::find($id);
		} else {
			$user = User::find(Auth::user()->id);
		}
		$email = $user->email;


		$validator =  Validator::make($request->all(), [
				'password' => 'required|confirmed|min:6'
		]);

		$error = false;
		if ($validator->fails())
		{
			$error = true;
		} else {

			if(empty($id)) {
				if (!Auth::validate(['password' => $request->get('old_password'), 'email' => $email])) {
					$validator->errors()->add('old_password', 'Your old password is not correct.');
					$error = true;
				}
			}
		}

		if($error == true) {
			return redirect()
					->back()
					->withErrors($validator, 'password')
					->withInput();
		}


		$user->password = bcrypt($request->get('password'));

		$user->save();

		return redirect()
				->back()
				->with('statusAccount', 'Account successfully updated.');

	}

	public function updateUser(Requests\UserRequest $request, $id)
	{
		print "update user";
	}

	public function getContact()
	{
		$users = User::Where('id', '<>' ,Auth::user()->id)->paginate(12);

		$users->setPath(route('user.contact'));

		return view('pages.contact', compact('users', $users));
	}
}
