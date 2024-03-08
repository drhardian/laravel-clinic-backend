<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    # index
    public function index(Request $request)
    {
        $users = DB::table('users')
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('id','desc')
            ->paginate(10);

        $type_menu = "user";

        return view('pages.user.index', compact('users','type_menu'));
    }

    # create
    public function create()
    {
        $type_menu = "user";

        return view('pages.user.create', compact('type_menu'));
    }

    # store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $password = Hash::make($request->password);

            if(!empty($request->file('avatar'))) {
                $avatarFile = $request->file('avatar');
                $avatarName = $avatarFile->hashName();

                /* save new profile image into storage */
                $request->file('avatar')->storeAs('avatar',$avatarName,'public');

                $params = array_merge(
                    $request->only(['name', 'email', 'password', 'phone', 'role']),
                    [
                        'password' => $password,
                        'avatar' => $avatarName
                    ]
                );
            } else {
                $params = array_merge(
                    $request->only(['name', 'email', 'password', 'phone', 'role']),
                    ['password' => $password]
                );
            }

            User::create($params);

            DB::commit();

            return redirect()->route('user.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Failed to create user');
        }
    }

    # show
    public function show(User $user)
    {
        return view('pages.user.create');
    }

    # edit
    public function edit(User $user)
    {
        $type_menu = "user";

        return view('pages.user.edit', compact('type_menu','user'));
    }

    # update
    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required',
        ]);

        DB::beginTransaction();

        try {
            if(!empty($request->file('avatar'))) {
                $avatarFile = $request->file('avatar');
                $avatarName = $avatarFile->hashName();

                /* save new profile image into storage */
                $request->file('avatar')->storeAs('avatar',$avatarName,'public');

                $params = $request->password ? array_merge([ 'password' => Hash::make($request->password),'avatar' => $avatarName ],$request->only(['name', 'email', 'password', 'phone', 'role']))  : array_merge(['avatar' => $avatarName],$request->only(['name', 'email', 'phone', 'role']));
            } else {
                $params = $request->password ? array_merge([ 'password' => Hash::make($request->password) ],$request->only(['name', 'email', 'password', 'phone', 'role']))  : $request->only(['name', 'email', 'phone', 'role']);
            }

            $user->update($params);

            DB::commit();

            return redirect()->route('user.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error','Failed to update user')->withInput();
        }
    }

    # destroy
    public function destroy(User $user)
    {
        DB::beginTransaction();

        try {
            $user->delete();

            DB::commit();

            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->withErrors('Failed to delete user');
        }
    }
}
