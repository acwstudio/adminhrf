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
    protected $sortParams = [
        self::SORT_POPULAR
    ];
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $categories = $request->get('categories');
        $query = Test::where('is_active', '=', true)
            ->where('published_at', '<', now());
        $sortBy = $request->get('sort_by');
        if (!is_null($categories)) {
            $cats = explode('|', $categories);
            $query->whereHas('categories', function (Builder $query) use ($cats) {
                $query->whereIn('slug', $cats);
            });
        }
        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }
        $result = $query->where('is_active', '=', true)->orderBy('published_at')->paginate($perPage);
        return TestShortResource::collection(Test::where('is_active', '=', true)->orderBy('id','desc')->orderBy('published_at','desc')->paginate($perPage));
    }

    public function show(Test $test, Request $request)
    {
        return TestResource::make($test);
    }

    public function postResult(Test $test, Request $request)
    {
        $count = $request->get('count', 0);
        $points = $request->get('points', 0);
        $is_closed = $request->boolean('finished', false);
        $time = (int)$request->get('time', 0);
        $val = $test->has_points == 1 ? $points : $count;
        abort_if(
            !$test,
            '404');

        $user = $request->user();
        //TODO: Change checking id by param to Auth service (so change the if condition)
        if (!$user) {

            return $test->messages->where('lowest_value', '<=', $val)->where('highest_value', '>=', $val)->first();
        }

        $result = $user->testResults->firstWhere('test_id',$test->id);
        //TResult::where('user_id', $id)->where('test_id', $test->id)->first();

        if (is_null($result)) {

            TResult::create([
               'test_id' => $test->id,
               'user_id' => $user->id,
               'time_passed' => $time,
               'is_closed' => $is_closed,
               'value' => $val ]);

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
