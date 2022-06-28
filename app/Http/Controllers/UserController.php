<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

  public function index()
  {

    $user = DB::table('users')
      ->orderBy("updated_at", 'Desc')
      ->get();

    return view('user.index', compact('user'));
  }




  public function store(Request $request)
  {
    $dist = $request['district'];
    $state = $request['state'];
    $pincode = $request['pincode'];
    $city = $request['city'];
    $address = $dist . "," . $state . "," . $city . "," . $pincode;

    $question = new User;
    $question->role_id = $request->get('role_id');
    $question->full_name = $request->get('full_name');
    $question->phone = $request->get('phone');
    $question->phone2 = $request->get('phone2');
    $question->address = $address;
    $question->father = $request->get('father');
    $question->degree = $request->get('degree');
    $question->password = Hash::make("DQM123");

    if ($request->file('proof1')) {

      $file = $request->file('proof1');
      $destinationPath = 'users_photo/';
      $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage1);
      $question['proof1'] = $profileImage1;
    }

    if ($request->file('proof2')) {

      $file = $request->file('proof2');
      $destinationPath = 'users_photo/';
      $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage1);
      $question['proof2'] = $profileImage1;
    }

    if($request->file('proof3')){
      $file = $request->file('proof3');
      $destinationPath = 'users_photo/';
      $profileImage2 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage2);
      $question['proof3'] = $profileImage2;
    }

    if ($request->file('proof4')) {

      $file = $request->file('proof4');
      $destinationPath = 'users_photo/';
      $profileImage3 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage3);
      $question['proof4'] = $profileImage3;
    }

    if ($request->file('proof5')) {

      $file = $request->file('proof5');
      $destinationPath = 'users_photo/';
      $profileImage4 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage4);
      $question['proof5'] = $profileImage4;
    }
    if ($request->file('proof6')) {

      $file = $request->file('proof6');
      $destinationPath = 'users_photo/';
      $profileImage5 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage5);
      $question['proof6'] = $profileImage5;
    }




    $question->save();

    return redirect()->route('user.index')
      ->with('success', 'student list created successfully.');
  }


  public function edit(user $user)
  {
    return view('user.edit', compact('user'));
  }


  public function update(Request $request, $id)
  {
    $question = User::find($id);
    $question->role_id = $request->get('role_id');
    $question->full_name = $request->get('full_name');
    $question->phone = $request->get('phone');
    $question->phone2 = $request->get('phone2');
    $question->address = $request->get('address');
    $question->father = $request->get('father');
    $question->degree = $request->get('degree');
    $question->password = $request->get('password');


    if ($request->file('proof1')) {

      $file = $request->file('proof1');
      $destinationPath = 'users_photo/';
      $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage1);
      $question['proof1'] = $profileImage1;
    }

    if ($request->file('proof2')) {

      $file = $request->file('proof2');
      $destinationPath = 'users_photo/';
      $profileImage1 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage1);
      $question['proof2'] = $profileImage1;
    }

    if ($request->file('proof3')) {

      $file = $request->file('proof3');
      $destinationPath = 'users_photo/';
      $profileImage2 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage2);
      $question['proof3'] = $profileImage2;
    }

    if ($request->file('proof4')) {

      $file = $request->file('proof4');
      $destinationPath = 'users_photo/';
      $profileImage3 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage3);
      $question['proof4'] = $profileImage3;
    }

    if ($request->file('proof5')) {

      $file = $request->file('proof5');
      $destinationPath = 'users_photo/';
      $profileImage4 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage4);
      $question['proof5'] = $profileImage4;
    }
    if ($request->file('proof6')) {

      $file = $request->file('proof6');
      $destinationPath = 'users_photo/';
      $profileImage5 = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $file->move($destinationPath, $profileImage5);
      $question['proof6'] = $profileImage5;
    }


    $question->save();
    return redirect()->route('user.index')
      ->with('success, Question updated successfully');
  }


  public function destroy(User $user)
  {

    $user->delete();
    return redirect()->route('user.index')
      ->with('success', 'student deleted successfull');
  }
}
