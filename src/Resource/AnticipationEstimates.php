<?php

namespace Moip\Resource;

use Moip\Helper\Filters;
use Moip\Helper\Pagination;
use Requests;
use stdClass;

/**
 * Class AnticipationEstimates
 */
class AnticipationEstimates extends MoipResource
{
    /**
     * @const string
     */
    const PATH = 'anticipationestimates';

    /**
     * Initializes new instances.
     */
    protected function initialize()
    {
        $this->data = new stdClass();
    }

    /**
     * Populate estimates object after request
     * @param stdClass $response
     * @return mixed|AnticipationEstimates
     */
    protected function populate(stdClass $response)
    {
        $estimates = clone $this;

        $estimates->data->fee = $this->getIfSet('fee', $response);
        $estimates->data->liquidAmount = $this->getIfSet('liquidAmount', $response);
        $estimates->data->grossAmount = $this->getIfSet('grossAmount', $response);
        $estimates->data->requestedAmount = $this->getIfSet('requestedAmount', $response);
        $estimates->data->anticipations = $this->getIfSet('anticipations', $response);

        return $estimates;
    }

    /**
     * Get Anticipation Estimate Data
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get Anticipation Estimate Fee
     * @return mixed
     */
    public function getFee()
    {
        return $this->getIfSet('fee');
    }

    /**
     * Get Anticipation Estimate Liquid Amount
     * @return mixed
     */
    public function getLiquidAmount()
    {
        return $this->getIfSet('liquidAmount');
    }

    /**
     * Get Anticipation Estimate Gross Amount
     * @return mixed
     */
    public function getGrossAmount()
    {
        return $this->getIfSet('grossAmount');
    }

    /**
     * Get Anticipation Estimate Requested Amount
     * @return mixed
     */
    public function getRequestedAmount()
    {
        return $this->getIfSet('requestedAmount');
    }

    /**
     * Get Anticipation Estimate Information
     * @return mixed
     */
    public function getAnticipations()
    {
        return $this->getIfSet('anticipations');
    }

    /**
     * Execute estimates.
     */
    public function execute($amount)
    {
        $path = sprintf('/%s/%s?amount=%s', MoipResource::VERSION, self::PATH, $amount);

        $response = $this->httpRequest($path, Requests::POST, $this);

        return $this->populate($response);
    }
}
