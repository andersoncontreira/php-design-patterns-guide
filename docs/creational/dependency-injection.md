# Dependency Injection

---

In software engineering, dependency injection is a design pattern in which an object receives other objects that it depends on.
A form of inversion of control, dependency injection aims to separate the concerns of constructing objects and using them,
leading to loosely coupled programs. The pattern ensures that an object which wants to use a given service should not have to know how to construct those services. Instead, the receiving object (or 'client') is provided with its dependencies by external code (an 'injector'), which it is not aware of.

> More details: [Wiki](https://en.wikipedia.org/wiki/Dependency_injection)

### Samples


### Project examples


[//]: # (Application.php is a container, you can see the full code [here]&#40;./src/Application/Application.php&#41;.)

[//]: # (```php)

[//]: # (protected function bootstrapContainer&#40;&#41;)

[//]: # ({)

[//]: # (   static::setInstance&#40;$this&#41;;)

[//]: # (   )
[//]: # (   $consoleLogger = new ConsoleLogger&#40;&#41;;)

[//]: # (   $this->instance&#40;'log', $consoleLogger&#41;;)

[//]: # (   $this->instance&#40;Logger::class, $consoleLogger&#41;;)

[//]: # (})

[//]: # (```)



### Container
Container is dependency injection container. It allows you to implement the dependency injection design pattern meaning that you can decouple your class dependencies and have the container inject them where they are needed.


### Provider


## Common usage in libraries and frameworks
- https://laravel.com/api/5.8/Illuminate/Container/Container.html
- https://laravel.com/api/5.8/Illuminate/Support/ServiceProvider.html
- https://container.thephpleague.com/4.x/



Description

> More details: [Wiki](#)

### Also known as
A.K.A

### Intent
> intent.

### Samples
Add diagram here


---

### Project example

---


### References
- https://sourcemaking.com/design_patterns/?
- https://java-design-patterns.com/patterns/?


---

[Return to README.md](../../README.md)
