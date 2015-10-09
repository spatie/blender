@setup
$server = 'spatie.be';
$pathOnServer = "/home/forge/{$server}";
$user = get_current_user();
$deploymentId = "Deployment on {$server}: {$pathOnServer} by {$user} —";
@endsetup

@servers(['web' => $server, 'localhost' => '127.0.0.1'])

@task('deploy:start', ['on' => 'localhost'])
echo "{{ $deploymentId }} Started; Checking out the master branch"
git checkout master
php artisan slack "{{ $deploymentId }} Started" > /dev/null
git pull origin master
@endtask

@task('assets:generate', ['on' => 'localhost'])
echo "Generating assets"
npm install
gulp --production
gulp --production --back
php artisan slack "{{ $deploymentId }} Generated assets" > /dev/null
@endtask

@task('app:down', ['on' => 'web'])
cd {{ $pathOnServer }}
echo "Bringing the application down"
php artisan down
php artisan slack "{{ $deploymentId }} :arrow_down: Application down" > /dev/null
@endtask

@task('git:pull', ['on' => 'web'])
cd {{ $pathOnServer }}
echo "Pulling changes on server"
cd {{ $pathOnServer }}
git pull origin master
php artisan slack "{{ $deploymentId }} Changes pulled" > /dev/null
@endtask

@task('composer:install', ['on' => 'web'])
cd {{ $pathOnServer }}
echo "Running composer install"
composer install
php artisan slack "{{ $deploymentId }} Composer dependencies installed" > /dev/null
@endtask

@task('cache:clear', ['on' => 'web'])
cd {{ $pathOnServer }}
php artisan cache:clear
php artisan slack "{{ $deploymentId }} Application cache cleared" > /dev/null
@endtask

@task('assets:clear', ['on' => 'web'])
echo "Clearing the assets"
rm -rf {{ $pathOnServer }}/public/build
php artisan slack "{{ $deploymentId }} Assets cleared" > /dev/null
@endtask

@task('assets:upload', ['on' => 'localhost'])
echo "Uploading generated assets"
scp -r public/build {{ $server }}:{{$pathOnServer}}/public
php artisan slack "{{ $deploymentId }} Assets uploaded" > /dev/null
@endtask

@task('app:backup', ['on' => 'web'])
cd {{ $pathOnServer }}
echo "Backing up application"
php artisan backup:run
php artisan slack "{{ $deploymentId }} Backup created" > /dev/null
@endtask

@task('db:migrate', ['on' => 'web'])
cd {{ $pathOnServer }}
echo "Running migrations"
php artisan migrate --force --env=production
php artisan slack "{{ $deploymentId }} Migrations finished" > /dev/null
@endtask

@task('app:up', ['on' => 'web'])
cd {{ $pathOnServer }}
echo "Bringing the application up"
php artisan up
php artisan slack "{{ $deploymentId }} :arrow_up: Application up" > /dev/null
@endtask

@task('deploy:done', ['on' => 'localhost'])
echo "Application deployed"
php artisan slack "{{ $deploymentId }} :thumbsup: Done!" > /dev/null
@endtask

@macro('deploy')
deploy:start
assets:generate
app:down
git:pull
composer:install
cache:clear
assets:clear
assets:upload
app:backup
db:migrate
app:up
deploy:done
@endmacro

@macro('assets')
deploy:start
assets:generate
app:down
assets:clear
assets:upload
app:up
deploy:done
@endmacro

@macro('app')
deploy:start
app:down
git:pull
composer:install
app:up
deploy:done
@endmacro
