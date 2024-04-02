<?php

declare(strict_types=1);

namespace GMDevelopment\ProductQueue\Console\Command;

use GMDevelopment\ProductQueue\Api\Data\PriceModelInterfaceFactory;
use GMDevelopment\ProductQueue\Model\Queue\Handler\Handler;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Magento\Framework\Serialize\SerializerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PublishPricesOnQueue extends Command
{
    /**
     * @param Handler $handler
     * @param PriceModelInterfaceFactory $priceModelInterfaceFactory
     * @param SerializerInterface $serializer
     * @param string|null $name
     */
    public function __construct(
        private readonly Handler $handler,
        private readonly PriceModelInterfaceFactory $priceModelInterfaceFactory,
        private readonly SerializerInterface $serializer,
        ?string $name = null
    ) {
        parent::__construct($name);
    }

    /**
     * Initialization of the command.
     */
    protected function configure()
    {
        $this->setName('gmd:price:import');
        $this->setDescription('Import prices to queue from api');
        parent::configure();
    }

    /**
     * CLI command description.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $client = new Client();
        $request = new Request('GET', 'host.docker.internal:3002/prices');
        $response = $client->send($request)->getBody()->getContents();
        $prices = $this->serializer->unserialize($response);

        foreach ($prices as $price) {
            $priceModel = $this->priceModelInterfaceFactory->create([
                'data' => $price
            ]);

            $this->handler->publish($priceModel);
        }

        return 1;
    }
}
