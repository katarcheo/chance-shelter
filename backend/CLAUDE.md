# Chance Shelter — Backend

## Project overview

Symfony 8.0 / PHP 8.5 backend for a finance/accounting application.
Domain-Driven Design with a clean separation of Support → Domain → Application → Infrastructure layers.
The domain and application layers are the primary focus.

## Architecture

### Layer structure

| Layer          | Path                  |
|----------------|-----------------------|
| Domain         | `src/Domain/`         |
| Application    | `src/Application/`    |
| Infrastructure | `src/Infrastructure/` |
| Support        | `src/Support/`        |

### Repository pattern

ORM repositories implementations live in `src/Infrastructure/Doctrine/` and extend Doctrine `EntityRepository`

## Coding conventions

- PHP 8.5 strict typing throughout
- All services accept a dto from the controller with a name convention `<my operation>Command`
- All services, if they return value, return a dto with a name convention `<my result thing>Result`
- All readable data from a repository must be a dto with a name convention `<somthing>Record`
- All listed dtos must be extended by `App\Support\TypedList` and use a name convention `<my collection>List`

## Testing

### Running tests

```bash
./bin/phpunit
```

### Conventions

- Test cases in `tests/Cases/{Layer}/`
- Test factories in `tests/Factories/` — extend base `Factory`, use reflection to bypass constructors, chainable state methods, Faker for random data

## Rules

- Do NOT modify files in `src/Domain/` directory unless explicitly ask
- Controllers handle only HTTP input/output — all business logic belongs in the application layer
