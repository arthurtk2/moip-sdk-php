<?php

namespace Moip\Resource;

use Moip\Helper\Filters;
use Moip\Helper\Pagination;
use stdClass;

class AnticipationsList extends MoipResource
{
    /**
     * Path Anticipations API.
     *
     * @const string
     */
    const PATH = 'anticipations';

    /**
     * Initialize a new instance.
     */
    public function initialize()
    {
        $this->data = new stdClass();
        $this->data->anticipations = [];
    }

    protected function populate(stdClass $response)
    {
        $transfersList = clone $this;
        $transfersList->data = new stdClass();

        $transfersList->data->anticipations = $response->anticipations;

        $transfersList->data->summary = $response->summary;
        $transfersList->_links = $response->_links;

        return $transfersList;
    }

    /**
     * Get anticipations.
     *
     * @return array
     */
    public function getAnticipations()
    {
        return $this->getIfSet('anticipations');
    }

    /**
     * Get Anticipation List Data
     * @return stdClass
     */
    public function getData(){
        return $this->data;
    }

    /**
     * Get anticipations list.
     *
     * @param Pagination $pagination
     * @param Filters    $filters
     * @param string     $qParam     Query a specific value.
     *
     * @return stdClass
     */
    public function get(Pagination $pagination = null, Filters $filters = null, $qParam = '')
    {
        return $this->getByPath($this->generateListPath($pagination, $filters, ['q' => $qParam]));
    }

}
