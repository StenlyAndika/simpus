<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUser extends Controller
{
    public function index()
    {
        $poli = [
            "PENDAFTARAN",
            "UMUM",
            "GIGI",
            "MTBS",
            "KIA-KB",
            "LANSIA",
            "APOTEK"
        ];
        return view('dashboard.user.index', [
            'title' => 'Data User',
            'user' => User::orderBy('is_root', 'desc')->get(),
            'poli' => $poli
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|unique:user',
            'poli' => 'required',
            'password' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('admin.user.index')->with('toast_success', 'Data berhasil ditambah!');
    }

    public function generateSU()
    {
        $validatedSuperAdmin['username'] = 'admin';
        $validatedSuperAdmin['password'] = bcrypt('admin');
        $validatedSuperAdmin['poli'] = 'SUPER ADMIN';
        $validatedSuperAdmin['is_admin'] = '1';
        $validatedSuperAdmin['is_root'] = '1';

        User::create($validatedSuperAdmin);

        return redirect()->route('welcome')->with('toast_success', 'Super Admin berhasil ditambah!');
    }

    public function show(User $user)
    {
        if($user->id != auth()->user()->id) {
            return redirect()->route('admin.dashboard');
        } else {
            $user->password = '*****';
            return view('dashboard.user.profil', [
                'title' => 'Profil Admin'
            ], compact('user'));
        }        
    }

    public function edit(User $user)
    {
        $user->password = '*****';
        return view('dashboard.user.edit', [
            'title' => 'Edit User'
        ], compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'password' => 'required'
        ];

        if ($request->username != auth()->user()->username) {
            $rules['username'] = 'required|unique:user';
        }

        $validatedData = $request->validate($rules);

        if($validatedData['password'] != auth()->user()->password) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        
        User::where('id', $user->id)->update($validatedData);
        if($user->is_root) {
            return redirect()->route('admin.user.index')->with('toast_success', 'Data berhasil diupdate!');
        } else {
            return redirect()->route('admin.dashboard')->with('toast_success', 'Data berhasil diupdate!');
        }
    }

    public function updateroot(Request $request, User $user)
    {
        $rules = [
            'password' => 'required'
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:user';
        }

        $validatedData = $request->validate($rules);

        if($validatedData['password'] != $user->password) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        
        User::where('id', $user->id)->update($validatedData);

        return redirect()->route('admin.user.index')->with('toast_success', 'Data berhasil diupdate!');
    }

    public function set_admin(User $user)
    {
        if($user->is_admin == 1) {
            $data = [
                'is_admin' => '0',
            ];
        } else {
            $data = [
                'is_admin' => '1',
            ];
        }
    
        User::where('id', $user->id)->update($data);

        return redirect()->route('admin.user.index')->with('toast_success', 'Data berhasil diupdate!');
    }

    public function set_root(User $user)
    {
        $tdata = User::where('is_root', '1')->count();
        if($user->is_root == 1) {
            $data = [
                'is_root' => '0',
            ];
            if($tdata <= 1) {
                return redirect()->route('admin.user.index')->with('toast_info', 'Super Admin tidak boleh kosong!');
            } else {
                User::where('id', $user->id)->update($data);
                return redirect()->route('admin.user.index')->with('toast_success', 'Data berhasil diupdate!');
            }
        } else {
            $data = [
                'is_root' => '1',
                'poli' => 'SUPER ADMIN'
            ];
            User::where('id', $user->id)->update($data);
            return redirect()->route('admin.user.index')->with('toast_success', 'Data berhasil diupdate!');
        }

    }

    public function destroy(User $user, Request $request)
    {
        User::destroy($user->id);
        if(auth()->user()->username == $user->username) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.user.index')->with('success','Data berhasil dihapus!');
        } else {
            return redirect()->route('admin.user.index')->with('toast_success','Data berhasil dihapus!');
        }
    }
}
