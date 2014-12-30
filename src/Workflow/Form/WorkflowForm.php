<?php

/**
 * ZEND GROUP
 *
 * @name Module.php
 * @category    Workflow
 *
 * @package     Workflow/Form
 *
 * @subpackage
 *
 * @author Thuy Dinh Xuan <thuydx@zendgroup.vn>
 * @link http://zendgroup.vn
 * @copyright Copyright (c) 2012-2014 ZEND GROUP. All rights reserved (http://www.zendgroup.vn)
 * @license http://zendgroup.vn/license/
 * @version $0.0.1$
 *         Dec 28, 2014
 *
 *          LICENSE
 *
 *          This source file is copyrighted by ZEND GROUP, full details in LICENSE.txt.
 *          It is also available through the Internet at this URL:
 *          http://zendgroup.vn/license/
 *          If you did not receive a copy of the license and are unable to
 *          obtain it through the Internet, please send an email
 *          to license@zendgroup.vn so we can send you a copy immediately.
 *
 */


namespace Workflow\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Workflow\Form\Fieldset\StatusFieldset;
use ZgBase\Form\ProvidesEventsForm;
use Zend\Form\Element;

class WorkflowForm extends ProvidesEventsForm
{

    protected $csrfToken;

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('workflow-form');

        $this->setHydrator(new DoctrineHydrator($objectManager, '\Workflow\Model\Entities\Workflow'));

        $statusFieldset = new StatusFieldset($objectManager);
        $statusFieldset->setUseAsBaseFieldset(true);

        $this->setName('workflow-form');
        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('method', 'POST');

        $this->addElements();
    }

    public function addElements()
    {
        $this->add(array(
            'name' => 'workflowId',
            'type' => 'Hidden'
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'title',
            'attributes' => array(
                'class' => 'form-control required'
            )
        ));

        $this->add(array(
            'type' => 'textarea',
            'name' => 'description',
            'attributes' => array(
                'class' => 'form-control',
                'style' => 'height: 100px'
            )
        ));

        $this->add(array(
            'type' => 'textarea',
            'name' => 'options',
            'attributes' => array(
                'class' => 'form-control',
                'style' => 'height: 100px'
            )
        ));
        $this->add(array(
            'type' => 'text',
            'name' => 'ordering',
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        $this->add(new Element\Csrf('csrf'));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'Submit',
                'value' => 'Submit',
                'class' => 'btn btn-primary'
            )
        ));
    }
}
