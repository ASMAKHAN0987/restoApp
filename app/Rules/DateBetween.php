<?php

namespace App\Rules;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
class DateBetween implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        $PickUpDate = Carbon::parse($value);
        $lastDate = Carbon::now()->addweek();
        // Compare $value with your conditions and return a boolean
        return $value >= now() && $value <= $lastDate;
     }
     public function message(){
        return 'Please select a date between a week from now';
     }
}
