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
            $file1 = $request->file('proof1');
            $destinationPath1 = 'users_photo/';
            $profileImage1 = date('YmdHis') . "." . $file1->getClientOriginalExtension();
            $file1->move($destinationPath1, $profileImage1);
            $question['proof1'] = $profileImage1;
        }

        if ($request->file('proof2')) {

            $file2 = $request->file('proof2');
            $destinationPath2 = 'users_photo/';
            $profileImage2 = date('YmdHis') . "." . $file2->getClientOriginalExtension();
            $file2->move($destinationPath2, $profileImage2);
            $question['proof2'] = $profileImage2;
        }

        if ($request->file('proof3')) {
            $file3 = $request->file('proof3');
            $destinationPath3 = 'users_photo/';
            $profileImage3 = date('YmdHis') . "." . $file3->getClientOriginalExtension();
            $file3->move($destinationPath3, $profileImage3);
            $question['proof3'] = $profileImage3;
        }

        if ($request->file('proof4')) {

            $file4 = $request->file('proof4');
            $destinationPath4 = 'users_photo/';
            $profileImage4 = date('YmdHis') . "." . $file4->getClientOriginalExtension();
            $file4->move($destinationPath4, $profileImage4);
            $question['proof4'] = $profileImage4;
        }

        if ($request->file('proof5')) {

            $file5 = $request->file('proof5');
            $destinationPath5 = 'users_photo/';
            $profileImage5 = date('YmdHis') . "." . $file5->getClientOriginalExtension();
            $file5->move($destinationPath5, $profileImage5);
            $question['proof5'] = $profileImage5;
        }
        if ($request->file('proof6')) {

            $file6 = $request->file('proof6');
            $destinationPath6 = 'users_photo/';
            $profileImage6 = date('YmdHis') . "." . $file6->getClientOriginalExtension();
            $file6->move($destinationPath6, $profileImage6);
            $question['proof6'] = $profileImage6;
        }




        $question->save();

        return redirect()->route('user.index')
            ->with('success', 'Teacher created successfully.');
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
            $file1 = $request->file('proof1');
            $destinationPath1 = 'users_photo/';
            $profileImage1 = date('YmdHis') . "." . $file1->getClientOriginalExtension();
            $file1->move($destinationPath1, $profileImage1);
            $question['proof1'] = $profileImage1;
        }

        if ($request->file('proof2')) {

            $file2 = $request->file('proof2');
            $destinationPath2 = 'users_photo/';
            $profileImage2 = date('YmdHis') . "." . $file2->getClientOriginalExtension();
            $file2->move($destinationPath2, $profileImage2);
            $question['proof2'] = $profileImage2;
        }

        if ($request->file('proof3')) {
            $file3 = $request->file('proof3');
            $destinationPath3 = 'users_photo/';
            $profileImage3 = date('YmdHis') . "." . $file3->getClientOriginalExtension();
            $file3->move($destinationPath3, $profileImage3);
            $question['proof3'] = $profileImage3;
        }

        if ($request->file('proof4')) {
            $file4 = $request->file('proof4');
            $destinationPath4 = 'users_photo/';
            $profileImage4 = date('YmdHis') . "." . $file4->getClientOriginalExtension();
            $file4->move($destinationPath4, $profileImage4);
            $question['proof4'] = $profileImage4;
        }

        if ($request->file('proof5')) {
            $file5 = $request->file('proof5');
            $destinationPath5 = 'users_photo/';
            $profileImage5 = date('YmdHis') . "." . $file5->getClientOriginalExtension();
            $file5->move($destinationPath5, $profileImage5);
            $question['proof5'] = $profileImage5;
        }
        if ($request->file('proof6')) {
            $file6 = $request->file('proof6');
            $destinationPath6 = 'users_photo/';
            $profileImage6 = date('YmdHis') . "." . $file6->getClientOriginalExtension();
            $file6->move($destinationPath6, $profileImage6);
            $question['proof6'] = $profileImage6;
        }


        $question->save();
        return redirect()->route('user.index')
            ->with('success, Teacher updated successfully');
    }


    public function destroy(User $user)
    {

        $user->delete();
        return redirect()->route('user.index')
            ->with('success', 'Teacher deleted successfull');
    }
}
