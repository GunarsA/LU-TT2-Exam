<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Staff;
use App\Models\User;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::all();

        return view('staff', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        return view('staff_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        $staff = new Staff();
        $staff->name = $request->name;
        $staff->save();

        Log::info('Staff [' . $staff->name . ' (' . $staff->id . ')] created by user [' . Auth::user()->name . ' (' . Auth::user()->id . ')]');

        return redirect('staff');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = Staff::findOrFail($id);
        if (!$staff) {
            abort(404);
        }

        return view('staff_show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        $staff = Staff::findOrFail($id);
        if (!$staff) {
            abort(404);
        }

        return view('staff_edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);

        $staff = Staff::findOrFail($id);
        $staff->name = $request->name;
        $staff->save();

        Log::info('Staff [' . $staff->name . ' (' . $staff->id . ')] updated by user [' . Auth::user()->name . ' (' . Auth::user()->id . ')]');

        return redirect('staff');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::allowIf(fn (User $user) => $user->is_admin);
        
        $staff = Staff::findOrFail($id);
        $staff->delete();

        Log::info('Staff [' . $staff->name . ' (' . $staff->id . ')] deleted by user [' . Auth::user()->name . ' (' . Auth::user()->id . ')]');
        
        return redirect('staff');
    }
}
