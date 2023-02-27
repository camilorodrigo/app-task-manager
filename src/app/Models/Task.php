<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Description of Tasks
 * Clientes
 * @author Rodrigo C
 */

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks'; // nome da tabela
    protected $primaryKey = 'cod_task'; // chave primária  
    public $incrementing = true; // indica se os IDs são auto-incremento
    public $timestamps = false; // ativa os campos created_at e updated_at
    
    /* Fillable possibilitará criar novos registros simplesmente usando
    * o método create e outros da classe Model passando
    * um array associativo as colunas da classe
    */
    protected $fillable = [
      'title',
      'description',
      'start_date',
      'end_date',
      'status'
    ];
    
// DEFININDO RELAÇÕES ------------------------------------------------------------------------

    // Uma TAREFA está em uma Atribuição
    public function assignment() {  
     // HASONE: MODEL RELACIONADO, CHAVE ESTRANGEIRA LÁ, CHAVE PRIMÁRIA AQUI 
     return $this->hasOne(Assignment::class, 'cod_task', 'cod_task');
    }  
   
}
