<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@bets.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$WG6.C.53HAnXPuJ3TeAwEeD4A8nVdYQZP7D6SthrUbDewU/6r9eGW',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'data_nascimento' => NULL,
                'cpf' => NULL,
                'status' => NULL,
                'tipo_usuario' => 2,
                'idgerente' => NULL,
                'telefone' => NULL,
            ),
            1 => 
            array (
                'id' => 15,
                'name' => 'Digão',
                'email' => 'rodrigoadmcontabeis@icloud.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$qh4RGKShVIN0pXu/KcI8dejpVdjnCg5Dc4uVUrKDdvG1SeIi8vLJq',
                'remember_token' => NULL,
                'created_at' => '2021-07-12 23:48:59',
                'updated_at' => '2021-07-12 23:48:59',
                'data_nascimento' => '19/10/1992',
                'cpf' => '000.000.000-29',
                'status' => 1,
                'tipo_usuario' => 4,
                'idgerente' => 14,
                'telefone' => NULL,
            ),
            2 => 
            array (
                'id' => 14,
                'name' => 'Rodrigo Ferreira',
                'email' => 'rodrigosf23@outlook.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$geEsbxjAxk87aaG5ZFFDfe9Lsu3NbPz9f/2puiifKDoV1D9lyauAG',
                'remember_token' => NULL,
                'created_at' => '2021-07-12 23:46:17',
                'updated_at' => '2021-07-12 23:46:17',
                'data_nascimento' => '19/10/1992',
                'cpf' => '000.000.000-92',
                'status' => 1,
                'tipo_usuario' => 3,
                'idgerente' => NULL,
                'telefone' => NULL,
            ),
            3 => 
            array (
                'id' => 13,
                'name' => 'Lucas N Andrade',
                'email' => 'Lucas@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$rKJ/aRjmhW91thxtlQBnruywgjDfUooNkn89tEgbdHnCvUBmIznS.',
                'remember_token' => NULL,
                'created_at' => '2021-07-11 21:13:13',
                'updated_at' => '2021-07-11 21:13:13',
                'data_nascimento' => '01/01/2000',
                'cpf' => '999.999.999-28',
                'status' => 1,
                'tipo_usuario' => 1,
                'idgerente' => NULL,
                'telefone' => '87918373839',
            ),
            4 => 
            array (
                'id' => 12,
                'name' => 'Rodrigo Santos Ferreira',
                'email' => 'Rodrigosfn23@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$KSvb9az6JxicykQPYZ4mwOpqjihJg/wrQECtBETlE.QbTfbTzpDd6',
                'remember_token' => NULL,
                'created_at' => '2021-06-23 20:36:20',
                'updated_at' => '2021-06-23 20:36:20',
                'data_nascimento' => '19/10/1992',
                'cpf' => '056.116.543-20',
                'status' => 1,
                'tipo_usuario' => 1,
                'idgerente' => NULL,
                'telefone' => '86981556131',
            ),
            5 => 
            array (
                'id' => 11,
                'name' => 'Lazaro Cambista',
                'email' => 'cambista@bellagioesportes.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$7uDbVpj1sgYYewwCDzJ1duk0/0H6qWSCbG36UfWJLm.WOssv5Lzry',
                'remember_token' => NULL,
                'created_at' => '2021-06-23 00:25:37',
                'updated_at' => '2021-06-23 00:25:37',
                'data_nascimento' => '14/12/1987',
                'cpf' => '385.687.090-36',
                'status' => 1,
                'tipo_usuario' => 4,
                'idgerente' => 10,
                'telefone' => NULL,
            ),
            6 => 
            array (
                'id' => 10,
                'name' => 'Lazaro',
                'email' => 'gerente@bellagioesportes.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$VUfeC8p5Q5T33KSgAjwPUuE.Yb5UxHxpwC7KqnXvPvLL2ryleitLe',
                'remember_token' => NULL,
                'created_at' => '2021-06-23 00:19:11',
                'updated_at' => '2021-06-23 00:19:11',
                'data_nascimento' => '14/12/1987',
                'cpf' => '085.944.770-74',
                'status' => 1,
                'tipo_usuario' => 3,
                'idgerente' => NULL,
                'telefone' => NULL,
            ),
            7 => 
            array (
                'id' => 16,
                'name' => 'robs sdddcccs dfdsfdsfsdfsdf',
                'email' => 'oi@oi.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$qiypr4Q3eL02zRT91aEKtO4CJ1ACmYyKUqbaA5YmYuQHJpLFs18T6',
                'remember_token' => NULL,
                'created_at' => '2021-07-26 15:27:09',
                'updated_at' => '2021-07-31 14:31:28',
                'data_nascimento' => '01/12/1987',
                'cpf' => '355.581.140-10',
                'status' => 2,
                'tipo_usuario' => 1,
                'idgerente' => NULL,
                'telefone' => '21555548788443344433',
            ),
            8 => 
            array (
                'id' => 17,
                'name' => 'Teste',
                'email' => 'cambista2@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$3VRozpmg21Sy6/YqUW36GOJddNMlkZYhyA8phiZzMjXBlBTg3TiCy',
                'remember_token' => NULL,
                'created_at' => '2021-07-26 18:21:08',
                'updated_at' => '2021-07-26 18:21:08',
                'data_nascimento' => '14/12/1987',
                'cpf' => '000.000.000-00',
                'status' => 1,
                'tipo_usuario' => 4,
                'idgerente' => 10,
                'telefone' => NULL,
            ),
            9 => 
            array (
                'id' => 18,
                'name' => 'Nivaldo Júnior',
                'email' => 'nivaldoabl@hotmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$AUdpfDVTmGTylxlrscHcrOFZ6IUWk85BulJzY9fWju9D0Mh7LjxAy',
                'remember_token' => NULL,
                'created_at' => '2021-07-31 15:56:30',
                'updated_at' => '2021-07-31 15:56:30',
                'data_nascimento' => '14/12/1987',
                'cpf' => '123.456.789-10',
                'status' => 1,
                'tipo_usuario' => 1,
                'idgerente' => NULL,
                'telefone' => '8699912782',
            ),
            10 => 
            array (
                'id' => 19,
                'name' => 'Victor com hugo',
                'email' => 'cambista@admin.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$lBgzK4CuClMD52pKzXF/0uhvbJYJ20k4m/UCRahD4Exn5qZ1PUj6W',
                'remember_token' => NULL,
                'created_at' => '2021-08-29 15:28:31',
                'updated_at' => '2021-08-29 15:28:31',
                'data_nascimento' => '22/06/1999',
                'cpf' => '079.016.013-70',
                'status' => 1,
                'tipo_usuario' => 4,
                'idgerente' => 14,
                'telefone' => NULL,
            ),
            11 => 
            array (
                'id' => 20,
                'name' => 'pedro neto',
                'email' => 'pedr0net0@icloud.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$qhzTYdeiN8Q7MAm6NLUm/eetN38D0u4ICi9Tk8o44AB4aywOwF9qu',
                'remember_token' => NULL,
                'created_at' => '2021-09-13 18:30:05',
                'updated_at' => '2021-09-13 18:30:05',
                'data_nascimento' => '30/03/1989',
                'cpf' => '004.558.683-79',
                'status' => 1,
                'tipo_usuario' => 4,
                'idgerente' => 14,
                'telefone' => NULL,
            ),
            12 => 
            array (
                'id' => 21,
                'name' => 'Alysson Brito',
                'email' => 'alysson@bets.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$E6qlIyWBEyWN0EIwbz9G/.YX5jP7Zc8ZxODxChOtX94akbagC1mzO',
                'remember_token' => NULL,
                'created_at' => '2021-09-14 21:59:03',
                'updated_at' => '2021-09-14 21:59:03',
                'data_nascimento' => '10/05/1980',
                'cpf' => '299.800.050-92',
                'status' => 1,
                'tipo_usuario' => 3,
                'idgerente' => NULL,
                'telefone' => NULL,
            ),
            13 => 
            array (
                'id' => 22,
                'name' => 'Pablo Veras',
                'email' => 'pabloveras@bets.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$wzg5G3//NY.9odo0KdBMKe1mylsbsC4OdbiDI.z4eOqYKg0RcG3wq',
                'remember_token' => NULL,
                'created_at' => '2021-09-14 22:03:47',
                'updated_at' => '2021-09-14 22:03:47',
                'data_nascimento' => '10/10/1980',
                'cpf' => '882.411.260-93',
                'status' => 1,
                'tipo_usuario' => 4,
                'idgerente' => 21,
                'telefone' => NULL,
            ),
        ));
        
        
    }
}