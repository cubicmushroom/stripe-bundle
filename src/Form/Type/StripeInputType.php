<?php

namespace CubicMushroom\Symfony\StripeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(['stripe_data']);
    }


    /**
     * Providing this for forward compatibility with Symfony 3.0
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $this->setDefaultOptions($resolver);
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


    /**
     * Strips out the field name so that the data will never be submitted to the server
     *
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        throw new \RuntimeException('You have not finished me yet!,  I need to ensure data is not submitted!');
    }


}
