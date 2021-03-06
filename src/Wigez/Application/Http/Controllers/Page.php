<?php

namespace Wigez\Application\Http\Controllers;

use Foo\I18n\ITranslator;
use Foo\Session\FlashService;
use Opulence\Http\Responses\Response;
use Opulence\Orm\IUnitOfWork;
use Opulence\Routing\Urls\UrlGenerator;
use Opulence\Sessions\ISession;
use Wigez\Application\Grid\Factory\Page as GridFactory;
use Wigez\Application\Validation\Factory\Page as ValidatorFactory;
use Wigez\Domain\Entities\IStringerEntity;
use Wigez\Domain\Entities\Page as Entity;
use Wigez\Infrastructure\Orm\PageRepo as Repo;

class Page extends CrudAbstract
{
    const ENTITY_SINGULAR = 'page';
    const ENTITY_PLURAL   = 'pages';

    const ENTITY_TITLE_SINGULAR = 'application:page';
    const ENTITY_TITLE_PLURAL   = 'application:pages';

    /** @var GridFactory */
    protected $gridFactory;

    /** @var Repo */
    protected $repo;

    /** @var UrlGenerator */
    protected $urlGenerator;

    /** @var ValidatorFactory */
    protected $validatorFactory;

    /**
     * Helps DIC figure out the dependencies
     *
     * @param ISession              $session
     * @param UrlGenerator          $urlGenerator
     * @param GridFactory           $gridFactory
     * @param Repo                  $repo
     * @param ITranslator           $translator
     * @param FlashService          $flashService
     * @param ValidatorFactory|null $validatorFactory
     * @param IUnitOfWork|null      $unitOfWork
     */
    public function __construct(
        ISession $session,
        UrlGenerator $urlGenerator,
        GridFactory $gridFactory,
        Repo $repo,
        ITranslator $translator,
        FlashService $flashService,
        ValidatorFactory $validatorFactory = null,
        IUnitOfWork $unitOfWork = null
    ) {
        parent::__construct(
            $session,
            $urlGenerator,
            $gridFactory,
            $repo,
            $translator,
            $flashService,
            $validatorFactory,
            $unitOfWork
        );
    }

    /**
     * @return Response
     */
    public function show(): Response
    {
        $this->viewVarsExtra[static::VAR_CREATE_URL] = '';

        return parent::show();
    }

    /**
     * @param int|null $id
     *
     * @return Entity
     */
    protected function createEntity(int $id = null): IStringerEntity
    {
        $id    = (int)$id;
        $title = '';
        $body  = '';

        $entity = new Entity($id, $title, $body);

        return $entity;
    }

    /**
     * @param Entity $entity
     *
     * @return Entity
     */
    protected function fillEntity(IStringerEntity $entity): IStringerEntity
    {
        $post = $this->request->getPost()->getAll();

        $title = (string)$post['title'];
        $body  = (string)$post['body'];

        $entity->setBody($body)->setTitle($title);

        return $entity;
    }
}
