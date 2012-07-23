<?php

namespace FSC\EmailFilterBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use FSC\EmailFilterBundle\DependencyInjection\FSCEmailFilterExtension;

class FSCEmailFilterExtensionTest extends \PHPUnit_Framework_Testcase
{
    public function testExtension()
    {
        $extension = new FSCEmailFilterExtension();
        $containerBuilder = new ContainerBuilder();

        $emailFilter = array(
            'file' => null,
        );
        $extension->load(array('fsc_email_filter' => $emailFilter), $containerBuilder);
    }

    public function testExtensionWithConfig()
    {
        $extension = new FSCEmailFilterExtension();
        $containerBuilder = new ContainerBuilder();

        $emailFilter = array(
            'file' => 'filter.txt',
        );
        $extension->load(array('fsc_email_filter' => $emailFilter), $containerBuilder);

        $containerBuilder->compile();

        $this->assertEquals('filter.txt', $containerBuilder->getParameter('fsc.email_filter.validator.file'));
    }
}