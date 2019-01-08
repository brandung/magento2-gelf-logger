<?php
declare(strict_types=1);

namespace Brandung\GelfLogger\Model;

use Gelf\MessageInterface as Message;
use Gelf\Transport\TransportInterface;
use Gelf\Transport\UdpTransport;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfiguredUdpTransport implements TransportInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var UdpTransport
     */
    private $udpTransport;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function send(Message $message): ?int
    {
        try {
            return $this->getUdpTransport()->send($message);
        } catch (\Exception $e) {
            return -1;
        }
    }

    private function getUdpTransport(): UdpTransport
    {
        if (null === $this->udpTransport) {
            $host = $this->scopeConfig->getValue('system/gelf_logger/host');
            $port = $this->scopeConfig->getValue('system/gelf_logger/port');
            $this->udpTransport = new UdpTransport($host, $port);
        }
        return $this->udpTransport;
    }
}
