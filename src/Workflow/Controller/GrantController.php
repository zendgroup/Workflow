<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Workflow\Controller;

use ZgBase\Mvc\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Workflow\Model\Entities\WorkflowAssociation;

class GrantController extends ActionController
{
    public function indexAction()
    {
        $statusRepo = $this->getEntityManager()->getRepository('Workflow\Model\Entities\Status');
        $status = $statusRepo->findAll();
//         echo "<pre> \n"; print_r($status[0]->getTitle()); die("<br />\n Debug in: ". __METHOD__ );
        return new ViewModel(array('status' => $status));
    }

    public function statusAction()
    {
        $_id = (int) $this->params()->fromRoute('id', 0);

        if (! $_id) {
            $msg = "Workflow not found!";
            $this->FlashMessenger()
            ->setNamespace(\Zend\Mvc\Controller\Plugin\FlashMessenger::NAMESPACE_INFO)
            ->addMessage($msg);

            return $this->redirect()->toRoute('bo_workflow/default', array('controller' => 'workflow'));
        } else {
            $_em = $this->getEntityManager();
            $workflowRepo = $this->getEntityManager()->getRepository('Workflow\Model\Entities\Workflow');
            $workflow = $workflowRepo->findOneBy(array('workflowId' => $_id));
        }

        $statusRepo = $this->getEntityManager()->getRepository('Workflow\Model\Entities\Status');
        $status = $statusRepo->findAll();

        if ($this->request->isPost()) {
            $selectedStatus = $this->request->getPost('selectedStatus');
            if (count($selectedStatus)) {
                foreach ($selectedStatus as $statusId) {
                    $assoc = new WorkflowAssociation();
                    $assoc->setStatus($statusRepo->find($statusId));
                    $assoc->setWorkflow($workflow);
                    if ($this->existsStatus($_id, $statusId)) {
                        $assoc->setUpdated(new \DateTime("now"));
                    } else {
                        $assoc->setCreated(new \DateTime("now"));
                    }
                    /**
                     * @todo add new field enable to set enable/disable status in workflow.
                     * @todo check the workflow association to enable/disable or remove status from association
                     */
                    $_em->persist($assoc);
                    $_em->flush();
                }
            }
        }




        $assocRepo = $this->getEntityManager()->getRepository('Workflow\Model\Entities\WorkflowAssociation');
        $association = $assocRepo->findBy(array('workflow' => $_id));


        $data = array(
            'status'    => $status,
            'association'  => $association,
            '_id'   => $_id
        );
        return new ViewModel($data);
    }

    protected function existsStatus($workflowId, $statusId) {
        $assocRepo = $this->getEntityManager()->getRepository('Workflow\Model\Entities\WorkflowAssociation');
        $association = $assocRepo->findBy(array('workflow' => $workflowId, 'status' => $statusId));
        if ($association instanceof WorkflowAssociation) {
            $assocId = $association->getAssociationId();
            if($assocId) {
                return true;
            }
        }

        return false;
    }
}
