<?php
declare(strict_types=1);

namespace LMS3\Lms3h5p\Command;

use LMS3\Lms3h5p\Setup;
use LMS3\Lms3h5p\Traits\ObjectManageable;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * H5P Copy Resources Command
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class H5pCopyResourcesCommand extends Command
{

    use ObjectManageable;

    /**
     * Defines the allowed options for this command
     */
    public function configure()
    {
        $this
            ->setName('h5p:copyresources')
            ->setDescription('Run this command to copy required resources from h5p vendor packages.')
            ->addArgument(
                'path',
                InputArgument::OPTIONAL
            );
    }

    /**
     * Copy required resources from h5p vendor packages
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Setup $h5pSetup */
        $h5pSetup = $this->createObject(Setup::class);
        try {
            $h5pSetup->copyResourcesFromH5PLibraries('lms3h5p', $input->getArgument('path'));
        } catch (\Exception $exception) {
            $output->writeln('<error>Something went wrong.</error>');

            return 1;
        }

        $output->writeln('<info>Resources copied successfully.</info>');

        return 0;
    }
}