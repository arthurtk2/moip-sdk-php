<?php

namespace Moip\Resource;

use stdClass;

class FutureStatementsList extends MoipResource
{
    /**
     * Path future statements API.
     *
     * @const string
     */
    const PATH = 'futurestatements';

    /**
     * Initialize a new instance.
     */
    public function initialize()
    {
        $this->data = new stdClass();
    }

    /**
     * Get statements list
     *
     * @param $initialDate => Data de início de exibição no formato YYYY-MM-DD
     * @param $finalDate => Data de fim de exibição no formato YYYY-MM-DD
     * @return stdClass
     */
    public function get($initialDate, $finalDate)
    {
        $headers['Accept'] = 'application/json;version=2.1';

        return $this->getByPath(sprintf('/%s/%s?begin=%s&end=%s', MoipResource::VERSION, self::PATH, $initialDate, $finalDate), $headers);
    }

    protected function populate(stdClass $response)
    {
        $statementsList = clone $this;
        $statementsList->data = new stdClass();

        $statementsList->data->days = $response->days;
        $statementsList->data->summary = $response->summary;

        return $statementsList;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getDays()
    {
        return $this->data->days;
    }

    public function getSummary()
    {
        return $this->data->days;
    }
}
