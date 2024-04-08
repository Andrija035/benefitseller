<?php

namespace App\Tests\UnitTests\Service;

use App\Entity\Card;
use App\Entity\Company;
use App\Entity\User;
use App\Service\FundsService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class FundsServiceTest extends TestCase
{
    private FundsService $fundsService;
    private EntityManagerInterface $em;

    protected function setUp(): void
    {
        parent::setUp();
        $this->em = $this->createMock(EntityManagerInterface::class);
        $this->fundsService = new FundsService($this->em);
    }

    public function testCalculateNewBalance(): void
    {
        $company = new Company('test');
        $user = new User('test@test.com', 'test', 'test', $company);
        $card = new Card($user, '1234567890123456', new \DateTime(), '123', '4375368934', 5000);
        $card->setFunds(1000);

        $amountToDeduct = 500;

        $this->em->expects($this->once())
            ->method('persist')
            ->with($card);

        $this->fundsService->calculateNewBalance($card, $amountToDeduct);

        $this->assertEquals(500, $card->getFunds());
    }

    public function testGetDiscountedAmount(): void
    {
        $discount = 20;
        $amount = 1000;

        $discountedAmount = $this->fundsService->getDiscountedAmount($discount, $amount);

        $expectedDiscountedAmount = $amount - floor($amount * ($discount / 100));

        $this->assertEquals($expectedDiscountedAmount, $discountedAmount);
    }
}
