<?php
declare(strict_types=1);

namespace Brandung\GelfLogger\Model;

use Gelf\PublisherInterface;
use Monolog\Logger;

class GelfHandler extends \Monolog\Handler\GelfHandler
{
    public function __construct(PublisherInterface $publisher, $level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($publisher, $level, $bubble);
    }
}
