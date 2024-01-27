<?php

namespace App\Rules;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
class TimeBetween implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        $PickUpDate = Carbon::parse($value);
        $PickUpTime = Carbon::createFromTime($PickUpDate->hour,$PickUpDate->minute,$PickUpDate->second);
        //when the restaurant is open
        $earliestTime = Carbon::createFromTimeString('17:00:00');
        $lastTime = Carbon::createFromTimeString('23:00:00');
        // Compare $value with your conditions and return a boolean
        return $PickUpTime->between($earliestTime, $lastTime)?true:false;
     }
     public function message(){
        return 'Please choose the time between 17:00-23:00';
     }
}
