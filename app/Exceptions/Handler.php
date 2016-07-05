<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use LERN;
use Request;
use Auth;
use Input;
use Config;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        if ($this->shouldReport($e)) {

            //Check to see if LERN is installed otherwise you will not get an exception.
            if (app()->bound("lern")) {

                switch(Config('lern.behaviour')) {
                    case 'record':
                        app()->make("lern")->record($e); //Record the Exception to the database
                        break;
                    case 'notify':
                        $this->setLERNNotificationFormat();
                        app()->make("lern")->notify($e); //Notify the Exception
                        break;
                    default:
                        app()->make("lern")->handle($e); //Record and Notify the Exception
                        break;
                }

            }
        }

        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        return parent::render($request, $e);
    }


    private function setLERNNotificationFormat()
    {
        //Change the subject
        LERN::setSubject(config('lern.notify.channel') . ": An Exception was thrown!");

        //Change the message body
        LERN::setMessage(function ($exception) {
            $msg = "";

            //Get the route
            $url = Request::url();
            $method = Request::method();
            if ($url) {
                $msg .= "URL: {$method}@{$url}" . "<br/>" . PHP_EOL;
            }

            //Get the User
            $user = Auth::user();
            if ($user) {
                $msg .= "User: #{$user->id} {$user->first_name} {$user->last_name}" . PHP_EOL;
            }

            //Exception
            $msg .= get_class($exception) . ":{$exception->getFile()}:{$exception->getLine()} {$exception->getMessage()}" . PHP_EOL;

            //Input
            $input = Input::all();
            if (!empty($input)) {
                $msg .= "Data: " . json_encode($input) . PHP_EOL;
            }

            //Trace
            $msg .= PHP_EOL . "Trace: {$exception->getTraceAsString()}";
            return $msg;
        });
    }
}
