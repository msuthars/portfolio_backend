<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestResource;
use App\Models\Quest;

class QuestController extends Controller
{
    public function index()
    {
        return QuestResource::collection(
            Quest::with(['guild', 'tags'])->orderBy('weight')->get()
        );
    }

    public function show(Quest $quest)
    {
        return new QuestResource($quest->load(['guild', 'tags']));
    }
}
