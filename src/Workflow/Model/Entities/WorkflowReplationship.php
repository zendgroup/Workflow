<?php

namespace Workflow\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkflowReplationship
 *
 * @ORM\Table(name="workflow_replationship", indexes={@ORM\Index(name="status_from", columns={"status_from"}), @ORM\Index(name="status_to", columns={"status_to"}), @ORM\Index(name="fk_workflow_replationship", columns={"workflow_id"})})
 * @ORM\Entity
 */
class WorkflowReplationship
{
    /**
     * @var integer
     *
     * @ORM\Column(name="replationship_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $replationshipId;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_from", type="integer", nullable=false)
     */
    private $statusFrom;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_to", type="integer", nullable=false)
     */
    private $statusTo;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=125, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="options", type="text", length=65535, nullable=true)
     */
    private $options;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordering", type="integer", nullable=true)
     */
    private $ordering;

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
     * Get replationshipId
     *
     * @return integer
     */
    public function getReplationshipId()
    {
        return $this->replationshipId;
    }

    /**
     * Set statusFrom
     *
     * @param integer $statusFrom
     *
     * @return WorkflowReplationship
     */
    public function setStatusFrom($statusFrom)
    {
        $this->statusFrom = $statusFrom;

        return $this;
    }

    /**
     * Get statusFrom
     *
     * @return integer
     */
    public function getStatusFrom()
    {
        return $this->statusFrom;
    }

    /**
     * Set statusTo
     *
     * @param integer $statusTo
     *
     * @return WorkflowReplationship
     */
    public function setStatusTo($statusTo)
    {
        $this->statusTo = $statusTo;

        return $this;
    }

    /**
     * Get statusTo
     *
     * @return integer
     */
    public function getStatusTo()
    {
        return $this->statusTo;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return WorkflowReplationship
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return WorkflowReplationship
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set options
     *
     * @param string $options
     *
     * @return WorkflowReplationship
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set ordering
     *
     * @param integer $ordering
     *
     * @return WorkflowReplationship
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;

        return $this;
    }

    /**
     * Get ordering
     *
     * @return integer
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * Set workflow
     *
     * @param \Workflow\Model\Entities\Workflow $workflow
     *
     * @return WorkflowReplationship
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
