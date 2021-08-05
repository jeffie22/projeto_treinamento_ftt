<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Produto
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 04/08/2021 - 15:27
 * @package App\Models
 */
class Produto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->hasOne(Categoria::class, 'id', 'categoria_id');
    }
}
