<?php

namespace Project\Application\Http\Views\Builders;

use Opulence\Views\Factories\IViewBuilder;
use Opulence\Views\IView;

/**
 * Defines the master view builder
 */
class WebsiteBuilder implements IViewBuilder
{
    /**
     * @inheritdoc
     */
    public function build(IView $view): IView
    {
        $view->setVar('title', 'Ecomp.co.hu - Ügyvitel, Import-Export, Tanácsadás, Szoftver');

        // Default to empty meta data
        $view->setVar('metaKeywords', []);
        $view->setVar('metaDescription', '');
        // Set default variable values
        $view->setVar('css', '/website/css/style.css');

        return $view;
    }
}
