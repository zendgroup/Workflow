<?php
namespace Workflow\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Workflow\Form\Fieldset\StatusFieldset;
use Zend\Form\Form;
use Zend\Form\Element;

class StatusForm extends Form
{

    protected $csrfToken;

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('content-type-form');

        $this->setHydrator(new DoctrineHydrator($objectManager, '\Workflow\Model\Entities\Status'));

        $statusFieldset = new StatusFieldset($objectManager);
        $statusFieldset->setUseAsBaseFieldset(true);
        $this->add($statusFieldset);
        $this->setName(str_replace('form', '-form', strtolower(__CLASS__)));
        $this->setAttribute('class', 'form-horizontal tasi-form');
        $this->setAttribute('method', 'POST');

        $this->addElements();
    }

    public function addElements()
    {
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden'
        ));

        $this->add(new Element\Csrf('csrf'));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'Submit',
                'value' => 'Submit',
                'class' => 'btn btn-info'
            )
        ));
    }
}