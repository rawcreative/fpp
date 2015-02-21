<?php
namespace FPP\Http\Controllers\Api\v1;

use FPP\Http\Controllers\Controller;
use FPP\Http\Responses\Output;
use Illuminate\Http\Response;
use UnexpectedValueException;

class ApiController extends Controller
{
    const REQUEST_FAILED = 402;

    const BAD_REQUEST = 100;
    const UNAUTHORIZED = 110;
    const ITEM_MISSING = 120;
    const FILE_NOT_FOUND = 130;
    const FPPD_ERROR = 140;


    /**
     * An output class for sending expected outputs.
     *
     * @var \FPP\Http\Responses\Output
     */
    protected $output;

    /**
     * Current status code of the given request.
     *
     * @var integer
     */
    protected $statusCode = Response::HTTP_OK;

    /**
     * Make a new api controller with an output class.
     *
     * @param \FPP\Http\Responses\Output $output
     */
    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    /**
     * Get the current status code.
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Respond with an error.
     *
     * @param  stirng $message
     * @param  stirng $errorCode
     * @return \Illuminate\Http\Response
     */
    protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode == Response::HTTP_OK) {
            throw new UnexpectedValueException('Error response requested with 200 status code; user error.');
        }
        $out = $this->output->asError($message, $this->statusCode, $errorCode);
        return $this->respondWithArray($out);
    }

    /**
     * Respond with a json array.
     *
     * @param  array $array
     * @param  array $headers
     * @return \Illuminate\Http\Response
     */
    protected function respondWithArray(array $array, array $headers = array())
    {
        return response()->json($array, $this->statusCode, $headers);
    }

    /**
     * Respond with a single item.
     *
     * @param  mixed $item
     * @param  mixed $callback
     * @return \Illuminate\Http\Response
     */
    protected function respondWithItem($item, $callback)
    {
        $out = $this->output->asItemArray($item, $callback);
        return $this->respondWithArray($out);
    }

    /**
     * Respond with a collection of items.
     *
     * @param  array $collection
     * @param  mixed $callback
     * @return \Illuminate\Http\Response
     */
    protected function respondWithCollection($collection, $callback)
    {
        $out = $this->output->asCollectionArray($collection, $callback);
        return $this->respondWithArray($out);
    }
}