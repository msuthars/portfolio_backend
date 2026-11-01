<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestRequest;
use App\Models\Guild;
use App\Models\Quest;
use App\Models\Tag;

class QuestController extends Controller
{
    public function index()
    {
        $quests = Quest::with(['guild', 'tags'])->orderBy('weight')->get();

        return view('admin.quests.index', compact('quests'));
    }

    public function create()
    {
        return $this->form(new Quest);
    }

    public function store(QuestRequest $request)
    {
        $quest = Quest::create($this->fields($request));
        $this->syncTags($quest, $request->input('tags'));

        return redirect()->route('admin.quests.index')->with('status', 'Quest created.');
    }

    public function edit(Quest $quest)
    {
        return $this->form($quest);
    }

    public function update(QuestRequest $request, Quest $quest)
    {
        $quest->update($this->fields($request));
        $this->syncTags($quest, $request->input('tags'));

        return redirect()->route('admin.quests.index')->with('status', 'Quest updated.');
    }

    public function destroy(Quest $quest)
    {
        $quest->delete();

        return redirect()->route('admin.quests.index')->with('status', 'Quest deleted.');
    }

    private function form(Quest $quest)
    {
        return view('admin.quests.form', [
            'quest' => $quest,
            'guilds' => Guild::orderBy('weight')->get(),
            'types' => Quest::TYPES,
        ]);
    }

    /* Validated input, with "systems" turned from one-per-line text into an array */
    private function fields(QuestRequest $request): array
    {
        return [
            ...$request->safe()->except(['systems', 'tags']),
            'systems' => $this->split($request->input('systems'), '/\R/'),
            'active' => $request->boolean('active'),
        ];
    }

    /* "DRUPAL 11, PHP 8" -> tags; creates missing tags and keeps the typed order */
    private function syncTags(Quest $quest, ?string $text): void
    {
        $ids = [];
        foreach ($this->split($text, '/,/') as $position => $name) {
            $ids[Tag::firstOrCreate(['name' => $name])->id] = ['position' => $position];
        }

        $quest->tags()->sync($ids);
    }

    private function split(?string $text, string $pattern): array
    {
        return array_values(array_filter(array_map('trim', preg_split($pattern, (string) $text))));
    }
}
