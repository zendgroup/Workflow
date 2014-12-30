<?php
namespace Workflow\Form\Fieldset;

use Workflow\Model\Entities\Status;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class StatusFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct (ObjectManager $objectManager)
    {
        parent::__construct('status');
        $this->setHydrator(new DoctrineHydrator($objectManager))->setObject(new Status());

        $this->add(array(
            'type' => 'text',
            'attributes' => array(
                'name' => 'title',
                'class' => 'form-control required'
            ),
            'options' => array(
                'label' => 'Status Title',
            )
        ));

        $this->add(array(
            'type' => 'textarea',
            'attributes' => array(
                'name' => 'description',
                'class' => 'form-control',
                'style' => 'height: 100px'
            ),
            'options' => array(
                'label' => 'Description'
            )
        ));

        $this->add(array(
            'type' => 'textarea',
            'attributes' => array(
                'name' => 'options',
                'class' => 'form-control',
                'style' => 'height: 100px'
            ),
            'options' => array(
                'label' => 'Options'
            )
        ));
    }

    public function getInputFilterSpecification ()
    {
        return array(
            'title' => array(
                'required' => true
            )
        );
    }
}
