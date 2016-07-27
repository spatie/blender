@setup
require __DIR__.'/vendor/autoload.php';
(new \Dotenv\Dotenv(__DIR__, '.env'))->load();

$server = "";
$repository = "spatie/{$server}";
$baseDir = "/home/forge/{$server}";
$releasesDir = "{$baseDir}/releases";
$currentDir = "{$baseDir}/current";
$newReleaseName = date('Ymd-His');
$newReleaseDir = "{$releasesDir}/{$newReleaseName}";
$user = get_current_user();

function logMessage($message) {
  return "echo '\033[32m" .$message. "\033[0m';\n";
}
@endsetup

@servers(['local' => '127.0.0.1', 'remote' => $server])

@macro('deploy')
startDeployment
generateAssets
cloneRepository
uploadGeneratedAssets
runComposer
runNpm
updateSymlinks
optimizeInstallation
updatePermissions
backupDatabase
migrateDatabase
insertNewFragments
blessNewRelease
cleanOldReleases
regenerateLocalAssets
finishDeploy
@endmacro

@macro('deploy-code')
deployOnlyCode
@endmacro

@macro('deploy-assets')
generateAssets
uploadGeneratedAssetsToCurrentDir
regenerateLocalAssets
@endmacro

@task('startDeployment', ['on' => 'local'])
{{ logMessage('start deployment') }}
git checkout master
git pull origin master
@endtask

@task('generateAssets', ['on' => 'local'])
{{ logMessage('start generateAssets') }}
npm install &> /dev/null
gulp --production &> /dev/null
@endtask

@task('cloneRepository', ['on' => 'remote'])
{{ logMessage('start cloneRepository') }}
[ -d {{ $releasesDir }} ] || mkdir {{ $releasesDir }};
cd {{ $releasesDir }};

# Create the release dir
mkdir {{ $newReleaseDir }};

# Clone the repo
git clone --depth 1 git@github.com:{{ $repository }} {{ $newReleaseName }}

# Configure sparse checkout
cd {{ $newReleaseDir }}
git config core.sparsecheckout true
echo "*" > .git/info/sparse-checkout
echo "!storage" >> .git/info/sparse-checkout
echo "!public/build" >> .git/info/sparse-checkout
git read-tree -mu HEAD

# Mark release
cd {{ $newReleaseDir }}
echo "{{ $newReleaseName }}" > public/release-name.txt
@endtask

@task('uploadGeneratedAssets', ['on' => 'local'])
{{ logMessage('start uploadGeneratedAssets') }}
scp -r public/build {{ $server }}:{{ $newReleaseDir }}/public
@endtask

@task('runComposer', ['on' => 'remote'])
{{ logMessage('start runComposer') }}
cd {{ $newReleaseDir }};
composer install --prefer-dist --no-scripts --no-dev -q -o;
@endtask

@task('runNpm', ['on' => 'remote'])
{{ logMessage('start runNpm') }}
cd {{ $newReleaseDir }};
npm install --progress=false --production
@endtask

@task('updateSymlinks', ['on' => 'remote'])
{{ logMessage('start updateSymlinks') }}
# Remove the storage directory and replace with persistent data
rm -rf {{ $newReleaseDir }}/storage;
cd {{ $newReleaseDir }};
ln -nfs {{ $baseDir }}/persistent/storage storage;

# Remove the public/media directory and replace with persistent data
rm -rf {{ $newReleaseDir }}/public/media;
cd {{ $newReleaseDir }};
ln -nfs {{ $baseDir }}/persistent/media public/media;

# Import the environment config
cd {{ $newReleaseDir }};
ln -nfs {{ $baseDir }}/.env .env;
@endtask

@task('optimizeInstallation', ['on' => 'remote'])
{{ logMessage('start optimizeInstallation') }}
cd {{ $newReleaseDir }};
php artisan clear-compiled;
php artisan optimize;
@endtask

@task('updatePermissions', ['on' => 'remote'])
{{ logMessage('start updatePermissions') }}
cd {{ $newReleaseDir }};
find . -type d -exec chmod 775 {} \;
find . -type f -exec chmod 664 {} \;
@endtask

@task('backupDatabase', ['on' => 'remote'])
{{ logMessage('start backupDatabase') }}
cd {{ $currentDir }}
php artisan backup:run
@endtask

@task('migrateDatabase', ['on' => 'remote'])
{{ logMessage('start migrateDatabase') }}
cd {{ $newReleaseDir }};
php artisan migrate --force;
@endtask

@task('blessNewRelease', ['on' => 'remote'])
{{ logMessage('start blessNewRelease') }}
ln -nfs {{ $newReleaseDir }} {{ $currentDir }};
cd {{ $newReleaseDir }}
php artisan cache:clear
sudo service php7.0-fpm restart
sudo supervisorctl restart all
@endtask

@task('insertNewFragments', ['on' => 'remote'])
{{ logMessage('start insertNewFragments') }}
cd {{ $newReleaseDir }};
php artisan fragments:import;
@endtask

@task('cleanOldReleases', ['on' => 'remote'])
{{ logMessage('start cleanOldReleases') }}
# Delete all but the 5 most recent.
cd {{ $releasesDir }}
ls -dt {{ $releasesDir }}/* | tail -n +6 | xargs -d "\n" sudo chown -R forge .;
ls -dt {{ $releasesDir }}/* | tail -n +6 | xargs -d "\n" rm -rf;
@endtask

@task('finishDeploy', ['on' => 'local'])
{{ logMessage("Application deployed") }}
@endtask

@task('deployOnlyCode',['on' => 'remote'])
{{ logMessage('start deployOnlyCode') }}
cd {{ $currentDir }}
git pull origin master
sudo service php7.0-fpm restart
sudo supervisorctl restart all
@endtask

@task('uploadGeneratedAssetsToCurrentDir', ['on' => 'local'])
{{ logMessage('start uploadGeneratedAssetsToCurrentDir') }}
scp -r public/build {{ $server }}:{{ $currentDir }}/public
php artisan cache:clear
@endtask

@task('regenerateLocalAssets', ['on' => 'local'])
{{ logMessage('regenerating local assets') }}
gulp
@endtask

@after
@slack(env('SLACK_ENDPOINT'), '#deployments', "Deployment on {$server}: {$baseDir} {$newReleaseName} by {$user}: {$task} done")
@endafter
