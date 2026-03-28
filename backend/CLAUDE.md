# Chance Shelter — Backend

## Project overview

Symfony 8.0 / PHP 8.4 backend for a finance/accounting application.
Domain-Driven Design with a clean separation of Domain → Application → Infrastructure layers.
The domain and application layers are the primary focus.

## Architecture

### Layer structure

| Layer          | Path                  |
|----------------|-----------------------|
| Domain         | `src/Domain/`         |
| Application    | `src/Application/`    |
| Infrastructure | `src/Infrastructure/` |
| Controller     | `src/Controller/`     |

### Repository pattern

ORM repositories implementations live in `src/Infrastructure/Doctrine/` and extend Doctrine `EntityRepository`

## Coding conventions

- PHP 8.4 strict typing throughout

## Testing

### Running tests

```bash
./bin/phpunit
```

### Conventions

- PHPUnit 13, attribute syntax (`#[Test]`, `#[Group('domain')]`, `#[Group('application')]`)
- Test cases in `tests/Cases/{Layer}/`
- Test factories in `tests/Factories/` — extend base `Factory`, use reflection to bypass constructors, chainable state methods, Faker for random data

## Rules

- Do NOT modify files in `src/Domain/` directory unless explicitly ask
- Controllers handle only HTTP input/output — all business logic belongs in the application layer
