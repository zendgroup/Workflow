<?php

/**
 * ZEND GROUP
 *
 * @name Module.php
 * @category    Workflow
 *
 * @package     Workflow/Form
 *
 * @subpackage  Service
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

namespace Workflow\Form\Service;

// use Traversable;
use Workflow\Form\Filter\WorkflowFilter;
use Workflow\Form\WorkflowForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WorkflowFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $objectManager = $services->get('Doctrine\ORM\EntityManager');
        $filter  = new WorkflowFilter();
        $form    = new WorkflowForm($objectManager);
        $form->setInputFilter($filter);
        return $form;
    }
}
