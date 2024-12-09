<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //crud logic will be here
    public function loadAllUsers()
    {
        $all_users = User::all();
        return view('users', compact('all_users'));
    }
    public function loadAllUserForm()
    {
        return view('addUser');
    }

    public function AddUser(Request $request)
    {
        // form validate
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|numeric',
            'password' => 'required|confirmed|min:4|max:10',
        ]);
        // regis user :
        try {
            $new_user = new User;
            $new_user->name = $request->name;
            $new_user->email = $request->email;
            $new_user->phone_number = $request->phone_number;
            $new_user->password = Hash::make($request->password);
            $new_user->save();
            return redirect('/')->with('success', 'User Added Successfully');
        } catch (\Exception $e) {
            return redirect('/add/user')->with('fail', $e->getMessage());
        }
    }

    // versi tanpa memberitahu siapa yang di update
    // public function EditUser(Request $request)
    // {
    //     // form validate
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email',
    //         'phone_number' => 'required|numeric',
    //     ]);
    //     // update user :
    //     try {
    //         User::where('id', $request->user_id)->update([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'phone_number' => $request->phone_number,
    //         ]);
    //         return redirect('/')->with('success', 'Updated Successfully');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         // Tangkap error duplicate entry
    //         if ($e->errorInfo[1] == 1062) {
    //             return back()->with('fail', 'Email sudah digunakan, silakan gunakan email lain.');
    //         }
    //         // Default error handling
    //         return redirect('/')->with('fail', 'Terjadi kesalahan saat mengupdate data pengguna.');
    //     } catch (\Exception $e) {
    //         // Tangkap error lainnya
    //         return redirect('/')->with('fail', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }

    // versi yang memberitahu siapa yang di update
    public function EditUser(Request $request)
    {
        // Form validate
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
        ]);

        try {
            // Ambil data user sebelum update
            $user = User::findOrFail($request->user_id);

            // Update data user
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            // Reload data user untuk mendapatkan data yang baru diupdate
            $user->refresh();

            // Redirect dengan pesan sukses dan data terbaru
            return redirect('/')->with('success', "Data pengguna {$user->name} berhasil diperbarui!");
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap error duplicate entry
            if ($e->errorInfo[1] == 1062) {
                return back()->with('fail', "Email sudah digunakan oleh pengguna lain.");
            }

            // Default error handling untuk QueryException
            return back()->with('fail', "Terjadi kesalahan pada database.");
        } catch (\Exception $e) {
            // Tangkap error lainnya
            return back()->with('fail', "Terjadi kesalahan: {$e->getMessage()}");
        }
    }

    public function loadEditForm($id)
    {
        $user = User::find($id);

        return view('editUser', compact('user'));
    }

    public function deleteUser($id)
    {
        try {
            User::where('id', $id)->delete();
            return redirect('/')->with('success', 'User Deleted Successfully');
        } catch (\exception $e) {
            return redirect('/')->with('fail', $e->getMessage());
        }
    }
}
