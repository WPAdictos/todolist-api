<?php


use Phinx\Migration\AbstractMigration;

class Sprint1 extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
     // creacion de las tablas del SPRINT 1
     // tabla accounts,  todolist y categorias

     
        $table = $this->table('accounts', ['signed' => false,'engine' => 'MyISAM']);
        $table->addColumn('username', 'string', ['limit' => 50])
              ->addColumn('hashed', 'string', ['limit' => 255])
              ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addIndex(['username', 'hashed'], ['unique' => true])
              ->create();
     
        $table = $this->table('categories', ['signed' => false,'engine' => 'MyISAM']);
        $table->addColumn('categoryname', 'string', ['limit' => 50])
              ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->create();

        $table = $this->table('todolist', ['signed' => false,'engine' => 'MyISAM']);
        $table->addColumn('categories_id', 'integer')
              ->addColumn('accounts_id', 'integer')
              ->addColumn('todo', 'string', ['limit' => 255])
              ->addColumn('done', 'boolean', ['default' => false])
              ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->create();
    }

    public function down()
    {
        $this->dropTable('accounts');
        $this->dropTable('categories');
        $this->dropTable('todolist');
    }


}
