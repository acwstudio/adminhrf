<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

/**
 * Class ExistsInAnyTable
 * @package App\Rules
 */
class ExistsInAnyTable implements Rule
{
    public $tables;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $tables)
    {
        $this->tables = $tables;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->tables as $table) {
            return DB::table($table)->find($value);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute does not exist.';
    }
}
