<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;

class ReCaptchaRule implements Rule
{

    /**
     * Error message
     *
     * @var string
     */
    private $error_msg = '';

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
        if (empty($value)) {
            $this->error_msg = ':attribute is required.';

            return false;
         }

        $recaptcha = new ReCaptcha(env('GOOGLE_CAPTCHA_PRIVATE_KEY'));

        $response = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
            ->setExpectedAction('complaint_form')
            ->setScoreThreshold(0.5)
            ->verify($value, $_SERVER['REMOTE_ADDR']);

        if (!$response->isSuccess()) {
            $this->error_msg = 'ReCaptcha field is required.';

            return false;
        }

        if ($response->getScore() < 0.5) {
            $this->error_msg = 'Failed to validate captcha.';

            return false;
        }


        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
