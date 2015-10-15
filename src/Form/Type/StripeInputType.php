<?php

namespace CubicMushroom\Symfony\StripeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

/**
 * Class StripeInputType
 *
 * @package CubicMushroom\Symfony\StripeBundle
 *
 * @see     \spec\CubicMushroom\Symfony\StripeBundle\Form\Type\StripeInputTypeSpec
 */
class StripeInputType extends AbstractType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'cm_stripe_input';
    }


    /**
     * @return string
     */
    public function getParent()
    {
        return 'text';
    }


}
