<?php

namespace CubicMushroom\Symfony\StripeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;

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


    /**
     * Just ensures that no data is submitted with this form field, as it should be protected
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(
            new CallbackTransformer(
                function ($originalDescription) {
                    return $originalDescription;
                },
                function ($submittedDescription) {
                    if (!is_null($submittedDescription)) {
                        throw new \RuntimeException(
                            'Sensitive data has been submitted via you\'re form!!!  This should not happen unless '.
                            "your server is PCI compliant.\n".
                            'The '.__CLASS__.'::finishView() method should prevent the name attribute being added to '.
                            'the field.'
                        );
                    }
                }
            )
        );
    }


}
