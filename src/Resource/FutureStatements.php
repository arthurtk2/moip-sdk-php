<?php

namespace Moip\Resource;

use stdClass;

/**
 * Class Entry.
 */
class FutureStatements extends MoipResource
{
    /**
     * @const string
     */
    const PATH = 'statements/details';

    /**
     * Initializes new instances.
     */
    protected function initialize()
    {
        $this->data = new stdClass();
        $this->data->summary;
        $this->data->entries;
        $this->data->_links;
    }

    /**
     * Mount the statement.
     *
     * @param \stdClass $response
     *
     * @return Statements Statement information.
     */
    protected function populate(stdClass $response)
    {
        $statement = clone $this;

        if (isset($response->_links)) {
            $statement->data->_links = $response->_links;
        }

        if (isset($response->summary)) {
            $statement->data->summary = $response->summary;
        }

        if (isset($response->entries)) {
            $statement->data->entries = $response->entries;
        }

        return $statement;
    }

    /**
     * Create a new Statements list instance.
     *
     * @return \Moip\Resource\StatementsList
     */
    public function getList($initialDate, $finalDate)
    {
        $statementsList = new StatementsList($this->moip);

        return $statementsList->get($initialDate, $finalDate);
    }

    /**
     * Get statement data
     *
     * @param $type  => Tipo do extrato, disponível na tabela de tipos de lançamentos (https://dev.wirecard.com.br/reference#tipos-de-lan%C3%A7amentos)
     * @param $date => Data para visualizar os detalhes no formato YYYY-MM-DD
     * @return stdClass
     */
    public function get($type, $date)
    {
        $headers['Accept'] = 'application/json;version=2.1';

        return $this->getByPath(sprintf('/%s/%s?type=%s&date=%s', MoipResource::VERSION, self::PATH, $type, $date), $headers);
    }

    public function getData()
    {
        return $this->data;
    }

    public function getSummary()
    {
        return $this->data->summary;
    }

    public function getEntries()
    {
        return $this->data->entries;
    }
}
