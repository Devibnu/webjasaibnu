<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdministratorRequest;
use App\Http\Requests\Admin\UpdateAdministratorRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    private const PROTECTED_LOCAL_ADMIN_EMAIL = 'admin@jasaibnu.test';

    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = User::query()->orderBy('id');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10)->withQueryString();

        return view('admin.administrators.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('admin.administrators.create', [
            'user' => new User(['is_admin' => true]),
        ]);
    }

    public function store(StoreAdministratorRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['is_admin'] = (bool) $request->input('is_admin', true);

        User::create($data);

        return redirect()->route('admin.administrators.index')
            ->with('status', 'Administrator created successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.administrators.edit', compact('user'));
    }

    public function update(UpdateAdministratorRequest $request, User $user)
    {
        $data = $request->validated();
        $newIsAdmin = (bool) $request->input('is_admin', false);

        // Guard: Prevent self-lockout
        if ($request->user()->id === $user->id && ! $newIsAdmin) {
            return back()->withInput()->withErrors([
                'is_admin' => 'Anda tidak dapat menonaktifkan akses admin akun yang sedang digunakan.',
            ]);
        }

        // Guard: Prevent removing last admin
        if ($user->is_admin && ! $newIsAdmin) {
            $activeAdminCount = User::where('is_admin', true)->count();
            if ($activeAdminCount <= 1) {
                return back()->withInput()->withErrors([
                    'is_admin' => 'Sistem harus menyisakan setidaknya satu administrator aktif.',
                ]);
            }
        }

        // Guard: Preserve the permanent local administrator account.
        if ($user->email === self::PROTECTED_LOCAL_ADMIN_EMAIL) {
            $emailChanged = $data['email'] !== self::PROTECTED_LOCAL_ADMIN_EMAIL;
            $passwordChanged = ! empty($data['password']);

            if ($emailChanged || $passwordChanged || ! $newIsAdmin) {
                return back()->withInput()->withErrors([
                    'email' => 'Akun administrator lokal permanen tidak boleh diubah email, password, atau akses adminnya.',
                ]);
            }
        }

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'is_admin' => $newIsAdmin,
        ];

        if (! empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.administrators.index')
            ->with('status', 'Administrator updated successfully.');
    }

    public function destroy(Request $request, User $user)
    {
        // Guard: Preserve the permanent local administrator account.
        if ($user->email === self::PROTECTED_LOCAL_ADMIN_EMAIL) {
            return redirect()->route('admin.administrators.index')
                ->withErrors('Akun administrator lokal permanen tidak boleh dihapus.');
        }

        // Guard: Prevent self-deletion
        if ($request->user()->id === $user->id) {
            return redirect()->route('admin.administrators.index')
                ->withErrors('Anda tidak dapat menghapus akun administrator yang sedang digunakan.');
        }

        // Guard: Prevent deleting last admin
        if ($user->is_admin) {
            $activeAdminCount = User::where('is_admin', true)->count();
            if ($activeAdminCount <= 1) {
                return redirect()->route('admin.administrators.index')
                    ->withErrors('Sistem harus menyisakan setidaknya satu administrator.');
            }
        }

        $user->delete();

        return redirect()->route('admin.administrators.index')
            ->with('status', 'Administrator deleted successfully.');
    }
}
