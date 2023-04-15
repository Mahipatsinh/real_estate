<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RealEstateProperty extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
		'name',
		'real_estate_type',
		'street',
		'external_number',
		'internal_number',
		'neighborhood',
		'city',
		'country',
		'rooms',
		'bathrooms',
		'comments'
	];
}
