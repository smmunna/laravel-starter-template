<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //show login page to the frontend
    public function registrationPage()
    {
        return view('shared.auth.registration');
    }

    // user registration 
    public function registration(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'phone' => 'nullable|string|max:15|unique:users',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'nullable|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            // Generate a unique ID for the file name
            $uniqueId = uniqid();

            // Get the current date and time
            $currentDateTime = now()->format('Ymd_His');

            // Get the original file name
            $originalFileName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            // Construct the new file name
            $fileName = $originalFileName . '_' . $currentDateTime . '_' . $uniqueId . '.' . $photo->getClientOriginalExtension();
            // Store the image in the storage directory with the constructed file name
            $photoPath = $photo->storeAs('uploads/photos', $fileName, 'public');
            // Save the photo path to the user model
            $user->photo = $photoPath;
        }

        // Save user
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    //show login page to the frontend
    public function loginPage()
    {
        return view('shared.auth.login');
    }

    //user login
    public function login(Request $request)
{
    // Validate the request data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to authenticate the user
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Authentication successful
        $user = Auth::user();
        $dashboardRoute = '';

        switch ($user->role) {
            case 'user':
                $dashboardRoute = route('user.dashboard');
                break;
            case 'admin':
                $dashboardRoute = route('admin.dashboard');
                break;
            default:
                $dashboardRoute = route('/'); // Replace with your default dashboard route
                break;
        }

        return response()->json(['success' => true, 'redirect' => $dashboardRoute]);
    }

    // Authentication failed
    return response()->json(['success' => false, 'message' => 'Invalid username or password']);
}


    // profile page
    public function profile()
    {
        return view('pages.users.profile.profile');
    }
}
