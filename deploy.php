<?php
namespace Deployer;
require './deployer/recipe/laravel.php';

inventory('hosts.yaml');

// Configuration
set('default_stage', 'production');
set('deploy_path', '~/');
set('application', 'BooksBank');
set('repository', 'https://github.com/Zelig880/BookSwap.git');
set('http_user', 'booksban');
set('writable_mode', 'chmod');
set('keep_releases', 2);


localhost()
    ->stage('production')
    ->roles('test', 'build');

task('upload', function () {
    upload(__DIR__ . "/.build/current/", '{{release_path}}');
});

task('remove:node_modules', function () {
    run('cd {{release_path}} && rm -rf node_modules');
});

task('build', function () {
    set('deploy_path', __DIR__ . '/.build');
    invoke('deploy:prepare');
    invoke('deploy:release');
    invoke('deploy:update_code');
    invoke('deploy:vendors');
    run('cd {{release_path}} && yarn install');
    run('cd {{release_path}} && yarn production');
    invoke('remove:node_modules');
    invoke('deploy:symlink');
})->local();

task('local:cleanup', function () {
    set('deploy_path', __DIR__ . '/.build');
    invoke('cleanup');
})->local();

task('release', [
    'deploy:prepare',
    'deploy:release',
    'upload',
    'deploy:shared',
    'deploy:writable',
    'deploy:symlink',
    'artisan:optimize',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:migrate',
]);

// Tasks
task('deploy', [
    'build',
    'release',
    'cleanup',
    'local:cleanup',
    'success'
])->desc('Deploy your project');
// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');