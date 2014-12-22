<?php
/**
 * ZEND GROUP
 *
 * @name Module.php
 * @category
 *
 * @package
 *
 * @subpackage
 *
 * @author Thuy Dinh Xuan <thuydx@zendgroup.vn>
 * @link http://zendgroup.vn
 * @copyright Copyright (c) 2012-2014 ZEND GROUP. All rights reserved (http://www.zendgroup.vn)
 * @license http://zendgroup.vn/license/
 * @version $0.0.1$
 *          Dec 20, 2014
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
namespace Workflow;

use Zend\Mvc\ModuleRouteListener;
use Zend\EventManager\EventInterface;
use ZgBase\Module\AbstractModule;
use ZgBase\Mvc\Service\ControlAbstractFactory;

class Module extends AbstractModule
{

    public function getDir()
    {
        return __DIR__;
    }

    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    public function getControllerConfig()
    {
        return array(
            'abstract_factories' => array(
                new ControlAbstractFactory(__NAMESPACE__)
            )
        );
    }
}
