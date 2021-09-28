<?php
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types = 1);

namespace LMS3\Lms3h5p\Command;

use LMS3\Lms3h5p\H5PAdapter\TYPO3H5P;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * H5P Config Setting Command
 *
 * @author Sagar Desai <sagar.desai@lms3.de>
 * (c) 2019 LEARNTUBE! GmbH - Contact: mail@learntube.de
 *
 * The H5P software is licensed under the MIT license.
 * Please visit: https://h5p.org/MIT-licensed
 *
 * H5P is a brandmark of Joubel AS - Contact: https://joubel.com/
 */
class H5pConfigSettingCommand extends Command
{
    private array $ts;
    private TYPO3H5P $h5p;

    public function __construct(ConfigurationManager $manager, TYPO3H5P $h5p)
    {
        parent::__construct();

        $this->h5p = $h5p;

        $this->ts = $manager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'Lms3h5p',
            'Pi1'
        );
    }

    public function configure(): void
    {
        $info = 'Run this command to add required configuration settings';

        $this->setDescription($info);
    }

    /**
     * Add h5p settings in database table
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $interface = $this->h5p->getH5PInstance('interface');

        if (empty($this->ts['config'])) {
            return Command::FAILURE;
        }

        foreach ($this->ts['config'] as $name => $value) {
            $interface->setOption($name, $value);
        }

        return Command::SUCCESS;
    }
}
