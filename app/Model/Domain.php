<?php


namespace PageAnalyzer\Model;


use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'domains';

    protected $fillable = ['name', 'content_length', 'code', 'body', 'h1', 'keywords', 'description'];
}
