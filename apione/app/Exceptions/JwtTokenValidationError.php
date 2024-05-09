<?php

namespace App\Exceptions;

use Exception;

class JwtTokenValidationError extends Exception
{
    protected $customData;

    /**
     * Create a new custom exception instance.
     *
     * @param  string  $message
     * @param  array  $customData
     * @param  int  $code
     * @param  \Throwable  $previous
     * @return void
     */
    public function __construct($message = '', $customData = [], $code = 0, Throwable $previous = null)
    {
        $this->customData = $customData;

        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the additional data associated with the exception.
     *
     * @return array
     */
    public function getCustomData()
    {
        return $this->customData;
    }

    /**
     * Report or log the exception.
     *
     * @return void
     */
    public function report()
    {
        // You can log the exception here
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $custom_data = $this->getCustomData();

        return response()->json([
            'error' => $this->getMessage(),
            'custom_data' => [$custom_data['email'], $custom_data['user']['email'] ],
        ], 500);
    }
}
