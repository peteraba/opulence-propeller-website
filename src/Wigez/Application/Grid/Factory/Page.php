<?php

namespace Wigez\Application\Grid\Factory;

use Foo\Grid\Action\Button;
use Foo\Grid\Collection\Actions;
use Foo\Grid\Factory;
use Foo\Grid\Grid;
use Opulence\Routing\Router;

class Page extends Base
{
    const GROUP_ID    = 'page-id';
    const GROUP_TITLE = 'page-title';

    const HEADER_ID    = 'application:pageId';
    const HEADER_TITLE = 'application:pageTitle';

    const GETTER_ID    = 'getId';
    const GETTER_TITLE = 'getTitle';

    /** @var array */
    protected $headerAttributes = [];

    /** @var array */
    protected $bodyAttributes = [];

    /** @var Router */
    protected $router;

    /**
     * @param array $pages
     *
     * @return Grid
     */
    public function createGrid(array $pages): Grid
    {
        $getters = [static::GROUP_ID => static::GETTER_ID, static::GROUP_TITLE => static::GETTER_TITLE];
        $headers = [static::GROUP_ID => static::HEADER_ID, static::GROUP_TITLE => static::HEADER_TITLE];

        $cellActions = $this->getCellActions();

        $grid = Factory::createGrid(
            $pages,
            $getters,
            $headers,
            $this->headerAttributes,
            $this->bodyAttributes,
            $this->tableAttributes,
            $this->gridAttributes,
            $cellActions,
            null,
            $this->translator
        );

        return $grid;
    }

    /**
     * @return Actions
     */
    protected function getCellActions(): Actions
    {
        $attributeCallbacks = $this->getAttributeCallbacks();

        $editAttributes = [
            static::ATTRIBUTE_CLASS => Button::CLASS_PRIMARY,
            static::ATTRIBUTE_HREF  => ROUTE_PAGES_EDIT,
        ];

        $cellActions   = new Actions();
        $cellActions[] = new Button(
            static::LABEL_EDIT,
            Button::TAG_A,
            $editAttributes,
            $attributeCallbacks,
            $this->translator
        );

        return $cellActions;
    }
}


