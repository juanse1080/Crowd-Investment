<?php

use Illuminate\Database\Seeder;
use App\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      Usuario::create([
        'nombre' => 'Pedro',
        'apellido' => 'Trujillo',
        'password' => Hash::make('clave'),
        'correo' => 'p.trujillop@gmail.com',
        'cedula' => 1,
        'fecha_nacimiento'=>'1980-11-15'
      ]); 
      Usuario::create([
        'nombre' => 'Edward',
        'apellido' => 'Caballero',
        'password' => Hash::make('clave'),
        'correo' => 'edward.caballero.p@gmail.com',
        'cedula' => 2,
        'fecha_nacimiento'=>'1997-11-15'
      ]); 
    }
      
}
