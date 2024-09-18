# Overview

Initial project [requirements](requirement.md) and assuming that it is a small system with a small number of requests.

I will proceed to refactor the code. I have changed the project code [structure](#structure) below. I will explain a little bit about my idea in updating the code.

First, I don't want the database connection, table creation, and data seeding to be handled in the controllers. It doesn't make sense and it's hard to maintain.

Second, the view template I decided not to change the way it works. However, I see it uses forms so I will change them to make it more suitable.

Third, I wrote some tests to check the processing logic.

Finally, I have a few things I would like to do if the system is actually running:

- Assuming that the number of data queries increases. I think we can think about applying the CQRS pattern (Command and Query Responsibility Segregation) combined with the Master-Slave model for the Database to increase the load capacity of the system.
-

## Steps to make adjustments

## Structure

```
|-- Controller
|   `-- UserController.php
|-- DataFixtures
|   |-- AppFixtures.php
|   `-- UserFixtures.php
|-- Entity
|   `-- User.php
|-- Form
|   `-- UserType.php
|-- Kernel.php
|-- Repository
|   |-- Fake
|   |   `-- UserRepository.php
|   |-- UserRepository.php
|   `-- UserRepositoryInterface.php
`-- UseCase
    `-- User
        |-- AddUseCase.php
        |-- DeleteUseCase.php
        |-- IndexUseCase.php
        `-- UseCase.php
```

## How to run

## Install docker

This test requires you to use docker. Please follow the link corresponding to your operating system:

- Linux: <https://docs.docker.com/engine/install/#server> (follow the link that correspond to your linux distro)
- Mac: <https://docs.docker.com/desktop/install/mac-install/>
- Windows: <https://docs.docker.com/desktop/install/windows-install/>

## Set up the project

- Step 1: Run container with bellow command

  ```
  docker compose up symfony -d
  ```

  You should get the following output:
  symfony 10:03:33.26
  symfony 10:03:33.26 Welcome to the Bitnami symfony container
  symfony 10:03:33.26 Subscribe to project updates by watching <https://github.com/bitnami/containers>
  symfony 10:03:33.26 Submit issues and feature requests at <https://github.com/bitnami/containers/issues>
  symfony 10:03:33.27
  symfony 10:03:33.27 INFO ==> **Running Symfony setup**
  symfony 10:03:33.28 INFO ==> Configuring PHP options
  symfony 10:03:33.28 INFO ==> Setting PHP opcache.enable option
  symfony 10:03:33.29 INFO ==> Setting PHP expose*php option
  symfony 10:03:33.29 INFO ==> Setting PHP output_buffering option
  symfony 10:03:33.30 INFO ==> Validating settings in MYSQL_CLIENT*\_env vars
  symfony 10:03:33.31 INFO ==> Validating settings in SYMFONY\_\_ environment variables...
  symfony 10:03:33.32 WARN ==> You set the environment variable ALLOW_EMPTY_PASSWORD=yes. For safety reasons, do not use this flag in a production environment.
  symfony 10:03:33.32 INFO ==> Copying symfony/skeleton project files to /app
  symfony 10:03:33.63 INFO ==> Trying to connect to the database server
  symfony 10:03:33.64 INFO ==> Trying to install required Symfony packs
  symfony 10:03:41.16 INFO ==> **Symfony setup finished!**

  symfony 10:03:41.17 INFO ==> **Starting Symfony project**
  [Sat Oct 7 10:03:41 2023] PHP 8.2.11 Development Server (<http://0.0.0.0:8000>) started

- Step 2: Install dependencies and migration database

      ```
      docker compose exec -ti symfony bash exec.sh
      ```

      You should get the following output:
      Installing dependencies from lock file (including require-dev)

  Verifying lock file contents can be installed on current platform.
  Warning: The lock file is not up to date with the latest changes in composer.json. You may be getting outdated dependencies. It is recommended that you run `composer update` or `composer update <package name>`.
  Package operations: 95 installs, 0 updates, 0 removals
  As there is no 'unzip' nor '7z' command installed zip files are being unpacked using the PHP zip extension.
  This may cause invalid reports of corrupted archives. Besides, any UNIX permissions (e.g. executable) defined in the archives will be lost.
  Installing 'unzip' or '7z' (21.01+) may remediate them.

  - Downloading symfony/flex (v2.4.6)
  - Downloading symfony/runtime (v6.3.12)
  - Downloading psr/cache (3.0.0)
  - Downloading doctrine/lexer (3.0.1)
  - Downloading doctrine/annotations (2.0.2)
  - Downloading symfony/polyfill-php83 (v1.31.0)
  - Downloading symfony/polyfill-mbstring (v1.31.0)
  - Downloading symfony/deprecation-contracts (v3.5.0)
  - Downloading symfony/http-foundation (v6.3.12)
  - Downloading psr/event-dispatcher (1.0.0)
  - Downloading symfony/event-dispatcher-contracts (v3.5.0)
  - Downloading symfony/event-dispatcher (v6.3.12)
  - Downloading symfony/var-dumper (v6.3.12)
  - Downloading psr/log (3.0.2)
  - Downloading symfony/error-handler (v6.3.12)
  - Downloading symfony/http-kernel (v6.3.12)
  - Downloading psr/container (2.0.2)
  - Downloading symfony/service-contracts (v3.5.0)
  - Downloading doctrine/event-manager (2.0.1)
  - Downloading doctrine/persistence (3.3.3)
  - Downloading symfony/doctrine-bridge (v6.3.12)
  - Downloading symfony/var-exporter (v6.3.12)
  - Downloading symfony/dependency-injection (v6.3.12)
  - Downloading symfony/polyfill-intl-normalizer (v1.31.0)
  - Downloading symfony/polyfill-intl-grapheme (v1.31.0)
  - Downloading symfony/string (v6.3.12)
  - Downloading symfony/console (v6.3.12)
  - Downloading symfony/filesystem (v6.3.12)
  - Downloading symfony/config (v6.3.12)
  - Downloading doctrine/instantiator (2.0.0)
  - Downloading doctrine/inflector (2.0.10)
  - Downloading doctrine/deprecations (1.1.3)
  - Downloading doctrine/cache (2.2.0)
  - Downloading doctrine/dbal (3.9.1)
  - Downloading doctrine/common (3.4.4)
  - Downloading doctrine/collections (2.2.2)
  - Downloading doctrine/orm (2.19.7)
  - Downloading symfony/routing (v6.3.12)
  - Downloading symfony/finder (v6.3.5)
  - Downloading symfony/cache-contracts (v3.5.0)
  - Downloading symfony/cache (v6.3.12)
  - Downloading symfony/framework-bundle (v6.3.12)
  - Downloading doctrine/sql-formatter (1.4.1)
  - Downloading doctrine/doctrine-bundle (2.13.0)
  - Downloading doctrine/data-fixtures (1.7.0)
  - Downloading doctrine/doctrine-fixtures-bundle (3.6.1)
  - Downloading symfony/stopwatch (v6.3.12)
  - Downloading doctrine/migrations (3.8.1)
  - Downloading doctrine/doctrine-migrations-bundle (3.3.1)
  - Downloading sebastian/version (3.0.2)
  - Downloading sebastian/type (3.2.1)
  - Downloading sebastian/resource-operations (3.0.4)
  - Downloading sebastian/recursion-context (4.0.5)
  - Downloading sebastian/object-reflector (2.0.4)
  - Downloading sebastian/object-enumerator (4.0.4)
  - Downloading sebastian/global-state (5.0.7)
  - Downloading sebastian/exporter (4.0.6)
  - Downloading sebastian/environment (5.1.5)
  - Downloading sebastian/diff (4.0.6)
  - Downloading sebastian/comparator (4.0.8)
  - Downloading sebastian/code-unit (1.0.8)
  - Downloading sebastian/cli-parser (1.0.2)
  - Downloading phpunit/php-timer (5.0.3)
  - Downloading phpunit/php-text-template (2.0.4)
  - Downloading phpunit/php-invoker (3.1.1)
  - Downloading phpunit/php-file-iterator (3.0.6)
  - Downloading theseer/tokenizer (1.2.3)
  - Downloading nikic/php-parser (v5.2.0)
  - Downloading sebastian/lines-of-code (1.0.4)
  - Downloading sebastian/complexity (2.0.3)
  - Downloading sebastian/code-unit-reverse-lookup (2.0.3)
  - Downloading phpunit/php-code-coverage (9.2.32)
  - Downloading phar-io/version (3.2.1)
  - Downloading phar-io/manifest (2.0.4)
  - Downloading myclabs/deep-copy (1.12.0)
  - Downloading phpunit/phpunit (9.6.20)
  - Downloading masterminds/html5 (2.9.0)
  - Downloading symfony/dom-crawler (v6.3.12)
  - Downloading symfony/browser-kit (v6.3.12)
  - Downloading symfony/css-selector (v6.3.12)
  - Downloading symfony/dotenv (v6.3.12)
  - Downloading symfony/property-info (v6.3.12)
  - Downloading symfony/property-access (v6.3.12)
  - Downloading symfony/polyfill-intl-icu (v1.31.0)
  - Downloading symfony/options-resolver (v6.3.0)
  - Downloading symfony/form (v6.3.12)
  - Downloading symfony/process (v6.3.12)
  - Downloading symfony/maker-bundle (v1.53.0)
  - Downloading symfony/phpunit-bridge (v7.1.4)
  - Downloading twig/twig (v3.14.0)
  - Downloading symfony/translation-contracts (v3.5.0)
  - Downloading symfony/twig-bridge (v6.3.12)
  - Downloading symfony/twig-bundle (v6.3.12)
  - Downloading symfony/validator (v6.3.12)
  - Downloading symfony/yaml (v6.3.12)
  - Installing symfony/flex (v2.4.6): Extracting archive
  - Installing symfony/runtime (v6.3.12): Extracting archive
  - Installing psr/cache (3.0.0): Extracting archive
  - Installing doctrine/lexer (3.0.1): Extracting archive
  - Installing doctrine/annotations (2.0.2): Extracting archive
  - Installing symfony/polyfill-php83 (v1.31.0): Extracting archive
  - Installing symfony/polyfill-mbstring (v1.31.0): Extracting archive
  - Installing symfony/deprecation-contracts (v3.5.0): Extracting archive
  - Installing symfony/http-foundation (v6.3.12): Extracting archive
  - Installing psr/event-dispatcher (1.0.0): Extracting archive
  - Installing symfony/event-dispatcher-contracts (v3.5.0): Extracting archive
  - Installing symfony/event-dispatcher (v6.3.12): Extracting archive
  - Installing symfony/var-dumper (v6.3.12): Extracting archive
  - Installing psr/log (3.0.2): Extracting archive
  - Installing symfony/error-handler (v6.3.12): Extracting archive
  - Installing symfony/http-kernel (v6.3.12): Extracting archive
  - Installing psr/container (2.0.2): Extracting archive
  - Installing symfony/service-contracts (v3.5.0): Extracting archive
  - Installing doctrine/event-manager (2.0.1): Extracting archive
  - Installing doctrine/persistence (3.3.3): Extracting archive
  - Installing symfony/doctrine-bridge (v6.3.12): Extracting archive
  - Installing symfony/var-exporter (v6.3.12): Extracting archive
  - Installing symfony/dependency-injection (v6.3.12): Extracting archive
  - Installing symfony/polyfill-intl-normalizer (v1.31.0): Extracting archive
  - Installing symfony/polyfill-intl-grapheme (v1.31.0): Extracting archive
  - Installing symfony/string (v6.3.12): Extracting archive
  - Installing symfony/console (v6.3.12): Extracting archive
  - Installing symfony/filesystem (v6.3.12): Extracting archive
  - Installing symfony/config (v6.3.12): Extracting archive
  - Installing doctrine/instantiator (2.0.0): Extracting archive
  - Installing doctrine/inflector (2.0.10): Extracting archive
  - Installing doctrine/deprecations (1.1.3): Extracting archive
  - Installing doctrine/cache (2.2.0): Extracting archive
  - Installing doctrine/dbal (3.9.1): Extracting archive
  - Installing doctrine/common (3.4.4): Extracting archive
  - Installing doctrine/collections (2.2.2): Extracting archive
  - Installing doctrine/orm (2.19.7): Extracting archive
  - Installing symfony/routing (v6.3.12): Extracting archive
  - Installing symfony/finder (v6.3.5): Extracting archive
  - Installing symfony/cache-contracts (v3.5.0): Extracting archive
  - Installing symfony/cache (v6.3.12): Extracting archive
  - Installing symfony/framework-bundle (v6.3.12): Extracting archive
  - Installing doctrine/sql-formatter (1.4.1): Extracting archive
  - Installing doctrine/doctrine-bundle (2.13.0): Extracting archive
  - Installing doctrine/data-fixtures (1.7.0): Extracting archive
  - Installing doctrine/doctrine-fixtures-bundle (3.6.1): Extracting archive
  - Installing symfony/stopwatch (v6.3.12): Extracting archive
  - Installing doctrine/migrations (3.8.1): Extracting archive
  - Installing doctrine/doctrine-migrations-bundle (3.3.1): Extracting archive
  - Installing sebastian/version (3.0.2): Extracting archive
  - Installing sebastian/type (3.2.1): Extracting archive
  - Installing sebastian/resource-operations (3.0.4): Extracting archive
  - Installing sebastian/recursion-context (4.0.5): Extracting archive
  - Installing sebastian/object-reflector (2.0.4): Extracting archive
  - Installing sebastian/object-enumerator (4.0.4): Extracting archive
  - Installing sebastian/global-state (5.0.7): Extracting archive
  - Installing sebastian/exporter (4.0.6): Extracting archive
  - Installing sebastian/environment (5.1.5): Extracting archive
  - Installing sebastian/diff (4.0.6): Extracting archive
  - Installing sebastian/comparator (4.0.8): Extracting archive
  - Installing sebastian/code-unit (1.0.8): Extracting archive
  - Installing sebastian/cli-parser (1.0.2): Extracting archive
  - Installing phpunit/php-timer (5.0.3): Extracting archive
  - Installing phpunit/php-text-template (2.0.4): Extracting archive
  - Installing phpunit/php-invoker (3.1.1): Extracting archive
  - Installing phpunit/php-file-iterator (3.0.6): Extracting archive
  - Installing theseer/tokenizer (1.2.3): Extracting archive
  - Installing nikic/php-parser (v5.2.0): Extracting archive
  - Installing sebastian/lines-of-code (1.0.4): Extracting archive
  - Installing sebastian/complexity (2.0.3): Extracting archive
  - Installing sebastian/code-unit-reverse-lookup (2.0.3): Extracting archive
  - Installing phpunit/php-code-coverage (9.2.32): Extracting archive
  - Installing phar-io/version (3.2.1): Extracting archive
  - Installing phar-io/manifest (2.0.4): Extracting archive
  - Installing myclabs/deep-copy (1.12.0): Extracting archive
  - Installing phpunit/phpunit (9.6.20): Extracting archive
  - Installing masterminds/html5 (2.9.0): Extracting archive
  - Installing symfony/dom-crawler (v6.3.12): Extracting archive
  - Installing symfony/browser-kit (v6.3.12): Extracting archive
  - Installing symfony/css-selector (v6.3.12): Extracting archive
  - Installing symfony/dotenv (v6.3.12): Extracting archive
  - Installing symfony/property-info (v6.3.12): Extracting archive
  - Installing symfony/property-access (v6.3.12): Extracting archive
  - Installing symfony/polyfill-intl-icu (v1.31.0): Extracting archive
  - Installing symfony/options-resolver (v6.3.0): Extracting archive
  - Installing symfony/form (v6.3.12): Extracting archive
  - Installing symfony/process (v6.3.12): Extracting archive
  - Installing symfony/maker-bundle (v1.53.0): Extracting archive
  - Installing symfony/phpunit-bridge (v7.1.4): Extracting archive
  - Installing twig/twig (v3.14.0): Extracting archive
  - Installing symfony/translation-contracts (v3.5.0): Extracting archive
  - Installing symfony/twig-bridge (v6.3.12): Extracting archive
  - Installing symfony/twig-bundle (v6.3.12): Extracting archive
  - Installing symfony/validator (v6.3.12): Extracting archive
  - Installing symfony/yaml (v6.3.12): Extracting archive
    Generating autoload files
    84 packages you are using are looking for funding.
    Use the `composer fund` command to find out more!

Run composer recipes at any time to see the status of your Symfony recipes.

Executing script cache:clear [OK]
Executing script assets:install public [OK]

[notice] Migrating up to DoctrineMigrations\Version20240916134400
[notice] finished in 6.3ms, used 14M memory, 1 migrations executed, 1 sql queries

[OK] Successfully migrated to version:
DoctrineMigrations\Version20240916134400

> purging database
> loading App\DataFixtures\AppFixtures
> loading App\DataFixtures\UserFixtures

# Verifying installation

Open <http://localhost:8000>, you should be greeted with "Welcome to Symfony 6.3.4".
