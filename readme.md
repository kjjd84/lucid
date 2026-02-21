# Lucid

Declare database schemas & factory definitions inside Laravel models.

## Installation

Require Lucid via composer:

```console
composer require kjjd84/lucid
```

Replace the default `User` model in new apps:

```console
php artisan lucid:model User --force
```

## Usage

### Using the `lucid:model` Command

Create a new Lucid model:

```console
php artisan lucid:model Post
```

### Manually Adding Schemas & Definitions

You may also add `schema` and `definition` methods to existing models:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kjjd84\Lucid\Database\Blueprint;

class Post extends Model
{
    use HasFactory;

    public function schema(Blueprint $table): void
    {
        $table->id();
        $table->string('title');
        $table->text('body');
        $table->timestamp('created_at');
        $table->timestamp('updated_at');
    }

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
        ];
    }
}
```

If adding methods manually, make sure to create a Lucid factory for the model:

```console
php artisan lucid:factory Post
```

### Defining Multiple Schemas & Definitions

Define multiple schemas & definitions by appending `Schema` / `Definition`:

```php
namespace App\Traits;

use App\Models\Tenant;
use Kjjd84\Lucid\Database\Blueprint;

trait HasTenant
{
    public function tenantSchema(Blueprint $table): void
    {
        $table->integer('tenant_id')->index();
    }

    public function tenantDefinition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
        ];
    }
}
```

## Migrating & Syncing

Migrate & sync schemas with the database:

```console
php artisan lucid:migrate
```

This runs traditional migrations first, then syncs schema methods automatically.

## Commands

### `lucid:model`

Create a new Lucid model.

```console
php artisan lucid:model {name} {--force} {--p|pivot} {--r|resource}
```

-   `name`: the model name
-   `--force`: Create the model even if it already exists
-   `--pivot` or `-p`: Create a pivot instead of a regular model
-   `--resource` or `-r`: Create a Filament resource for the model

### `lucid:factory`

Create a new Lucid factory.

```console
php artisan lucid:factory {name} {--force}
```

-   `name`: the model name for the factory
-   `--force`: Create the factory even if it already exists

### `lucid:migrate`

Migrate & sync schemas with the database.

```console
php artisan lucid:migrate {--force} {--f|fresh} {--s|seed}
```

-   `--force`: Force the operation to run when in production
-   `--fresh` or `-f`: Drop all tables from the database first
-   `--seed` or `-s`: Re-run seeders when migrations are complete

### `lucid:filament`

Install filament in a fresh Laravel app.

```console
php artisan lucid:filament
```

## Notes

-   This package only works with `sqlite`, `mysql`, & `pgsql` PDO drivers
-   Renaming columns will result data loss unless renamed before running `lucid:migrate`
-   Lucid definition methods only work with a `LucidFactory`
-   All columns (except `id`) are nullable by default
-   All models are unguarded via `Model::unguard()`
