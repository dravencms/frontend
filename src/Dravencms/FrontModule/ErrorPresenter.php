<?php declare(strict_types = 1);

namespace Dravencms\FrontModule;

use Nette;
use Nette\Application\Responses;
use Tracy\ILogger;


class ErrorPresenter implements Nette\Application\IPresenter
{
    use Nette\SmartObject;

    /** @var ILogger */
    private $logger;

    /**
     * ErrorPresenter constructor.
     * @param ILogger $logger
     */
    public function __construct(ILogger $logger)
    {
        $this->logger = $logger;
    }


    /**
     * @param Nette\Application\Request $request
     * @return Responses\CallbackResponse
     */
    public function run(Nette\Application\Request $request): Nette\Application\Response
    {
        $e = $request->getParameter('exception');

        if ($e instanceof Nette\Application\BadRequestException) {
            list($module, , $sep) = Nette\Application\Helpers::splitName($request->getPresenterName());
            return new Responses\ForwardResponse($request->setPresenterName($module . $sep . 'Error4xx'));
        }

        $this->logger->log($e, ILogger::EXCEPTION);
        return new Responses\CallbackResponse(function () {
            require __DIR__ . '/templates/Error/500.phtml';
        });
    }

}