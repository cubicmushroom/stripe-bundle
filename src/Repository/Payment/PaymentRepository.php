<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 18/10/15
 * Time: 19:58
 */

namespace CubicMushroom\Symfony\StripeBundle\Repository\Payment;

use CubicMushroom\Payments\Stripe\Domain\Payment\Payment;
use CubicMushroom\Payments\Stripe\Domain\Payment\PaymentId;
use CubicMushroom\Payments\Stripe\Domain\Payment\PaymentRepositoryInterface;
use CubicMushroom\Payments\Stripe\Exception\Domain\Payment\SavePaymentFailedException;
use Doctrine\ORM\EntityRepository;

/**
 * Class PaymentRepository
 *
 * @package CubicMushroom\Symfony\StripeBundle
 */
class PaymentRepository extends EntityRepository implements PaymentRepositoryInterface
{

    /**
     * Should save a new payment record, and mark it as unpaid
     *
     * @param Payment $payment
     *
     * @return PaymentId
     *
     * @throws SavePaymentFailedException
     */
    public function savePaymentBeforeProcessing(Payment $payment)
    {
        throw new \RuntimeException('Finish me');
    }


    /**
     * @param Payment $payment
     *
     * @return void
     *
     * @throws SavePaymentFailedException
     */
    public function markAsPaid(Payment $payment)
    {
        throw new \RuntimeException('Finish me');
    }
}