<?php


use Phinx\Seed\AbstractSeed;

class Sprint1Seeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
      //Creamos unas categorias
      $data = [
        [
            'categoryname'    => 'Compras'
        ],[
            'categoryname'    => 'Viajes',
        ],[
            'categoryname'    => 'Salud',
        ],[
            'categoryname'    => 'Economia',
        ]
     ];

    $posts = $this->table('categories');
    $posts->insert($data)
          ->save();

    // creamos unos usuarios
    $data = [
        [
            'username'    => 'kike@izarmedia.es',
            'hashed' =>  password_hash("kike", PASSWORD_DEFAULT),
        ],[
            'username'    => 'sergio@izarmedia.es',
            'hashed' => password_hash("sergio", PASSWORD_DEFAULT),
        ]
     ];
     $posts = $this->table('accounts');
     $posts->insert($data)
           ->save();
 
    //Creamos unas 30 todolist 
    $faker = Faker\Factory::create('es_ES');
    for ($i=0; $i < 30; $i++) {
        $data=array();
        $data['categories_id']=rand(1,4);
        $data['accounts_id']=rand(1,2);
        $data['done']=rand(0,1);
        $data['todo']=$faker->text($maxNbChars = 100);
        $this->insert('todolist', $data);
    }



    }
}
