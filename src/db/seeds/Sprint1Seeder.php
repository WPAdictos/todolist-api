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
    // $con = $this->adapter->getConnection();
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
    $posts->insert($data)->save();

    // creamos unos usuarios
    $users = $this->table('accounts');
    $usersinfo = $this->table('accounts_info');
   
    $data = ['username'    => 'kike@izarmedia.es',
            'hashed' =>  password_hash("kike", PASSWORD_DEFAULT),
            ];
    $users->insert($data)->save();
    $lastID= $this->fetchRow("select LAST_INSERT_ID()")[0];
    $data =[
           'accounts_id' => $lastID,
           'scope' => serialize([
                     'todo' => 5,
                     'categ'=> 5
           ])
    ];
    $usersinfo->insert($data)->save();
   
   
    $data = ['username'    => 'sergio@izarmedia.es',
            'hashed' => password_hash("sergio", PASSWORD_DEFAULT),
            ];
    
    $users->insert($data)->save();
    $lastID= $this->fetchRow("select LAST_INSERT_ID()")[0];
    $data =[
           'accounts_id' => $lastID,
           'scope' => serialize([
                     'todo' => 3,
                     'categ'=> 1
           ])
    ];
    $usersinfo->insert($data)->save();     




    //Creamos unas 30 todolist 
    $faker = Faker\Factory::create('es_ES');
    for ($i=0; $i < 100; $i++) {
        $data=array();
        $data['categories_id']=rand(1,4);
        $data['accounts_id']=rand(1,2);
        $data['done']=rand(0,1);
        $data['todo']=$faker->text($maxNbChars = 100);
        $this->insert('todolist', $data);
    }

     //$this->getAdapter()->getConnection()->lastInsertId();

    }
}
