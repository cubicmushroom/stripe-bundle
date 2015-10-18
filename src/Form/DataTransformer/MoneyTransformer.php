<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 18/10/15
 * Time: 17:00
 */

namespace CubicMushroom\Symfony\StripeBundle\Form\DataTransformer;

use Money\Currency;
use Money\Money;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class MoneyTransformer
 *
 * @package CubicMushroom\Symfony\StripeBundle
 */
class MoneyTransformer implements DataTransformerInterface
{

    /**
     * Transforms a value from the original representation to a transformed representation.
     *
     * This method is called on two occasions inside a form field:
     *
     * 1. When the form field is initialized with the data attached from the datasource (object or array).
     * 2. When data from a request is submitted using {@link Form::submit()} to transform the new input data
     *    back into the renderable format. For example if you have a date field and submit '2009-10-10'
     *    you might accept this value because its easily parsed, but the transformer still writes back
     *    "2009/10/10" onto the form field (for further displaying or other purposes).
     *
     * This method must be able to deal with empty values. Usually this will
     * be NULL, but depending on your implementation other empty values are
     * possible as well (such as empty strings). The reasoning behind this is
     * that value transformers must be chainable. If the transform() method
     * of the first value transformer outputs NULL, the second value transformer
     * must be able to process that value.
     *
     * By convention, transform() should return an empty string if NULL is
     * passed.
     *
     * @param null|Money $moneyObject The value in the original representation
     *
     * @return mixed The value in the transformed representation
     */
    public function transform($moneyObject)
    {
        if (null === $moneyObject) {
            return '';
        }

        if (!$moneyObject instanceof Money) {
            throw new TransformationFailedException(
                sprintf('Value is expected to be of type \\Money\\Money, but %s given', get_class($moneyObject))
            );
        }

        return $moneyObject->getAmount() / 100;
    }


    /**
     * Transforms a value from the transformed representation to its original
     * representation.
     *
     * This method is called when {@link Form::submit()} is called to transform the requests tainted data
     * into an acceptable format for your data processing/model layer.
     *
     * This method must be able to deal with empty values. Usually this will
     * be an empty string, but depending on your implementation other empty
     * values are possible as well (such as empty strings). The reasoning behind
     * this is that value transformers must be chainable. If the
     * reverseTransform() method of the first value transformer outputs an
     * empty string, the second value transformer must be able to process that
     * value.
     *
     * By convention, reverseTransform() should return NULL if an empty string
     * is passed.
     *
     * @param string $moneyString The value in the transformed representation
     *
     * @return Money|null The value in the original representation
     *
     * @throws TransformationFailedException When the transformation fails.
     */
    public function reverseTransform($moneyString)
    {
        if ('' === $moneyString) {
            return null;
        }

        if (!is_string($moneyString)) {
            throw new TransformationFailedException(
                sprintf('Value is expected to be a string, but %s given', gettype($moneyString))
            );
        }

        return new Money((int)$moneyString * 100, new Currency('GBP'));
    }
}