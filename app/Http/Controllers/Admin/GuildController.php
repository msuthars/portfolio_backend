<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guild;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class GuildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guilds = Guild::withCount('quests')->orderBy('weight')->get();

        return view('admin.guilds.index', compact('guilds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guilds.form', ['guild' => new Guild]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'slug'   => ['required', 'alpha_dash', 'max:50', Rule::unique('guilds')],
            'name'   => ['required', 'string', 'max:100'],
            'period' => ['required', 'string', 'max:50'],
            'weight' => ['required', 'integer', 'min:0'],
        ]);

        Guild::create($data);

        return redirect()->route('admin.guilds.index')->with('status', 'Guild created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guild $guild)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guild $guild)
    {
        return view('admin.guilds.form', compact('guild'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guild $guild)
    {
        $data = $request->validate([
            'slug'   => ['required', 'alpha_dash', 'max:50', Rule::unique('guilds')->ignore($guild)],
            'name'   => ['required', 'string', 'max:100'],
            'period' => ['required', 'string', 'max:50'],
            'weight' => ['required', 'integer', 'min:0'],
        ]);

        $guild->update($data);

        return redirect()->route('admin.guilds.index')->with('status', 'Guild updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guild $guild)
    {
        if ($guild->quests()->exists()) {
            return back()->with('error', 'This guild still has quests. Move or delete them first.');
        }
        $guild->delete();

        return redirect()->route('admin.guilds.index')->with('status', "Guild deleted.");
    }
}
