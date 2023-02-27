<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Description of Assignments
 * Clientes
 * @author Rodrigo C
 */
class Assignment extends Model
{
    use HasFactory;
    protected $table = 'assignments'; // nome da tabela
    protected $primaryKey = 'cod_assignment'; // chave primária  
    public $incrementing = true; // indica se os IDs são auto-incremento
    public $timestamps = false; // ativa os campos created_at e updated_at
    
    /* Fillable possibilitará criar novos registros simplesmente usando
    * o método create e outros da classe Model passando
    * um array associativo as colunas da classe
    */
    protected $fillable = [
      'cod_user',
      'cod_task',
      'designated_by',
      'status'
    ];
    
// DEFININDO RELAÇÕES ------------------------------------------------------------------------
    
    // Uma ATRIBUIÇÃO tem uma TAREFA
    public function task() {
       return $this->belongsTo(Task::class, 'cod_task');
    }
    
    // Uma ATRIBUIÇÃO pertemce a um USUÁRIO
    public function user() {
       return $this->belongsTo(User::class, 'cod_user');
    }
}
