<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'baristaname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:6',
                // 'regex:/[A-Z]/',
                // 'regex:/[a-z]/',
                // 'regex:/[0-9]/',
                // 'regex:/[@$!%*?&]/',
            ],
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            // $photoPath = $request->file('photo')->store('users', 'public'); // Simpan foto ke folder 'users'
            // $photoPath = $request->file('photo')->storeAs('users', time() . '_' . $request->file('photo')->getClientOriginalName(), 'public');
            $photoPath = $request->file('photo')->storeAs(
                'users', 
                $request->input('username') . '_photo.' . $request->file('photo')->getClientOriginalExtension(), 
                'public'
            );
        }

        try {
            User::create([
                'name' => $request->input('baristaname'),
                'username' => $request->input('username'),
                'email' => $request->input('email'), // Menyimpan email
                'password' => Hash::make($request->input('password')),
                'photo' => $photoPath,
                'is_admin' => 0,
            ]);
            return redirect()->route('homepage')->with('success', 'Registration complete. You can now log in!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    // Memproses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Mencari pengguna berdasarkan username
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            return redirect()->route('homepage')->with('success', 'Login successful. Welcome back!');
        }

        return back()->withErrors(['login' => 'Login failed. Please check your credentials and try again.']);
    }

    public function update(Request $request)
    {        
        // Validasi input
        $validated = $request->validate([
            'baristaname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $request->id,
            'email' => 'required|email|max:255|unique:users,email,' . $request->id,
            'password' => [
                'nullable',
                'string',
                'min:6',
                // 'regex:/[A-Z]/',
                // 'regex:/[a-z]/',
                // 'regex:/[0-9]/',
                // 'regex:/[@$!%*?&]/',
            ],
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        function getUserById($id) {
            return User::find($id);
        }
    
        function changeUser(Request $request, $data)
        {
            $user = User::find($data['id']);  // Cari pengguna berdasarkan ID
    
            if (!$user) {
                return false;  // Jika pengguna tidak ditemukan
            }
    
            // Update data pengguna
            $user->name = htmlspecialchars($data['baristaname']);
            $user->username = $data['username'];
            $user->email = $data['email'];
    
            // Jika password ada, hash password sebelum disimpan
            // if (!empty($data['password'])) {
            //     $user->password = Hash::make($data['password']); 
            // } 
            // $a ??= $b

            // Jika password baru diisi, gunakan password baru, jika tidak gunakan password lama
            // if (!empty($data['password']) && $data['password'] !== "********") {
            //     $user->password = Hash::make($data['password']); 
            // }

            $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;
            $user->save();

    
            // Jika ada foto baru yang diupload
            if (isset($data['photo']) && $data['photo']->isValid()) {
                // Hapus foto lama jika ada
                if ($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
                    unlink(storage_path('app/public/' . $user->photo));
                }
    
                // Tentukan nama file baru berdasarkan username
                $newPhotoName = $user->username . '_photo.' . $data['photo']->getClientOriginalExtension();

                // Simpan foto baru dengan nama yang telah ditentukan
                $newPhotoPath = $data['photo']->storeAs('users', $newPhotoName, 'public');

                // Update field foto di database
                $user->photo = $newPhotoPath;
            }
    
            // Simpan perubahan ke database
            return $user->save();
        }

        // Update data pengguna
        if (changeUser($request, $request->all())) {
            // Perbarui session dengan data terbaru
            $updatedUser = User::find(Auth::id());
            session([
                'user_name' => $updatedUser->name, 
                'username' => $updatedUser->username, 
                'email' => $updatedUser->email,
                'photo' => $updatedUser->photo
            ]);

            return redirect()->route('homepage')->with('success', 'User data has been successfully changed');
        }

        return redirect()->route('profileForm')->withErrors('User data failed to change');
    }

    public function users()
    {
        $users = User::where('is_admin', false)->orderBy('name', 'asc')->get(); // Mengambil user terurut berdasarkan nama
        return view('users', compact('users'));
    }

    public function userEdit($username)
    {
        $user = User::where('username', $username)->firstOrFail(); // Cari pengguna berdasarkan username
        return view('useredit', compact('user'));
    }

    public function userDetail($username)
    {
        $user = User::where('username', $username)->firstOrFail(); // Cari pengguna berdasarkan username
        return view('user', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Hapus foto dari storage jika ada
        if ($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
            unlink(storage_path('app/public/' . $user->photo));
        }
        
        $user->delete(); // Hapus pengguna dari database
        return redirect()->route('usersForm')->with('success', 'User deleted successfully');
    }

    
}
