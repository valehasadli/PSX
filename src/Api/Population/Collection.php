<?php

namespace App\Api\Population;

use PSX\Framework\Controller\SchemaApiAbstract;
use App\Model\Message;
use PSX\Http\Environment\HttpContextInterface;

class Collection extends SchemaApiAbstract
{
    /**
     * @Inject
     * @var \App\Service\Population
     */
    protected $populationService;

    /**
     * @QueryParam(name="startIndex", type="integer")
     * @QueryParam(name="count", type="integer")
     * @Outgoing(code=200, schema="App\Model\Collection")
     * @return \App\Model\Collection
     */
    protected function doGet(HttpContextInterface $context)
    {
        return $this->populationService->getAll(
            $context->getParameter('startIndex'),
            $context->getParameter('count')
        );
    }

    /**
     * @Incoming(schema="App\Model\Population")
     * @Outgoing(code=201, schema="App\Model\Message")
     * @param \App\Model\Population $record
     * @return \App\Model\Message
     */
    protected function doPost($record, HttpContextInterface $context)
    {
        $this->populationService->create($record);

        return new Message(true, 'Create population successful');
    }
}
