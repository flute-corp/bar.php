<?php
namespace ApiBundle\Mixin;


use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

trait ConstraintViolationValidable
{
    public function checkErrors(ConstraintViolationListInterface $validationErrors) {
        if (count($validationErrors) > 0) {
            $firstError = $validationErrors->get(0);
            throw new NotAcceptableHttpException($firstError->getMessage());
        }
    }
}