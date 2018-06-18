<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckIDs implements Rule
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
        $values = explode(',', $value);
        if (empty($values)) {
            return false;
        }
        foreach ($values as $id) {
            if (is_numeric($id) && is_int($id + 0) && ($id + 0) > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ids参数必须为以逗号分隔的多个正整数,仔细看文档啊';
    }
}
