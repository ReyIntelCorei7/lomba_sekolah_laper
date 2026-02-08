<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_keahlian_id',
        'name',
        'description',
        'icon',
        'gradient_from',
        'gradient_to',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Get the program that owns this skill
     */
    public function programKeahlian()
    {
        return $this->belongsTo(ProgramKeahlian::class);
    }
}
