<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Tests\Command;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LazyCommand;
use Symfony\Component\Console\Exception\BadMethodCallException;

class LazyCommandTest extends TestCase
{
    public function testSetAliases()
    {
        $command = new Command('foo:bar');
        $lazyCommand = new LazyCommand(
            'foo:bar',
            ['baz:bar'],
            'description',
            false,
            fn () => $command,
            true,
        );

        $this->assertEquals(['baz:bar'], $lazyCommand->getAliases());

        $this->expectException(BadMethodCallException::class);
        $lazyCommand->setAliases([
            'baz:bar',
            'foo:bar',
        ]);
    }
}
