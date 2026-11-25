<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        
        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Akun {$user->name} berhasil {$status}.");
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        return view('admin.users.show', compact('user'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);


        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang digunakan.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'Akun pengguna berhasil dihapus.');
    }

    public function trashed()
    {
        
        $trashedUsers = User::onlyTrashed()->get(); 
        return view('admin.users.trashed', compact('trashedUsers'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore(); 

        return redirect()->route('admin.users.index')
                         ->with('success', 'Akun pengguna berhasil dipulihkan dan bisa digunakan kembali.');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);


        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->forceDelete(); 

        return redirect()->route('admin.users.trashed')
                         ->with('success', 'Akun pengguna dihapus secara permanen.');
    }
    public function print()
    {

        $users = User::orderBy('role')->orderBy('name')->get();
        
        return view('admin.users.print', compact('users'));
    }
}
