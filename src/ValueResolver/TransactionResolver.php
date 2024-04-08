<?php

namespace App\ValueResolver;

use App\Dto\TransactionDto;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsTargetedValueResolver;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsTargetedValueResolver('transaction')]
class TransactionResolver implements ValueResolverInterface
{
    public function __construct(
        private readonly DenormalizerInterface $denormalizer,
        private readonly ValidatorInterface $validator,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $data = json_decode($request->getContent());

        $data = [
            'cardNumber' => $data->cardNumber ?? '',
            'merchantId' => $data->merchantId ?? 0,
            'amount' => $data->amount ?? 0,
        ];

        $transactionDto = $this->denormalizer->denormalize($data, TransactionDto::class);

        $errors = $this->validator->validate($transactionDto);

        if (count($errors) > 0) {
            $errorMessages = [];

            foreach ($errors as $error) {
                $errorMessages[] = $error->getPropertyPath() . ': ' . $error->getMessage();
            }

            $errorMessage = implode('|', $errorMessages);

            $this->logger->error($errorMessage, $data);
            throw new \Exception($errorMessage);
        }

        yield $transactionDto;
    }
}
