<?php

class UserController extends \BaseController {





	public function create(){

		return View::make('user.create')->with('title','Register');
	}





	public function store(){
		$rules =[
			'email'                 => 'required|email|unique:users',
			'password'              => 'required|confirmed',
			'password_confirmation' => 'required',
			'user_name'             =>'required|unique:users'
		];

		$data = Input::all();

		$validation = Validator::make($data,$rules);

		if($validation->fails()){
			return Redirect::back()->withErrors($validation)->withInput(Input::except('password', 'password_confirmation'));
		}else{

			$confirmation_code = str_random(30);

			$user = new User();

			$user->email = $data['email'];
			$user->user_name = $data['user_name'];
			$user->password = Hash::make($data['password']);

			if($user->save()){

				$role = Role::find(2);
				$user->attachRole($role);

				$user_info = new UserInfo();

				$user_info->user_id = $user->id;
				$user_info->activation = false;
				$user_info->activation_key = $confirmation_code;
				//set a default avatar
				$user_info->icon_url = 'uploads/image/defaultAvatar.png';
				$user_info->avatar_url = 'uploads/image/defaultAvatar.png';

				if($user_info->save()){
					//send a activation mail
					//genrate a activation key

					Mail::send('user.activation', ['confirmation_code'=>$confirmation_code],
						function($message) {
							$message->to(Input::get('email'))
								->subject('Verify your email address');
						});

					return Redirect::route('login')->with('success',"Your Account Created Successfully. We sent a Mail to your Email Address.Please verify your Email for login.");
				}else{
					return Redirect::back()->withInput()->withErrors($validation);
				}

			}else{
				return Redirect::back()->withInput()->withErrors($validation);
			}
		}
	}







	public function show(){
		return View::make('user.show')->with(['title'=>'Profile']);
	}






	public function edit(){
		$users = Auth::user()->userInfo;
		return View::make('user.edit')->with('title','Update Profile')
			->with('users',$users);
	}







	public function update(){
		$rules =[
			'fullName'=>'required'
		];

		$data = Input::all();

		$validation = Validator::make($data,$rules);

		if($validation->fails()){
			return Redirect::back()->withErrors($validation)
				->withInput();
		}else{
			$userInfo = UserInfo::where('id',$data['id'])
				->update(array(
					'fullName' => $data['fullName'],
					'address' => $data['address'],
					'company' => $data['company'],
					'contact' => $data['contact']
				));

			if($userInfo){
				return Redirect::route('user.show')->with('success','profile updated successfully');
			}else{
				return Redirect::back()->withInput()->withErrors($validation);
			}
		}
	}







	public function uploadAvatarForm(){
		return View::make('user.avatar')->with(['title'=>'Avatar']);
	}



	public function uploadAvatar(){
		//add two extra fields to userinfo table
		//icon path & avatar path

		$rules = array(
			'image' => 'required|image|max:5000'
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::route('upload.avatar')
				->withErrors($validator) // send back all errors to the login form
				->withInput(); // send back the input (not the password) so that we can repopulate the form
		} else {

			if (Input::hasFile('image'))
			{
				$image = Input::file('image');

				//deleting previous file
				$prev_avatar_url = Auth::user()->userInfo->avatar_url;
				if($prev_avatar_url != 'uploads/image/defaultAvatar.png'){
					if (File::exists($prev_avatar_url)) {
						File::delete($prev_avatar_url);
					}
					$prev_icon_url = Auth::user()->userInfo->icon_url;
					if (File::exists($prev_icon_url)) {
						File::delete($prev_icon_url);
					}
				}

				$avatar_url = 'uploads/image/avatar/avatar-'.Auth::user()->id.'.jpg';
				$icon_url = 'uploads/image/icon/icon-'.Auth::user()->id.'.jpg';

				Image::make($image)->resize(200, 200)->save(public_path($avatar_url));
				Image::make($image)->resize(50, 50)->save(public_path($icon_url));

				$imageInfo = UserInfo::where('user_id',Auth::user()->id)
					->update(array(
						'avatar_url' => $avatar_url,
						'icon_url' => $icon_url
					));

				if($imageInfo){
					return Redirect::route('profile')->with('success','avatar updated successfully');
				}else{
					return Redirect::back()->withInput()->withErrors($validator);
				}

			}else{

				return Redirect::route('upload.avatar')->with(['error'=>'image could not be uploaded']);
			}

		}

	}



}