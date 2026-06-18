<?php



namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //// shoe registration form
    public function ShowRegisterForm(){
        return view('auth.register');
    }

    //// handle registration request for a new patient 
    public function register(Request $request){
        $request->validate([
           'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'location' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        ///create base  record  in database ::
     $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient', // Enforced role restriction
            'status' => 'approved', // Patients are approved by default
        ]);
        // 2. Automatically provision the linked patient profile container
        $user->patientProfile()->create([
            'phone' => $request->phone,
            'location' => $request->location,
            'address' => $request->address,
        ]);
        // Log the patient in automatically after registration
        Auth::login($user);

        // Redirect to their protected dashboard area
        return redirect()->route('patient.dashboard');
    }

}
