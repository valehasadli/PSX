<?php

namespace App\Api\Population;

use PSX\Framework\Controller\SchemaApiAbstract;
use App\Model\Message;
use PSX\Http\Environment\HttpContextInterface;

/**
 * @Title("Population")
 * @Description("and some more long description")
 * @PathParam(name="id", type="integer")
 */
class Entity extends SchemaApiAbstract
{
    /**
     * @Inject
     * @var \App\Service\Population
     */
    protected $populationService;

    /**
     * @Outgoing(code=200, schema="App\Model\Population")
     * @return \PSX\Record\Record
     */
    protected function doGet(HttpContextInterface $context)
    {
        return $this->populationService->get(
            $context->getUriFragment('id')
        );
    }

    /**
     * @Incoming(schema="App\Model\Population")
     * @Outgoing(code=200, schema="App\Model\Message")
     * @param \App\Model\Population $record
     * @return \App\Model\Message
     */
    protected function doPut($record, HttpContextInterface $context)
    {
        $this->populationService->update(
            $context->getUriFragment('id'),
            $record
        );

        return new Message(true, 'Update successful');
    }

    /**
     * @Outgoing(code=200, schema="App\Model\Message")
     * @return \App\Model\Message
     */
    protected function doDelete($record, HttpContextInterface $context)
    {
        $this->populationService->delete(
            $context->getUriFragment('id')
        );

        return new Message(true, 'Delete successful');
    }
}
