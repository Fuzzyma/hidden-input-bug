<?php
/**
 * @author: Ulrich-Matthias Schäfer
 * @creation: 28.07.16 12:56
 * @package: testbed
 */

namespace Tests\AppBundle\Command;


use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use AppBundle\Command\HiddenInputCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\Container;

class HiddenInputCommandTest extends \PHPUnit_Framework_TestCase{

    public function testHiddenInput(){

        $command = $command = new HiddenInputCommand('testbed:hidden');
        $command->setContainer($this->getContainer());
        $command->setHelperSet($this->getHelperSet("SomeRandomInputString\n"));

        $tester = new CommandTester($command);
        $code = $tester->execute([]);

        $this->assertContains("You entered the following chars:\nSomeRandomInputString", $tester->getDisplay());

    }



    protected function getHelperSet($input)
    {
        $question = new QuestionHelper();
        $question->setInputStream($this->getInputStream($input));

        return new HelperSet(array(new FormatterHelper(), $question));
    }

    protected function getInputStream($input)
    {
        $stream = fopen('php://memory', 'r+', false);
        fwrite($stream, $input.str_repeat("\n", 10));
        rewind($stream);

        return $stream;
    }

    protected function getContainer()
    {
        $kernel = $this->getMockBuilder('Symfony\Component\HttpKernel\KernelInterface')->getMock();

        $container = new Container();
        $container->set('kernel', $kernel);

        $container->setParameter('kernel.root_dir', sys_get_temp_dir());

        return $container;
    }
} 