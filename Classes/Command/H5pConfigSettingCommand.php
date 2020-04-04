<?php
declare(strict_types = 1);

namespace LMS3\Lms3h5p\Command;

use LMS3\Lms3h5p\H5PAdapter\TYPO3H5P;
use LMS3\Lms3h5p\Traits\ObjectManageable;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;

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
    use ObjectManageable;

    /**
     * Defines the allowed options for this command
     */
    public function configure()
    {
        $this
            ->setName('h5p:configsetting')
            ->setDescription('Run this command to add required configuration settings');
    }

    /**
     * Add h5p settings in database table
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $configurationManager = $this->createObject(ConfigurationManager::class);
        $h5pSettings = $configurationManager->getConfiguration(
            ConfigurationManager::CONFIGURATION_TYPE_SETTINGS,
            'Lms3h5p',
            'Pi1'
        );

        /** @var TYPO3H5P $TYPO3H5P */
        $TYPO3H5P = $this->createObject(TYPO3H5P::class);

        $interface = $TYPO3H5P->getH5PInstance('interface');

        if (empty($h5pSettings['config'])) {
            $output->writeln('<error>Config settings are not found to import.</error>');

            return 1;
        }

        foreach ($h5pSettings['config'] as $name => $value) {
            $interface->setOption($name, $value);
        }
        $output->writeln('<info>Config settings imported successfully.</info>');

        return 0;
    }

}