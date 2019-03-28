<?php


namespace PageAnalyzer;


use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'domains';

    protected $fillable = ['name'];
}
