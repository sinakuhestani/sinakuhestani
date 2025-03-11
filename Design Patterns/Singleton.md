# Singleton 

Singleton is a creational design pattern for classes that MUST have a single global instance. Some examples include database connection object, configuration manager object, logging handler and so on.

## Implementation Best Practice

1. Add a private static named `$instance` to the class to store the instance.
2. Declare a public static method `getInstance()` for getting the singleton instance. It **MUST** create a new object on the first call and put it into the static field `$instance`. The method `getInstance()` **MUST** return the `$instance` on subsequent calls.
3. Make the `__construct()` of the class private. So, other programs out of the class are not able to call it.
4. Add the prefix `final` into the class declaration. So that, the Singleton class would not be a parent for ant other class.
5. Make the `__clone()` of the class private. So, other programs would not be able to create a clone.
6. Make the `__wakeup()` of the class private. So, other programs would not be able to create clones by serializing-deserializing.
7. Refactor your code and replace all direct calls to the singleton’s constructor with calls to `getInstance()` method.

## Code

```
<?php

declare(strict_types=1);

namespace DesignPatterns;

final class Singleton 
{
    private static ? Singleton $instance = null;

    public static function getInstance(): Singleton
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct(){}

    private function __clone(){}

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}

```

## Applicability

Use the Singleton pattern when a class in your program **MUST** have just and only just one single instance available by different parts of the program.
