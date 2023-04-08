<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
  use HasFactory, UuidTrait;

  public $incrementing = false;
  protected $keyType = 'uuid';

  protected $fillable = [
      'user_id',
      'lesson_id',
      'description',
      'status'
  ];

  public $statusOptions = [
      'P' => '(P) Aguardando Instrutor',
      'A' => '(A) Aguardando Aluno',
      'C' => '(C) Suporte Concluído'
  ];

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function lesson()
  {
      return $this->belongsTo(Lesson::class);
  }

  public function replies()
  {
      return $this->hasMany(ReplySupport::class);
  }
}
