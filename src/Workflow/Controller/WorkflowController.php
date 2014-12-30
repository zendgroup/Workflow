<?php

/**
 * ZEND GROUP
 *
 * @name Module.php
 * @category    Workflow
 *
 * @package     Workflow/Controller
 *
 * @subpackage
 *
 * @author Thuy Dinh Xuan <thuydx@zendgroup.vn>
 * @link http://zendgroup.vn
 * @copyright Copyright (c) 2012-2014 ZEND GROUP. All rights reserved (http://www.zendgroup.vn)
 * @license http://zendgroup.vn/license/
 * @version $0.0.1$
 *         Dec 27, 2014
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

namespace Workflow\Controller;
use ZgBase\Mvc\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Workflow\Model\Entities\Workflow;

class WorkflowController extends ActionController
{

    public function indexAction ()
    {
        $workflowRepo = $this->getEntityManager()
                        ->getRepository('Workflow\Model\Entities\Workflow');
        $workflow = $workflowRepo->findAll();

        return new ViewModel(array('workflow' => $workflow));
    }

    public function addAction ()
    {
        $_em = $this->getEntityManager();
        $entity =  new Workflow();

        $request = $this->getRequest();
        $workflowForm = $this->getLocator('WorkflowForm');
        $workflowForm->bind($entity);
        if ($request->isPost()) {
            $workflowForm->setData($request->getPost());

            if ($workflowForm->isValid()) {
                $entity->setCreated(new \DateTime("now"));
                $_em->persist($entity);
                $msg = 'Create workflow success';
                $_em->flush();

                $this->FlashMessenger()
                ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
                ->addMessage($msg);

                return $this->redirect()
                    ->toRoute('bo_workflow/default', array(
                        'controller'=>'workflow',
                        'action' => 'edit',
                        'id' => $entity->getWorkflowId()
                    ));
            }
        }

        return new ViewModel(array('workflowForm' => $workflowForm));
    }

    public function editAction ()
    {
        $_em = $this->getEntityManager();
        $_id = (int) $this->params()->fromRoute('id', 0);

        if (! $_id) {
            $msg = "Workflow not found!";
            $this->FlashMessenger()
            ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
            ->addMessage($msg);

            return $this->redirect()->toRoute('bo_workflow/default', array('controller' => 'workflow'));
        } else {
            $entity = $_em->find('Workflow\Model\Entities\Workflow', $_id);
        }

        if (! isset($entity) || ! $entity instanceof Workflow) {
            $msg = "Workflow not found!";
            $this->FlashMessenger()
            ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
            ->addMessage($msg);

            return $this->redirect()->toRoute('bo_workflow/default',array('controller' => 'workflow'));
        }
        $workflowForm = $this->getLocator('WorkflowForm');
        $workflowForm->bind($entity);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $workflowForm->setData($request->getPost());
            if ($workflowForm->isValid()) {
                $entity->setUpdated(new \DateTime("now"));
                $_em->merge($entity);
                $_em->flush();
                $msg = "Workflow was updated!";
                $this->FlashMessenger()
                ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
                ->addMessage($msg);

                return $this->redirect()->toRoute('bo_workflow/default', array(
                    'controller' => 'workflow',
                    'action' => 'edit',
                    'id' => $_id
                ));
            }
        }

        return new ViewModel(
            array(
                'workflowForm' => $workflowForm,
                '_id' => $_id,
                'workflow' => $entity
            ));
    }

    public function deleteAction()
    {
        $_em = $this->getEntityManager();
        $_id = (int) $this->params()->fromRoute('id', 0);
        if (! $_id) {
            $msg = "Workflow not found!";
            $this->FlashMessenger()
            ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
            ->addMessage($msg);

            return $this->redirect()->toRoute('bo_workflow/default',array('controller' => 'workflow'));
        } else {
            $entity = $_em->find('Workflow\Model\Entities\Workflow', $_id);
        }
        if (! isset($entity) || ! $entity instanceof Workflow) {
            $msg = "Workflow not found!";
            $this->FlashMessenger()
            ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
            ->addMessage($msg);

            return $this->redirect()->toRoute('bo_workflow/default', array('controller' => 'workflow'));
        }
        if ($this->request->isPost()) {
            $_em->remove($entity);
            $_em->flush();

            return $this->redirect()->toRoute('bo_workflow/default', array('controller' => 'workflow'));
        }

    }
}
