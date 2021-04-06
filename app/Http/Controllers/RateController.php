<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function up(Request $request)
    {
        $this->modify($request, 'up');
    }

    public function down(Request $request)
    {
        $this->modify($request, 'down');
    }

    protected function modify(Request $request, $type)
    {
        $value = 1;

        switch ($type) {
            case 'up':
                $value = 1;
                break;
            case 'down':
                $value = -1;
                break;
        }

        $model_type = $request->get('model_type', 'comment');
        $id = $request->get('id');

        abort_if(
            !array_key_exists($model_type, Relation::$morphMap) ||
            !$id ||
            !$model = Relation::$morphMap[$model_type]::find($id),
            '404');

        $user = $request->user();

        $rate = $model->rates()->where('user_id', $user->id)->first();

        if (is_null($rate)) {
            Rate::create([
                'rateable_type' => $model_type,
                'rateable_id' => $id,
                'user_id' => $user->id,
                'rate' => $value
            ]);
            $model->incrementRateCounter($value);

        } else {

            if (($rate->rate < 0 && $type === 'up') || ($rate->rate > 0 && $type === 'down')) {
                $rate->rate = $value;
                $rate->save();
                $model->incrementRateCounter($value * 2);
            } else {
                abort(403, 'Already rated');
            }
        }

        return response()->json(['status' => 'Rate '.$type]);

    }
}
