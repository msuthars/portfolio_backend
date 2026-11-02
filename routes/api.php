<?php

use App\Http\Controllers\Api\GuildController;
use App\Http\Controllers\Api\QuestController;
use Illuminate\Support\Facades\Route;

Route::get('guilds', [GuildController::class, 'index']);
Route::get('quests', [QuestController::class, 'index']);
Route::get('quests/{quest:slug}', [QuestController::class, 'show']);
