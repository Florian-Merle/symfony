<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Exception;

/**
 * Base BadMethodCallException for the Form component.
 *
 * @author Florian Merle <florian.david.merle@gmail.com>
 */
class BadMethodCallException extends \BadMethodCallException implements ExceptionInterface
{
}
