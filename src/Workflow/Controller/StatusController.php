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
use Workflow\Model\Entities\Status;

class StatusController extends ActionController
{

    public function indexAction ()
    {
        $statusRepo = $this->getEntityManager()->getRepository(
                'Workflow\Model\Entities\Status');
        $status = $statusRepo->findAll();

        return new ViewModel(
                array(
                        'status' => $status
                ));
    }

    public function addAction ()
    {
        $_em = $this->getEntityManager();
        $entity =  new Status();

        $request = $this->getRequest();
        $statusForm = $this->getLocator('StatusForm');
        $statusForm->bind($entity);
        if ($request->isPost()) {
            $statusForm->setData($request->getPost());

            if ($statusForm->isValid()) {
                $entity->setCreated(new \DateTime("now"));
                $_em->persist($entity);
                $msg = 'Create status success';
                $_em->flush();

                $this->FlashMessenger()
                ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
                ->addMessage($msg);

                return $this->redirect()
                    ->toRoute('bo_workflow/default', array(
                        'controller'=>'status',
                        'action' => 'edit',
                        'id' => $entity->getStatusId()
                    ));
            }
        }

        return new ViewModel(array('statusForm' => $statusForm));
    }

    public function editAction ()
    {
        $_em = $this->getEntityManager();
        $_id = (int) $this->params()->fromRoute('id', 0);

        if (! $_id) {
            $msg = "Status not found!";
            $this->FlashMessenger()
            ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
            ->addMessage($msg);

            return $this->redirect()->toRoute('bo_workflow/default', array('controller' => 'status'));
        } else {
            $entity = $_em->find('Workflow\Model\Entities\Status', $_id);
        }

        if (! isset($entity) || ! $entity instanceof Status) {
            $msg = "Status not found!";
            $this->FlashMessenger()
            ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
            ->addMessage($msg);

            return $this->redirect()->toRoute('bo_workflow/default',array('controller' => 'status'));
        }
        $statusForm = $this->getLocator('StatusForm');
        $statusForm->bind($entity);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $statusForm->setData($request->getPost());
            if ($statusForm->isValid()) {
                $entity->setUpdated(new \DateTime("now"));
                $_em->merge($entity);
                $_em->flush();
                $msg = "Status was updated!";
                $this->FlashMessenger()
                ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
                ->addMessage($msg);

                return $this->redirect()->toRoute('bo_workflow/default', array(
                    'controller' => 'status',
                    'action' => 'edit',
                    'id' => $_id
                ));
            }
        }

        return new ViewModel(
            array(
                'statusForm' => $statusForm,
                '_id' => $_id,
                'status' => $entity
            ));
    }

    public function deleteAction()
    {
        $_em = $this->getEntityManager();
        $_id = (int) $this->params()->fromRoute('id', 0);
        if (! $_id) {
            $msg = "Status not found!";
            $this->FlashMessenger()
            ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
            ->addMessage($msg);

            return $this->redirect()->toRoute('bo_workflow/default',array('controller' => 'status'));
        } else {
            $entity = $_em->find('Workflow\Model\Entities\Status', $_id);
        }
        if (! isset($entity) || ! $entity instanceof Status) {
            $msg = "Status not found!";
            $this->FlashMessenger()
            ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
            ->addMessage($msg);

            return $this->redirect()->toRoute('bo_workflow/default', array('controller' => 'status'));
        }
        if ($this->request->isPost()) {
            $_em->remove($entity);
            $_em->flush();

            return $this->redirect()->toRoute('bo_workflow/default', array('controller' => 'status'));
        }

    }
}
