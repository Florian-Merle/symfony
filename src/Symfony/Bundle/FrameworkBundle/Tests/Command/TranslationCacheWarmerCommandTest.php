<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\FrameworkBundle\Tests\Command;

use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\CacheWarmer\TranslationsCacheWarmer;
use Symfony\Bundle\FrameworkBundle\Command\TranslationCacheWarmerCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class TranslationCacheWarmerCommandTest extends TestCase
{
    public function testCommandWithPools(): void
    {
        $cacheWarmer = $this->createMock(TranslationsCacheWarmer::class);
        $cacheWarmer->expects($this->once())
            ->method('warmUp')
            ->with('cacheDir', 'buildDir')
        ;

        $tester = $this->getCommandTester(
            $this->getKernel(),
            $cacheWarmer,
            'cacheDir',
            'buildDir',
        );
        $tester->execute([]);
    }

    private function getKernel(): MockObject&KernelInterface
    {
        $container = $this->createMock(ContainerInterface::class);
        $kernel = $this->createMock(KernelInterface::class);

        return $kernel;
    }

    private function getCommandTester(
        KernelInterface $kernel,
        TranslationsCacheWarmer $cacheWarmer,
        string $cacheDir,
        string $buildDir,
    ): CommandTester {
        $application = new Application($kernel);
        $application->add(new TranslationCacheWarmerCommand(
            $cacheWarmer,
            $cacheDir,
            $buildDir,
        ));

        return new CommandTester($application->find('translation:warmup-cache'));
    }
}
