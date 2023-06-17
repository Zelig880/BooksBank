<?php
namespace Deployer;
require './vendor/deployer/deployer/recipe/laravel.php';

import('hosts.yaml');

// Configuration
set('default_stage', 'production');
set('application', 'BooksBank');
set('repository', 'https://github.com/Zelig880/BookSwap.git');
set('http_user', 'booksban');
set('writable_mode', 'chmod');
set('keep_releases', 2);
set('deploy_path', __DIR__ . '/.build');

task('node', function() {
    invoke('copy:node_modules');
    invoke('install:node_modules');
    invoke('backup:node_modules');
} )->once();

task('upload:node', function () {
    upload(__DIR__ . "/public", '{{release_path}}');
});

task('copy:node_modules', function () {
    run('cd {{release_path}}/.. && mv node_modules {{release_path}}');
});

task('install:node_modules', function () {
    runLocally('cd ' . __DIR__ . ' && yarn install');
    runLocally('cd ' . __DIR__ . ' && yarn production');
});

task('backup:node_modules', function () {
    run('cd {{release_path}} && mv node_modules ../');
});

task('deploy:live', [
    'deploy:prepare',
    'deploy:vendors',
    'install:node_modules',
    'upload:node',
    'artisan:storage:link',
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:view:cache',
    'artisan:event:cache',
    'artisan:migrate',
    'deploy:publish'
]);
after('deploy:failed', 'deploy:unlock');