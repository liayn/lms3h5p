<?php
declare(strict_types = 1);

namespace LMS3\Lms3h5p\Command;

use LMS3\Lms3h5p\Setup;
use Symfony\Component\Console\Command\Command;
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
    private Setup $setup;

    public function __construct(Setup $setup)
    {
        parent::__construct();

        $this->setup = $setup;
    }

    public function configure(): void
    {
        $info = 'Run this command to copy required resources from h5p vendor packages.';

        $this->setDescription($info);
    }

    /**
     * Copy required resources from h5p vendor packages
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->setup->copyResourcesFromH5PLibraries();
        } catch (\Exception $exception) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
