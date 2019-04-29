<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->userDefecto();
    }
    public function userDefecto(){
        $u = new User();
        $u->name = 'ivan-admin';
        $u->email = 'direccion';
        $u->role = 3;
        $u->password = bcrypt('1234');
        $u->save();

        $u = new User();
        $u->name = 'ivan-coordinador';
        $u->email = 'coordinador';
        $u->role = 2;
        $u->password = bcrypt('1234');
        $u->save();
        $u = new User();
        $u->name = 'ivan-supervisor';
        $u->email = 'supervisor';
        $u->role = 1;
        $u->password = bcrypt('1234');
        $u->save();
        $u = new User();
        $u->name = 'ivan-encuestador';
        $u->email = 'encuestador';
        $u->role = 0;
        $u->password = bcrypt('1234');
        $u->save();
        }
}
