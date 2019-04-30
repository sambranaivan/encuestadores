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
        $u->name = 'Francisco';
        $u->email = 'bosco';
        $u->role = 3;
        $u->password = bcrypt('1234');
        $u->save();
        $u = new User();
        $u->name = 'Martin Micelli';
        $u->email = 'martin';
        $u->role = 3;
        $u->password = bcrypt('1234');
        $u->save();
        $u = new User();
        $u->name = 'Paula Salvay';
        $u->email = 'paula';
        $u->role = 3;
        $u->password = bcrypt('1234');
        $u->save();
        $u = new User();
        $u->name = 'Ivan Sambrana';
        $u->email = 'ivan';
        $u->role = 3;
        $u->password = bcrypt('1234');
        $u->save();
        // Coordinadores
        $u = new User();
        $u->name = 'Mabel';
        $u->email = 'mabel';
        $u->role = 2;
        $u->password = bcrypt('1234');
        $u->save();

        // Supervisores
        $u = new User();
        $u->name = 'Carlos Pavon';
        $u->email = 'pavon';
        $u->role = 1;
        $u->password = bcrypt('1234');
        $u->save();

        $u = new User();
        $u->name = 'Eduardo Bravo';
        $u->email = 'eduardo';
        $u->role = 1;
        $u->password = bcrypt('1234');
        $u->save();
        // encuestadores / recuperadores
        $u = new User();
        $u->name = 'Carla';
        $u->email = 'carla';
        $u->role = 0;
        $u->password = bcrypt('1234');
        $u->save();
        $u = new User();
        $u->name = 'Sheila';
        $u->email = 'sheila';
        $u->role = 0;
        $u->password = bcrypt('1234');
        $u->save();
        $u = new User();
        $u->name = 'Vanesa';
        $u->email = 'vanesa';
        $u->role = 0;
        $u->password = bcrypt('1234');
        $u->save();
        $u = new User();
        $u->name = 'Mariana';
        $u->email = 'mariana';
        $u->role = 0;
        $u->password = bcrypt('1234');
        $u->save();
    }

    }
