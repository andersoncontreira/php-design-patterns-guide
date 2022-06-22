<?php

declare(strict_types=1);


namespace Application\Configuration;


use League\Config\ConfigurationInterface;

abstract class AbstractConfiguration implements ConfigurationInterface
{
    protected array $configuration = [];

    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    public function get(string $key)
    {
        if (in_array($key, $this->configuration)) {
            return $this->configuration[$key];
        } else {
            return null;
        }

    }

    public function exists(string $key): bool
    {
        return in_array($key, $this->configuration);
    }
}
