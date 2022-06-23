# php-design-patterns-guide  (Work in progress...)
Project containing real examples of design patterns, contain a guide to help the developers interest in this solutions

> All the information provided has been compiled & adapted from many references, some of them cited at the end of the document.
> The guidelines are illustrated by my own examples, fruit of my personal experience writing and reviewing unit tests.

## Table of contents

1. Creational
- [Abstract Factory](#abstract-factory)
- [Builder](#)
- [Converter](#)
- [Dependency Injection](#dependency-injection)
- [Factory](#)
- [Factory Method](#)
- [Object Pool](#)
- [Prototype](#)

2. Structural
3. Behavioral
4. Architectural
- [Repository](#repository)
6. Concurrency
7. Functional
8. Tests Strategies
- [Unit](#)
- [Component](#)
- [Integration](#)

## Abstract Factory

---

The abstract factory pattern provides a way to encapsulate a group of individual factories that have a common theme without specifying their concrete classes.
In normal usage, the client software creates a concrete implementation of the abstract factory and then uses the generic interface of the factory to create the concrete objects that are part of the theme. 
The client does not know (or care) which concrete objects it gets from each of these internal factories, since it uses only the generic interfaces of their products.
This pattern separates the details of implementation of a set of objects from their general usage and relies on object composition, as object creation is implemented in methods exposed in the factory interface.

> More details: [Wiki](https://en.wikipedia.org/wiki/Abstract_factory_pattern)

### Also known as
KIT 
### Intent
> Provide an interface for creating families of related or dependent objects without specifying their concrete classes.

### Samples
Add diagram here

### Project example 

### References
- https://sourcemaking.com/design_patterns/abstract_factory
- https://java-design-patterns.com/patterns/abstract-factory

## Dependency Injection

---

In software engineering, dependency injection is a design pattern in which an object receives other objects that it depends on. 
A form of inversion of control, dependency injection aims to separate the concerns of constructing objects and using them, 
leading to loosely coupled programs. The pattern ensures that an object which wants to use a given service should not have to know how to construct those services. Instead, the receiving object (or 'client') is provided with its dependencies by external code (an 'injector'), which it is not aware of.

> More details: [Wiki](https://en.wikipedia.org/wiki/Dependency_injection) 

### Samples


### Project example

#### Application
Application.php is a container, you can see the full code [here](./src/Application/Application.php).
```php
protected function bootstrapContainer()
{
   static::setInstance($this);
   
   $consoleLogger = new ConsoleLogger();
   $this->instance('log', $consoleLogger);
   $this->instance(Logger::class, $consoleLogger);
}
```
#### Factories


### Container
Container is dependency injection container. It allows you to implement the dependency injection design pattern meaning that you can decouple your class dependencies and have the container inject them where they are needed.

#### Common libraries and frameworks
- https://laravel.com/api/5.8/Illuminate/Container/Container.html
- https://laravel.com/api/5.8/Illuminate/Support/ServiceProvider.html
- https://container.thephpleague.com/4.x/

### Provider




## References
- https://thephpleague.com/
- https://java-design-patterns.com/patterns/
- https://java-design-patterns.com/patterns/dependency-injection/
- 
