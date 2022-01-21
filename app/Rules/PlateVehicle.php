<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PlateVehicle implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $regex = '/[A-Z]{3}[0-9][0-9A-Z][0-9]{2}/';
        return preg_match($regex, $value) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The plate not format correct.';
    }
}
