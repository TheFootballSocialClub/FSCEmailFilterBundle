<?php

namespace FSC\EmailFilterBundle\Tests\Validator;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

use FSC\EmailFilterBundle\Validator\Email;

use FSC\EmailFilterBundle\Validator\EmailValidator;

class EmailValidatorTest extends \PHPUnit_Framework_Testcase
{
    protected $file_path;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->file_path = __DIR__.'/../emailSample.txt';
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testEmptyInstance()
    {
        $emailValidator = new EmailValidator();
    }

    public function testInstance()
    {
        $emailValidator = new EmailValidator($this->file_path);
    }

    public function testProperties()
    {
        $emailValidator = new EmailValidator($this->file_path);
        $emailValidatorReflection = new \ReflectionClass($emailValidator);
        $domains = $emailValidatorReflection->getProperty('domains');
        $domains->setAccessible(true);
        $emails = $emailValidatorReflection->getProperty('emails');
        $emails->setAccessible(true);

        $this->assertEquals(array('jetable.fr.nf'), $domains->getValue($emailValidator));
        $this->assertEquals(array('wecanbanasingleemail@foo.com'), $emails->getValue($emailValidator));
    }

    /**
     * @dataProvider getTestEmailsValid
     */
    public function testEmailValid($email)
    {
        $emailValidator = new EmailValidator($this->file_path);
        $emailValidator->initialize($this->context);
        $this->assertTrue($emailValidator->isValid($email, new Email()));
    }

    public function getTestEmailsValid()
    {
        return array(
            array('valid_email@test.com'),
            array('106003@supinfo.com'),
            array('valid-email@test.com'),
            array('valid.email@plop.com'),
        );
    }

    /**
     * @dataProvider getTestEmailsInvalid
     */
    public function testEmailInvalid($email)
    {
        $emailValidator = new EmailValidator($this->file_path);
        $emailValidator->initialize($this->context);
        $this->assertFalse($emailValidator->isValid($email, new Email()));
    }

    public function getTestEmailsInvalid()
    {
        return array(
            array('wecanbanasingleemail@foo.com'),
            array('plop@jetable.fr.nf'),
            array('email@jetable.fr.nf'),
        );
    }
}
