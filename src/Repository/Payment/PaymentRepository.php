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
use Doctrine\DBAL\Connection;
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
        $em = $this->getEntityManager();
        $em->persist($payment);
        $em->flush($payment);

        return new PaymentId($payment->getId());
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
        $connection = $this->getConnection();
        $table      = $this->getTableName();

        try {
            $connection->update(
                $table,
                ['paid' => true, 'gateway_id' => $payment->getGatewayId()],
                ['id' => $payment->id()]
            );
        } catch (\Exception $exception) {
            throw SavePaymentFailedException::createWithPayment(
                $payment,
                sprintf('Unable to mark payment #%s as paid', $payment->id()),
                0,
                $exception
            );
        }
    }


    /**
     * @return Connection
     */
    protected function getConnection()
    {
        return $this->getEntityManager()->getConnection();
    }


    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getTableName()
    {
        $em = $this->getEntityManager();

        return $em->getClassMetadata($this->getEntityName())->getTableName();
    }
}