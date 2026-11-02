<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GuildResource;
use App\Models\Guild;

class GuildController extends Controller
{
    public function index()
    {
        return GuildResource::collection(Guild::orderBy('weight')->get());
    }
}
