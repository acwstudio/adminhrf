<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestResource;
use App\Http\Resources\TestShortResource;
use App\Models\Test;
use App\Models\TResult;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {

        $perPage = $request->get('per_page', $this->perPage);
        $categories = $request->get('categories');
        $query = Test::where('is_active', '=', true)
            ->where('published_at', '<', now());
        if (!is_null($categories)) {
            $cats = explode('|', $categories);
            $query->whereHas('categories', function (Builder $query) use ($cats) {
                $query->whereIn('slug', $cats);
            });
        }
        return TestShortResource::collection(Test::where('is_active', '=', true)->orderBy('published_at')->paginate($perPage));
    }

    public function show($testId, Request $request)
    {
        return TestResource::make(Test::findOrFail($testId)->first()); //TestResource::make();
    }

    public function postResult(Test $test, Request $request)
    {
        $count = $request->get('count', 0);
        $points = $request->get('points', 0);
        $id = $request->get('user_id');
        $is_closed = $request->boolean('finished', false);
        $time = (int)$request->get('time', 0);
        $val = $test->has_points == 1 ? $points : $count;
        abort_if(
            !$test,
            '404');

        $user = $request->user();
        //TODO: Change checking id by param to Auth service (so change the if condition)
        if (!$id || !User::where('id', $id)->first()) {

            return $test->messages->where('lowest_value', '<=', $val)->where('highest_value', '>=', $val)->first();
        }

        $result = TResult::where('user_id', $id)->where('test_id', $test->id)->first();

        if (is_null($result)) {

            TResult::create([
                'test_id' => $test->id,
                'user_id' => $id,
                'time_passed' => $time,
                'is_closed' => $is_closed,
                'value' => $val
            ]);

            //return response('Result saved', 201);

        } else {
            $result->update([
                'time_passed' => ($result->time_passed > $time) ? $time : $result->time_passed,
                'is_closed' => ($result->is_closed == false && $is_closed == true) ? $is_closed : $result->is_closed,
                'value' => ($val > $result->value) ? $val : $result->value,
            ]);
            //return response('Result saved', 201);
        }

        return $test->messages->where('lowest_value', '<=', $val)->where('highest_value', '>=', $val)->first();
    }
}
