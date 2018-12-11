<?php
namespace Omeka_s_Module_FeedImport;
use Omeka\Module\AbstractModule;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractController;
use Zend\View\Renderer\PhpRenderer;
use Ebook\Form\ConfigForm;
use Zend\EventManager\Event;
use Zend\EventManager\SharedEventManagerInterface;
use Zend\ModuleManager\ModuleManager;
use Zend\ServiceManager\ServiceLocatorInterface;
class Module extends AbstractModule
{
    /** Module body **/

    /**
     * Get this module's configuration form.
     *
     * @param PhpRenderer $renderer
     * @return string
     */
    public function getConfigForm(PhpRenderer $renderer)
    {      
    return 'Upload file : <input type= "file" name="valider">';

    }

    public function addElements(Event $event)
    {
        $form = $event->getParam('form');
        $fieldset = new Fieldset('example');
        $fieldset->setLabel('Example Fieldset');

        $fieldset->add([
                'name' => 'example',
                'type' => 'text',
                'options' => [
                    'label' => 'Example text input', // @translate
                ],
            ]);

        $form->add($fieldset);
    }
    public function addFilters($event)
    {
        $inputFilter = $event->getParam('inputFilter');
        $inputFilter->get('Upload File')->add([
                    'name' => 'Upload File',
                    'required' => false,
                ]);
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

     public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
  
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.show.sidebar',
            [$this, 'handleAdminViewShowSidebar']
        );
 
    }

        public function handleAdminViewShowSidebar(Event $event)
    {
        $view = $event->getTarget();
        $resource = $view->resource;
        $services = $this->getServiceLocator();
        $translator = $services->get('MvcTranslator');
        $query = [];
        $query['resource_type'] = $resource->resourceName();
        $query['resource_ids'] = [$resource->id()];
        $link = $view->hyperlink(
            $translator->translate('Upload File'), // @translate
            $view->url('admin/Omeka_s_Module_FeedImport/default', ['action' => 'create'], ['query' => $query])
        );
        echo '<div class="meta-group">'
            . '<h4>' . $translator->translate('Upload File') . '</h4>'
            . '<div class="value">' . $link . '</div>'
            . '</div>';
    }
}
