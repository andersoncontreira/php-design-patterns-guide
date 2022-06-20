# php-design-patterns-guide
Project containing real examples of design patterns, contain a guide to help the developers interest in this solutions

> All the information provided has been compiled & adapted from many references, some of them cited at the end of the document.
> The guidelines are illustrated by my own examples, fruit of my personal experience writing and reviewing unit tests.

## Table of contents

1. Creational
- [Abstract Factory](#)
- [Builder](#)
- [Converter](#)
- [Dependency Injection](#dependency-injection)
- [Factory Method](#)
- [Object Pool](#)
- [Prototype](#)

2. Structural
3. Behavioral
4. Architectural
5. Concurrency
6. Functional
7. Tests Strategies
- [Unit](#)
- [Component](#)
- [Integration](#)

## Dependency Injection
In software engineering, dependency injection is a design pattern in which an object receives other objects that it depends on. 
A form of inversion of control, dependency injection aims to separate the concerns of constructing objects and using them, 
leading to loosely coupled programs. The pattern ensures that an object which wants to use a given service should not have to know how to construct those services. Instead, the receiving object (or 'client') is provided with its dependencies by external code (an 'injector'), which it is not aware of.

> More details: [Wiki](https://en.wikipedia.org/wiki/Dependency_injection) 

### Container
Container is dependency injection container. It allows you to implement the dependency injection design pattern meaning that you can decouple your class dependencies and have the container inject them where they are needed.

### Provider

#### Common libraries and frameworks
- https://laravel.com/api/5.8/Illuminate/Container/Container.html
- https://laravel.com/api/5.8/Illuminate/Support/ServiceProvider.html
- https://container.thephpleague.com/4.x/


## References
- https://thephpleague.com/
- https://java-design-patterns.com/patterns/
- https://java-design-patterns.com/patterns/dependency-injection/
- 
