<?php

namespace spec\CubicMushroom\Symfony\StripeBundle\Form\Type;

use CubicMushroom\Symfony\StripeBundle\Form\Type\StripeType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StripeTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StripeType::class);
    }
}
