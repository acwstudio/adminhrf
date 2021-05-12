<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\DayInHistory;
use function abort;
use function dd;

class TempTestingController extends Controller
{
    protected $methods = [
        'phpinfo',
        'test'
    ];

    public function index($method)
    {
        if (in_array($method, $this->methods)) {
            return $this->$method();
        }

        abort(404);
    }


    protected function phpinfo()
    {
        phpinfo();
    }

    protected function test()
    {
        echo 'This is test method';

        dd(DayInHistory::doesntHave('image')->get()->toArray());
    }

}
