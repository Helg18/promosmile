<?php

class Maquilero extends \Eloquent
{

    protected $table = 'maquileros';

    public static $rules = [
        'nombre'           => 'required',
        'persona_contacto' => 'required',
        'rfc'              => 'required',
        'calle'            => 'required',
        'numinterior'      => 'required',
        'numexterior'      => 'required',
        'colonia'          => 'required',
        'cp'               => 'required',
        'pais'             => 'required',
        'municipio'        => 'required',
        'email'            => 'required',
        'telefono'         => 'required',
    ];

    protected $fillable = [
        'nombre',
        'persona_contacto',
        'rfc',
        'calle',
        'numinterior',
        'numexterior',
        'colonia',
        'cp',
        'pais',
        'municipio',
        'email',
        'telefono',
    ];
}
