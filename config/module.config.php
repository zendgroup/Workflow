<?php
/**
 * ZEND GROUP
 *
 * @name        module.config.php
 * @category
 * @package
 * @subpackage
 * @author      Thuy Dinh Xuan <thuydx@zendgroup.vn>
 * @link        http://zendgroup.vn
 * @copyright   Copyright (c) 2012-2014 ZEND GROUP. All rights reserved (http://www.zendgroup.vn)
 * @license     http://zendgroup.vn/license/
 * @version     $0.0.1$
 * Dec 20, 2014
 *
 * LICENSE
 *
 * This source file is copyrighted by ZEND GROUP, full details in LICENSE.txt.
 * It is also available through the Internet at this URL:
 * http://zendgroup.vn/license/
 * If you did not receive a copy of the license and are unable to
 * obtain it through the Internet, please send an email
 * to license@zendgroup.vn so we can send you a copy immediately.
 *
 */
namespace Workflow;
return array(
    'router' => array(
        'routes' => array(
            'admincp_workflow' => array(
                'type' => 'Zend\\Mvc\\Router\\Http\\Segment',
                'options' => array(
                    'route' => '/admincp[/:module][/:controller][/:action][/id/:id][/from/:from][/to/:to][/page/:page][/gid/:gid][/pid/:pid][/lang/:lang][/status/:status][/detail/:detail][/][/version/:version][/]',
                    'constraints' => array(
                        'module' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                        'page' => '[0-9]*',
                        'detail' => '[0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Workflow\Controller',
                        'module' => 'workflow',
                        'controller' => 'Workflow\Controller\Index',
                        'action' => 'index',
                        'id' => 0,
                        'page' => 1
                    )
                )
            ),
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext', 'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true, 'display_exceptions' => true,
        'doctype' => 'HTML5', 'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/admin_layout' => BACKEND_TEMPLATES_PATH . 'layout/layout.phtml',
            'layout/head' => BACKEND_TEMPLATES_PATH . 'layout/head.phtml',
            'layout/header' => BACKEND_TEMPLATES_PATH . 'layout/header.phtml',
            'layout/left-sidebar' => BACKEND_TEMPLATES_PATH . 'layout/sidebar/left-sidebar.phtml',
            'layout/breadcrumbs' => BACKEND_TEMPLATES_PATH . 'layout/breadcrumbs.phtml',
            'layout/statistic' => BACKEND_TEMPLATES_PATH . 'layout/statistic.phtml',
            'error/404' => BACKEND_TEMPLATES_PATH . 'error/404.phtml',
            'error/index' => BACKEND_TEMPLATES_PATH . 'error/index.phtml',
            'index/index' => __DIR__ . '/../view/workflow/index/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'layout' => array(
        'module_layouts' => array(
            'workflow' => 'layout/admin_layout'
        ),
        'controller_layouts' => array(),
        'action_layouts' => array()
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'Workflow_Model_Entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ .  "/../src/". __NAMESPACE__ ."/Model/Entities"
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    'My\Model\Entities' => 'Workflow_Model_Entities'
                )
            )
        ),
        'configuration' => array(
            'orm_default' => array(
                'proxy_dir' => DOCTRINE_PROXY_DIR,
                'proxy_namespace' => 'DoctrineORMModule\Proxy',
            )
        )
    )
);
