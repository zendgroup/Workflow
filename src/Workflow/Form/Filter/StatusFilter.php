<?php
namespace Workflow\Form\Filter;

use Zend\InputFilter\InputFilter;

class StatusFilter extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name' => 'title',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 3,
                        'max' => 128
                    )
                )
            ),
            array(
                'name' => 'not_empty'
            )
        ));
        $this->add(array(
            'name' => 'description',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 0,
                        'max' => 255
                    )
                )
            )
        ));
        $this->add(array(
            'name' => 'options',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StripTags'
                ),
                array(
                    'name' => 'StringTrim'
                )
            )
        ));
    }
}
