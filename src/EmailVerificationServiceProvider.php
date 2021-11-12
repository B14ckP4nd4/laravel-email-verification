<?php


namespace BlackPanda\EmailVerification;


use Carbon\Laravel\ServiceProvider;

class EmailVerificationServiceProvider extends ServiceProvider
{
    /**
     * Here we set Routes at Package Boot stage
     * @return void
     */
    public function boot()
    {
        /*
         * Load Routes
         */
        $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');
    }

    /**
     * Register The Email Verification Plugin in laravel Service Providers
     * @return void
     */
    public function register()
    {
        /*
         * Load Migrations
         */
        if(!$this->migrationExist('create_user_email_verification_table')){
            $this->loadMigrationsFrom(__DIR__.'/Migrations');
        }

        /*
         * Publish Migrations
         */
        $this->publishes([
            __DIR__ . '/Migrations/2021_11_10_185924_create_user_email_verification_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_user_email_verification_table.php'),
        ], 'migrations');

    }

    /**
     * @param string $name
     * @return bool
     */
    protected function migrationExist(string $name)
    {
        $migrationsPath = database_path('migrations/');
        $migrations = scandir($migrationsPath);
        $strpos = false;
        foreach ($migrations as $migration) {
            $strpos = strpos($migration, $name);
            if ($strpos !== false) return true;
        }

        return false;
    }

}
