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

class IndexController extends ActionController
{
    public function indexAction()
    {
        $statusRepo = $this->getEntityManager()->getRepository('Workflow\Model\Entities\Status');
        $status = $statusRepo->findAll();
//         echo "<pre> \n"; print_r($status[0]->getTitle()); die("<br />\n Debug in: ". __METHOD__ );
        return new ViewModel(array('status' => $status));
    }
}
