<?php
/**
 * @author: Ulrich-Matthias Schäfer
 * @creation: 28.07.16 12:51
 * @package: testbed
 */

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class HiddenInputCommand extends ContainerAwareCommand{


    protected function configure()
    {

        $this
            ->setName('testbed:hidden')
            ->setDescription('Shows bug when use hiddeninput.exe');
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {

        $questionHelper = $this->getHelper('question');

        $question = new Question('Enter some chars - nobody can see them!');
        $question->setHidden(true);
        $answer = $questionHelper->ask($input, $output, $question);

        $output->writeln("You entered the following chars:\n". $answer);

    }

    protected function execute(InputInterface $input, OutputInterface $output){
        // nope
        return;
    }

} 