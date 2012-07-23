<?php

namespace FSC\EmailFilterBundle\Validator;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class EmailValidator extends ConstraintValidator
{
    protected $domains = array();
    protected $emails = array();

    /**
     * Parse the emails file.
     *
     * @param $file The file that contains the emails to filter.
     */
    public function __construct($file)
    {
        if (!file_exists($file)) {
            throw new \InvalidArgumentException('The file must exists.');
        }

        $fileContent = file_get_contents($file);

        preg_match_all('#([^\s]+(@)[^\s]+)\s#', $fileContent, $emailMatches);
        preg_match_all('#(?:\s|$)@?([^\s@]+)\s#', $fileContent, $domainsMatches);

        $this->emails = $emailMatches[1];
        $this->domains = $domainsMatches[1];
    }

    public function isValid($value, Constraint $constraint)
    {
        foreach ($this->domains as $domain) {
            if (false !== stripos($value, $domain)) {
                $this->setMessage($constraint->domainMessage);

                return false;
            }
        }

        foreach ($this->emails as $email) {
            if (0 === stripos($value, $email)) {
                $this->setMessage($constraint->emailMessage);

                return false;
            }
        }

        return true;
    }
}
