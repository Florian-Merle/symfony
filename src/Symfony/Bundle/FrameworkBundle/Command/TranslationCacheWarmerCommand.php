<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\FrameworkBundle\Command;

use Symfony\Bundle\FrameworkBundle\CacheWarmer\TranslationsCacheWarmer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'translation:warmup-cache', description: 'Warm translation cache')]
final class TranslationCacheWarmerCommand extends Command
{
    public function __construct(
        private readonly TranslationsCacheWarmer $cacheWarmer,
        private readonly string $cacheDir,
        private readonly string $buildDir,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->cacheWarmer->warmUp($this->cacheDir, $this->buildDir);

        $io->success('Translation cache was successfully warmed.');

        return Command::SUCCESS;
    }
}
