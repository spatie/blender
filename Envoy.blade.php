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
cloneRepository
runComposer
runYarn
generateAssets
updateSymlinks
optimizeInstallation
updatePermissions
backupDatabase
migrateDatabase
insertNewFragments
blessNewRelease
cleanOldReleases
finishDeploy
@endmacro

@macro('deploy-code')
deployOnlyCode
@endmacro

@task('startDeployment', ['on' => 'local'])
{{ logMessage("\u{1F3C3}  Starting deployment...") }}
git checkout master
git pull origin master
@endtask

@task('cloneRepository', ['on' => 'remote'])
{{ logMessage("\u{1F300}  Cloning repository...") }}
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

@task('runComposer', ['on' => 'remote'])
{{ logMessage("\u{1F69A}  Running Composer...") }}
cd {{ $newReleaseDir }};
composer install --prefer-dist --no-scripts --no-dev -q -o;
@endtask

@task('runYarn', ['on' => 'remote'])
{{ logMessage("\u{1F4E6}  Running Yarn...") }}
cd {{ $newReleaseDir }};
yarn
@endtask

@task('generateAssets', ['on' => 'remote'])
{{ logMessage("\u{1F305}  Generating assets...") }}
cd {{ $newReleaseDir }};
gulp --production
@endtask

@task('updateSymlinks', ['on' => 'remote'])
{{ logMessage("\u{2728}  Updating symlinks to persistent data...") }}
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
{{ logMessage("\u{1F517}  Optimizing installation") }}
cd {{ $newReleaseDir }};
php artisan clear-compiled;
php artisan optimize;
@endtask

@task('updatePermissions', ['on' => 'remote'])
{{ logMessage("\u{1F512}  Updating permissions...") }}
cd {{ $newReleaseDir }};
find . -type d -exec chmod 775 {} \;
find . -type f -exec chmod 664 {} \;
@endtask

@task('backupDatabase', ['on' => 'remote'])
{{ logMessage("\u{1F4C0}  Backing up database...") }}
cd {{ $currentDir }}
php artisan backup:run
@endtask

@task('migrateDatabase', ['on' => 'remote'])
{{ logMessage("\u{1F648}  Migrating database...") }}
cd {{ $newReleaseDir }};
php artisan migrate --force;
@endtask

@task('blessNewRelease', ['on' => 'remote'])
{{ logMessage("\u{1F64F}  Blessing new release...") }}
ln -nfs {{ $newReleaseDir }} {{ $currentDir }};
cd {{ $newReleaseDir }}
php artisan cache:clear
sudo service php7.0-fpm restart
sudo supervisorctl restart all
@endtask

@task('insertNewFragments', ['on' => 'remote'])
{{ logMessage("\u{3299}  Inserting new fragments...") }}
cd {{ $newReleaseDir }};
php artisan fragments:import;
@endtask

@task('cleanOldReleases', ['on' => 'remote'])
{{ logMessage("\u{1F6BE}  Cleaning up old releases...") }}
# Delete all but the 5 most recent.
cd {{ $releasesDir }}
ls -dt {{ $releasesDir }}/* | tail -n +6 | xargs -d "\n" sudo chown -R forge .;
ls -dt {{ $releasesDir }}/* | tail -n +6 | xargs -d "\n" rm -rf;
@endtask

@task('finishDeploy', ['on' => 'local'])
{{ logMessage("\u{1F680}  Application deployed!") }}
@endtask

@task('deployOnlyCode',['on' => 'remote'])
{{ logMessage("\u{1F4BB}  Deploying code changes...") }}
cd {{ $currentDir }}
git pull origin master
php artisan cache:clear
sudo service php7.0-fpm restart
sudo supervisorctl restart all
@endtask

@after
@slack(env('SLACK_DEPLOYMENT_WEBHOOK_URL'), '#deployments', "Deployment on {$server}: {$baseDir} {$newReleaseName} by {$user}: {$task} done")
@endafter
