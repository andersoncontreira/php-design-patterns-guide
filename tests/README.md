# Tests
Description of the folder structure and concepts

## Unit Tests
* Tests that use mocks to avoid real connections to external components;
* Tests focused on functionality and not on the data itself;
* Tests to run in CI pipelines;
* The duration of these tests should be a maximum of 1s per file, ideally running in milliseconds;

## Integration tests
* Tests that should not run fixtures or feature changes to avoid problems;
* Tests focused on the integration of external components with the application in question;
* Tests to run in CD pipelines;
* The duration of these will depend on the scenarios developed, however, it is recommended to create objective tests so that the pipeline does not take too long;

## Component Tests
* Base tests for the TDD process;
* Tests focused on the behavior, scenarios and data of the project process;
* Tests to be executed locally in a docker suite that will provide local access to resources such as databases and the like;
* The duration of these will depend on the scenarios developed, but the idea of these tests is to explore several possible scenarios;

## References
* https://martinfowler.com/articles/microservice-testing/
