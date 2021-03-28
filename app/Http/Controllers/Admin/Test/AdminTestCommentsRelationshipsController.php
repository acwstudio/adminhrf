<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestCommentsRelationshipsController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestCommentsRelationshipsController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Wait please, I am doing nothing now']);
    }

    public function update(Request $request, Test $test)
    {
        return response()->json(['message' => 'Wait please, I am doing nothing now']);
    }
}
