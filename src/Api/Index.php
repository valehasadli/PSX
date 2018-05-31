<?php

namespace App\Api;

use PSX\Framework\Controller\ControllerAbstract;
use PSX\Framework\Controller\Tool;
use PSX\Http\RequestInterface;
use PSX\Http\ResponseInterface;

class Index extends ControllerAbstract
{
    /**
     * @Inject
     * @var \PSX\Framework\Loader\ReverseRouter
     */
    protected $reverseRouter;

    public function onGet(RequestInterface $request, ResponseInterface $response)
    {
        $data = [
            'message' => 'Welcome, this is a PSX sample application. It should help to bootstrap a project by providing all needed files and some examples.',
            'links'   => [
                [
                    'rel'   => 'routing',
                    'href'  => $this->reverseRouter->getUrl(Tool\RoutingController::class),
                    'title' => 'Gives an overview of all available routing definitions',
                ],
                [
                    'rel'   => 'documentation',
                    'href'  => $this->reverseRouter->getUrl(Tool\Documentation\IndexController::class),
                    'title' => 'Generates an API documentation from all available endpoints',
                ],
                [
                    'rel'   => 'alternate',
                    'href'  => $this->reverseRouter->getBasePath() . '/documentation/',
                    'title' => 'HTML client to view the API documentation',
                    'type'  => 'text/html',
                ],
            ]
        ];

        $this->responseWriter->setBody($response, $data, $request);
    }
}
