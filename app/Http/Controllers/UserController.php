<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;
use App\Models\User;
use App\Models\UserInput;
use DataTables;

class UserController extends Controller
{
    // login
    public function login(Request $request){

    	if ($request->isMethod('post')) {
    		$data = $request->all();

			// validaion
			$rules = [
				'email' => 'required|email',
				'password' => 'required',
			];

			$customMessages = [
				'email.required' => 'Email Address must not be empty!',
				'email.email' => 'Invalid Email Address.',
				'password.required' => 'Password must not be empty!',
			];

			$this->validate($request, $rules, $customMessages);
			
			// login check
            $userdata = array(
                'email'     => $data['email'],
                'password'  => $data['password']
            );

    		if (Auth::attempt($userdata)) {
                if(Auth::check()){
                    Session::put('userId', Auth::user()->id);
                    Session::put('userName', Auth::user()->name);
                }
                return redirect('/');
            } else {
                return redirect()->back()->with('error_message', 'Invalid Credentials!');
            }
    	}


        if (Session::get('userId')) {
            return redirect('/');
        } else{
            return view('layouts.login');
        }
    }

    // registration
    public function register(Request $request){

        if ($request->isMethod('post')) {
            $data = $request->all();

            // validaion
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'mobile' => 'required',
                'password' => 'required',
            ];

            $customMessages = [
                'name.required' => 'Name field must not be empty',
                'email.required' => 'Email Address must not be empty!',
                'email.email' => 'Invalid Email Address.',
                'mobile.required' => 'Mobile field must not be empty',
                'password.required' => 'Password must not be empty!',
            ];

            $this->validate($request, $rules, $customMessages);

            // save user
            $userCount = User::where('email' , $data['email'])->count();
            if ($userCount > 0) {
               return redirect()->back()->with('error_message', 'Email Already Exists.');
            } else {
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->mobile = $data['mobile'];
                $user->password = Hash::make($data['password']);
                $user->save();

                $userId = $user->id;
                $userName = $user->name;
                Session::put('userId', $userId);
                Session::put('userName', $userName);

                return redirect('/');
            }
        }

        if (Session::get('userId')) {
            return redirect('/');
        } else{
            return view('layouts.register');
        }
    }
    // dashboard
    public function dashboard(Request $request){

        if (Session::get('userId')) {
            return view('layouts.dashboard');
        } else{
            return redirect('login');
        }
    }

    // logout
    public function logout(){
        Session::forget('userId');
        Session::forget('userName');
        return redirect('login');
    }

    // search value
    public function searchValue(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            // get user input values string
            $values = $data['input_values'];
            // convert array
            $newValues = explode(',', $values);
            // sorting descending
            rsort($newValues);
            // convert array to string for save database
            $input_values = implode(',', $newValues);

            $user_input = new UserInput;
            // get current logged in user id
            $user_id = Session::get('userId');
            
            $user_input->user_id = $user_id;
            $user_input->input_values = $input_values;
            $user_input->save(); // save into database

            // get search value
            $search_value = $data['searchValue'];
            // find item in the array
            if (in_array($search_value, $newValues)){
                $result = "True";
            }else{
                $result = "False";
            }
            // return data
            return response()->json([
                'result' => $result
            ]);
        }
    }

    // get all users
    public function getAllUsers(Request $request){
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<button type="button" id="'.$row->id.'" class="edit btn btn-primary btn-sm" name="edit">Edit</button>';
                           $btn .= '&nbsp; <button type="button" id="'.$row->id.'" class="delete btn btn-danger btn-sm" name="delete">Delete</button>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('layouts.users'); 
    }

    // delete user
    public function deleteUser(Request $request){
        if($request->ajax()){
            $data = $request->all();

            User::where('id', $data['id'])->delete();
            return response()->json([
                'success' => 'User Data Deleted.',
            ]);
        }
    }
}
