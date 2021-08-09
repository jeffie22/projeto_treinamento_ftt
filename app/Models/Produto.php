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
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function setValorAttribute($v)
    {
        $v = str_replace('.','',$v);
        $v = str_replace(',','',$v);
        $this->attributes['valor'] = $v > 0 ? $v/100 : 0;
    }

    public function getValorShowAttribute()
    {
        return 'R$ '.number_format($this->valor,2,',','.');
    }
}
