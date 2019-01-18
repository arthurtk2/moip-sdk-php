<?php

namespace Moip\Resource;

use Moip\Helper\Filters;
use Moip\Helper\Pagination;
use stdClass;

class EntriesList extends MoipResource
{
    /**
     * Path bank accounts API.
     *
     * @const string
     */
    const PATH = 'entries';

    /**
     * Initialize a new instance.
     */
    public function initialize()
    {
        $this->data = new stdClass();
        $this->data->transfers = [];
    }

    /**
     * Get transfers.
     *
     * @return array
     */
    public function getEntries()
    {
        return $this->getIfSet('entries');
    }

    /**
     * Get entries list.
     *
     * @param Pagination $pagination
     * @param Filters $filters
     * @param string $qParam Query a specific value.
     *
     * @return stdClass
     */
    public function get(Pagination $pagination = null, Filters $filters = null, $qParam = '')
    {
        $headers['Accept'] = 'application/json;version=2.1';

        return $this->getByPath($this->generateListPath($pagination, $filters, ['q' => $qParam]), $headers);
    }

    protected function populate(stdClass $response)
    {
        $entriesList = clone $this;
        $entriesList->data = new stdClass();

        $entriesList->data->entries = $response->entries;

        $entriesList->data->summary = $response->summary;
        $entriesList->_links = $response->_links;

        return $entriesList;
    }
}
