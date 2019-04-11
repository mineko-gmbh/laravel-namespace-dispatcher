<?php
namespace Mineko\Bus;

use Illuminate\Bus\Dispatcher;

/**
 * Follow convention
 * that command handlers are named like command class name concated with "Handler"
 */
class NamespaceDispatcher extends Dispatcher
{
    /**
     * Determine if the given command has a handler.
     *
     * @param  mixed  $command
     * @return bool
     */
    public function hasNamespaceCommandHandler($command)
    {
        return class_exists($this->getCommandHandlerName($command));
    }

    /**
     * Retrieve the handler for a command.
     *
     * @param  mixed  $command
     * @return bool|mixed
     */
    public function getCommandHandler($command)
    {
        if ($this->hasNamespaceCommandHandler($command)) {
            return $this->container->make($this->getCommandHandlerName($command));
        }
        return parent::getCommandHandler($command);
    }

    /**
     * @param mixed $command
     * @return string
     */
    protected function getCommandHandlerName($command)
    {
        return sprintf('%sHandler', get_class($command));
    }
}
