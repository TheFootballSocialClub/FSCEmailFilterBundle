<?php

namespace FSC\EmailFilterBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Email extends Constraint
{
    public $emailMessage = 'This is not an authorized email.';
    public $domainMessage = 'This is not an authorized email domain.';

    public function validatedBy()
    {
        return 'fsc.validator.email_filter';
    }
}
