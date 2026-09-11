<?php
namespace Core;

use Exception;
use ReflectionClass;
use ReflectionMethod;
use RuntimeException;

class Container {

    private $bindings = [];

    public function get(string $class) {
        if (isset($this->bindings[$class])) {
            return $this->bindings[$class]($this);
        }

        return $this->build($class);
    }

    public function build(string $class): object {
        $constructor = new ReflectionClass($class);

        $constructorMethod = $constructor->getConstructor();

        if (!$constructorMethod) {
            return new $class();
        }

        $params = [];

        foreach ($constructorMethod->getParameters() as $param) {
            $type = $param->getType();

            if (!$type || $type->isBuiltin()) {
                throw new Exception("Cannot resolve: " . $param->getName());
            }

            $params[] = $this->get($type->getName());
        }

        return $constructor->newInstanceArgs($params);
    }

    public function bind(string $key, callable $resolver) {
        $this->bindings[$key] = $resolver;
    }

    public function resolveMethodArguments(object $instance, string $method, array $routeParams): array
    {
        $methodReflection = new ReflectionMethod($instance, $method);

        $parameters = $methodReflection->getParameters();
        $arguments = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();
            $parameterName = $parameter->getName();

            // Interface
            if ($type && !$type->isBuiltin()) {
                $arguments[] = $this->get($type);
                continue;
            }

            // Route parameter
            if (array_key_exists($parameterName, $routeParams)) {
                $arguments[] = $routeParams[$parameterName];
                continue;
            }

            // Default value
            if ($parameter->isDefaultValueAvailable()) {
                $arguments[] = $parameter->getDefaultValue();
                continue;
            }

            throw new RuntimeException(
                "Unable to resolve parameter \${$parameterName}"
            );
        }

        return $arguments;
    }
}


?>