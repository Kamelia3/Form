<?php
namespace Form;
use Omeka\Module\AbstractModule;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractController;
use Zend\View\Renderer\PhpRenderer;

class Module extends AbstractModule
{
    /** Module body **/

    /**
     * Get this module's configuration form.
     *
     * @param ViewModel $view
     * @return string
     */
    public function getConfigForm(PhpRenderer $renderer)
    {
        return '<input type= "submit" name="valider">';
    }

    /**
     * Handle this module's configuration form.
     *
     * @param AbstractController $controller
     * @return bool False if there was an error during handling
     */
    public function handleConfigForm(AbstractController $controller)
    {
        return true;
    }
}
