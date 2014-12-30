<?php

/**
 * ZEND GROUP
 *
 * @name        WorkflowAssociation.php
 * @category    My
 * @package     Model
 * @subpackage  Model\Entities
 * @author      Thuy Dinh Xuan <thuydx@zendgroup.vn>
 * @copyright   Copyright (c)2008-2010 ZEND GROUP. All rights reserved
 * @license     http://zendgroup.vn/license/
 * @version     $1.0$
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

namespace Workflow\Model\Entities;

use Doctrine\ORM\Mapping as ORM;


/**
 * WorkflowAssociation
 *
 * @ORM\Table(name="workflow_association", indexes={@ORM\Index(name="workflow_id", columns={"workflow_id"}), @ORM\Index(name="status_id", columns={"status_id"})})
 * @ORM\Entity(repositoryClass="Workflow\Model\Repositories\WorkflowAssociation")
 */
class WorkflowAssociation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="association_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $associationId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var \Workflow\Model\Entities\Status
     *
     * @ORM\ManyToOne(targetEntity="Workflow\Model\Entities\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_id")
     * })
     */
    private $status;

    /**
     * @var \Workflow\Model\Entities\Workflow
     *
     * @ORM\ManyToOne(targetEntity="Workflow\Model\Entities\Workflow")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="workflow_id", referencedColumnName="workflow_id")
     * })
     */
    private $workflow;


    /**
     * Get associationId
     *
     * @return integer
     */
    public function getAssociationId()
    {
        return $this->associationId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return WorkflowAssociation
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return WorkflowAssociation
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set status
     *
     * @param \Workflow\Model\Entities\Status $status
     *
     * @return WorkflowAssociation
     */
    public function setStatus(\Workflow\Model\Entities\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Workflow\Model\Entities\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set workflow
     *
     * @param \Workflow\Model\Entities\Workflow $workflow
     *
     * @return WorkflowAssociation
     */
    public function setWorkflow(\Workflow\Model\Entities\Workflow $workflow = null)
    {
        $this->workflow = $workflow;

        return $this;
    }

    /**
     * Get workflow
     *
     * @return \Workflow\Model\Entities\Workflow
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }
}
