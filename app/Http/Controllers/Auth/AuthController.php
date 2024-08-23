<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Business;
use Illuminate\Support\Str;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Notifications\UpdateProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //

    public function register(Request $request){

        $data = $this->validate(request(),[
            'email' => 'required|email|unique:users',
            'password'=> 'required|confirmed',
            'firstname'=> 'required',
            'lastname'=> 'required',
        ]);
        $name = $data['firstname'] . ' ' .$data['lastname'];


        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'date_of_birth' => $request->date_of_birth,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'user_type' =>$request->user_type,
            'gender' =>$request->gender,
            'industry' => $request->industry,
            'country' => $request->country,
            'state' => $request->state,
            'name' => $name,
            'user_type' => 'user',
        ]);

        $user_type = $request->user_type;

        if($user_type == "business"){
          $newbusiness = new Business();
          $newbusiness->businessname = $request->businessname;
          $newbusiness->business_slug = Str::slug($request->businessname);
          $newbusiness->user_id = $user->id;
          $newbusiness->website = $request->website;
          $selectedBusinessTypes  = $request->input('business_type', []);
          $newbusiness->business_type = implode(', ', $selectedBusinessTypes);
          $newbusiness->specialization = $request->specialization;
          $newbusiness->contact_person = $request->contact_person;
          $newbusiness->description = $request->description;
          $newbusiness->save();
        } elseif($user_type == 'professional'){
            $newprof = new Professional();
            $newprof->user_id = $user->id;
            $selectedProfessionalTypes  = $request->input('professional_type', []);
            $newprof->professional_type = implode(', ', $selectedProfessionalTypes);
            $newprof->specialization = $request->specialization;
            $newprof->contact_person = $request->contact_person;
            $newprof->save();
        }

        auth()->login($user);
        return redirect('/dashboard');
    }    
    
    public function signin(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        $userinfo = User::where('email', $request->email)->first();
        if ($userinfo) {
            $passcheck = Hash::check($request->password, $userinfo->password);
            $logindata = $request->only(['email', 'password']);
            if($passcheck && auth()->attempt($logindata)){
                notify()->success('Login Successful');
                if ($userinfo->user_type === 'admin') {
                    return redirect('/admin');
                } else {
                    return redirect('/dashboard');
                }
                return redirect('/dashboard');
            }else{
                notify()->error('Wrong Password');
                return redirect()->back();
                dd('wrong password');
            }
        }else{
            notify()->error('User Not Found');
            return redirect()->back();
            // dd('user not found');

        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    // public function update(Request $request)
    // {
    //     $user = Auth::user();

    //     $data = $request->all(); 

    //     $user->update($data);

       
    //     $userType = $user->user_type;

    //     if ($userType == "business") {
    //         $business = $user->business ?? new Business();
    //         $business->user_id = $user->id;
    //         $user->name = $data['businessname'];
    //         $business->fill($data);
    //         $business->save();
    //     } elseif ($userType == 'professional') {
    //         $professional = $user->professional ?? new Professional();
    //         $professional->user_id = $user->id;           
    //         $user->name =  $request->firstname . ' ' .$request->lastname;
    //         $professional->fill($data);
    //         $professional->save();
    //     }
        
    //     $message = "You just updated your profile."; 
    //     $title = "Updated Profile"; 

    //     $user->notify(new UpdateProfile($message, $user->id, $title));
    //     notify()->success('Your Profile has been updated successfully');
    //     return redirect('/dashboard');
    // }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->all(); 

        $user->update($data);

        $userType = $user->user_type;

        if ($userType == "business") {
            $business = $user->business ?? new Business();
            $business->user_id = $user->id;
            $business->business_slug = Str::slug($data['businessname']);
            $business->fill($data);
            $business->save();
        } elseif ($userType == 'tutor') {
            $professional = $user->tutor ?? new Tutor();
            $professional->user_id = $user->id;
            $professional->fill($data);
            $professional->save();
        }

        if ($userType == 'business') {
            $user->name = $data['businessname'];
            $user->save();
        } elseif ($userType == 'tutor') {
            $user->name = $data['firstname'] . ' ' . $data['lastname'];
            $user->save();
        }
        
        $message = "You just updated your profile."; 
        $title = "Updated Profile"; 

        $user->notify(new UpdateProfile($message, $user->id, $title));
        notify()->success('Your Profile has been updated successfully');
        return redirect('/dashboard');
    }

}
