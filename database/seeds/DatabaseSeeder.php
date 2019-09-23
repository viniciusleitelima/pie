<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(InstituicaoTableSeeder::class);
        $this->call(CursoTableSeeder::class);
        $this->call(AlunoTableSeeder::class);
        $this->call(InstituicaoCursosTableSeeder::class);
        $this->call(GestorTableSeeder::class);
    }
}

class InstituicaoTableSeeder extends Seeder{
    public function run()
    {
        DB::insert('INSERT INTO instituicoes (nome,cnpj,status) VALUES (?,?,?)', array('PRAVALER','02934238472',1));
        DB::insert('INSERT INTO instituicoes (nome,cnpj,status) VALUES (?,?,?)', array('TESTE','495829034857',1));
    }
}

class CursoTableSeeder extends Seeder{
    public function run()
    {
        DB::insert('INSERT INTO cursos (nome,duracao,status) VALUES (?,?,?)', array('CIENCIA E TECNOLOGIA','4 ANOS',1));
        DB::insert('INSERT INTO cursos (nome,duracao,status) VALUES (?,?,?)', array('TESTE','3 ANOS',1));
    }
}

class AlunoTableSeeder extends Seeder{
    public function run()
    {
        DB::insert('INSERT INTO alunos (nome,cpf,dt_nascimento,email,celular,endereco,numero,bairro,cidade,uf,status,id_curso,id_instituicao) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)', array('TESTE','09481237485','1995-11-17','teste@teste.com','99328-3489','rua teste','23','teste','testando','te',1,1,1));

    }
}

class InstituicaoCursosTableSeeder extends Seeder{
    public function run()
    {
        DB::insert('INSERT INTO instituicao_cursos (id_curso,id_instituicao,status) VALUES (?,?,?)', array(1,1,1));

    }
}

class GestorTableSeeder extends Seeder{
    public function run()
    {
        DB::insert('INSERT INTO gestores (nome,email,id_instituicao,status) VALUES (?,?,?,?)', array('TESTE GESTOR','gestorteste@teste.com',1));

    }
}

class UserTableSeeder extends Seeder{
    public function run()
    {
        DB::insert('INSERT INTO users (name,email,password,status) VALUES (?,?,?,?)', array('CARLA FREITAS','carla.freitas@teste.com','$2y$10$ESrFqGC.D.saHezOlhblMerm1Cr/UowdpMDNefFjYhcKqVNDZdaOa',1));
        DB::insert('INSERT INTO users (name,email,password,status) VALUES (?,?,?,?)', array('Pedro Silva','pedro.silva@teste.com','$2y$10$ESrFqGC.D.saHezOlhblMerm1Cr/UowdpMDNefFjYhcKqVNDZdaOa',1));

    }
}
