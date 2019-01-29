<?php

namespace Moip\Resource;

use Moip\Helper\Filters;
use Moip\Helper\Pagination;
use Requests;
use stdClass;

/**
 * Class Transfers.
 */
class Anticipations extends MoipResource
{
    /**
     * @const string
     */
    const PATH = 'anticipations';

    /**
     * Initializes new instances.
     */
    protected function initialize()
    {
        $this->data = new stdClass();
    }

    /**
     *  Populate anticipations object after request
     * @param stdClass $response
     * @return mixed|Anticipations
     */
    protected function populate(stdClass $response)
    {
        $anticipations = clone $this;

        $anticipations->data->externalId = $this->getIfSet('externalId', $response);
        $anticipations->data->requestedAt = $this->getIfSet('requestedAt', $response);
        $anticipations->data->executedAt = $this->getIfSet('executedAt', $response);
        $anticipations->data->status = $this->getIfSet('status', $response);
        $anticipations->data->requestAmount = $this->getIfSet('requestAmount', $response);
        $anticipations->data->grossAmount = $this->getIfSet('grossAmount', $response);
        $anticipations->data->liquidAmount = $this->getIfSet('liquidAmount', $response);
        $anticipations->data->totalFee = $this->getIfSet('totalFee', $response);
        $anticipations->data->percentageFee = $this->getIfSet('percentageFee', $response);
        $anticipations->data->ip = $this->getIfSet('ip', $response);
        $anticipations->data->userAgent = $this->getIfSet('userAgent', $response);
        $anticipations->data->_links = $this->getIfSet('_links', $response);

        return $anticipations;
    }

    /**
     * Get a Anticipation.
     *
     * @param string $id Anticipation id.
     *
     * @return stdClass
     */
    public function get($id)
    {
        return $this->getByPath(sprintf('/%s/%s/%s', MoipResource::VERSION, self::PATH, $id));
    }

    /**
     * Get Anticipation External ID
     * @return mixed
     */
    public function getExternalId()
    {
        return $this->getIfSet('externalId');
    }

    /**
     * Get Anticipation Request At
     * @return mixed
     */
    public function getRequestAt()
    {
        return $this->getIfSet('requestedAt');
    }

    /**
     * Get Anticipation Request Amount
     * @return mixed
     */
    public function getRequestAmount()
    {
        return $this->getIfSet('requestAmount');
    }

    /**
     * Get Anticipation Gross Amount
     * @return mixed
     */
    public function getGrossAmount()
    {
        return $this->getIfSet('grossAmount');
    }

    /**
     * Get Anticipation Liquid Amount
     * @return mixed
     */
    public function getLiquidAmount()
    {
        return $this->getIfSet('liquidAmount');
    }

    /**
     * Get Anticipation Status
     * @return mixed
     */
    public function getStatus()
    {
        return $this->getIfSet('status');
    }

    /**
     * Create a new Anticipation list instance.
     *
     * @return \Moip\Resource\AnticipationsList
     */
    public function getList(Pagination $pagination = null, Filters $filters = null, $qParam = '')
    {
        $anticipationList = new AnticipationsList($this->moip);

        return $anticipationList->get($pagination, $filters, $qParam);
    }

    /**
     * Execute Anticipation.
     *
     * @return Anticipation
     */
    public function execute($amount)
    {
        $path = sprintf('/%s/%s?amount=%s', MoipResource::VERSION, self::PATH, $amount);

        $response = $this->httpRequest($path, Requests::POST, $this);

        return $this->populate($response);
    }
}
