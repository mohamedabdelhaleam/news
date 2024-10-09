<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueUsername implements Rule
{
    protected $exceptId;

    /**
     * Create a new rule instance.
     *
     * @param  int|null  $exceptId
     * @return void
     */
    public function __construct($exceptId = null)
    {
        $this->exceptId = $exceptId;
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
        $query = DB::table('admins')->where('username', $value);

        if ($this->exceptId) {
            $query->where('id', '!=', $this->exceptId);
        }

        if ($query->exists()) {
            return false;
        }

        $existsInEmployees = DB::table('employees')
            ->where('username', $value)
            ->where('id', '!=', $this->exceptId)
            ->exists();

        return !$existsInEmployees;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}
