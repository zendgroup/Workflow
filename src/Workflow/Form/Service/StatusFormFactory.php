<?php

namespace Workflow\Form\Service;

// use Traversable;
use Workflow\Form\Filter\StatusFilter;
use Workflow\Form\StatusForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class StatusFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $objectManager = $services->get('Doctrine\ORM\EntityManager');
        $filter  = new StatusFilter();
        $form    = new StatusForm($objectManager);
        $form->setInputFilter($filter);
        return $form;
    }
}
