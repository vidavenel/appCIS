<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Storage;

class ImportUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import des utilisateurs depuis un fichier CSV';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Storage::disk('local')->writeStream('users.csv', Storage::disk('sftp')->readStream('data/users.csv'));
        $row = 1;
        if (($handle = fopen(storage_path('app/users.csv'), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                if ($data[1] === 'name') {
                    continue;
                }
                User::updateOrCreate(
                    ['email' => $data[2]],
                    ['name' => $data[1], 'password' => $data[3]],
                );
                $row++;
            }
            fclose($handle);
        }
        Storage::disk('local')->delete('users.csv');
        return 0;
    }
}
