<?php

namespace App\Models;

use App\Support\Cropper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'genre',
        'document',
        'document_secondary',
        'document_secondary_complement',
        'date_of_birth',
        'place_of_birth',
        'civil_status',
        'cover',
        'occupation',
        'income',
        'company_work',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',
        'telephone',
        'cell',
        'type_of_communion',
        'spouse_name',
        'spouse_genre',
        'spouse_document',
        'spouse_document_secondary',
        'spouse_document_secondary_complement',
        'spouse_date_of_birth',
        'spouse_place_of_birth',
        'spouse_occupation',
        'spouse_income',
        'spouse_company_work',
        'lessor',
        'lessee',
        'admin',
        'client',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUrlCoverAttribute()
    {
        if (!empty($this->cover)) {
            return Storage::url(Cropper::thumb($this->cover, 200, 200));
        }

        return '';
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'user', 'id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'user', 'id');
    }

    //SCOPES
    public function scopeLessors($query)
    {
        return $query->where('lessor',true);
    }

    public function scopeLessees($query)
    {
        return $query->where('lessee',true);
    }

    public function scopeAdmins($query)
    {
        return $query->where('admin',true);
    }

    //SET
    public function setLessorAttribute($value)
    {
        $this->attributes['lessor'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setLesseeAttribute($value)
    {
        $this->attributes['lessee'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setAdminAttribute($value)
    {
        $this->attributes['admin'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = ($value == true || $value == 'on' ? 1 : 0);
    }

    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = $this->clearField($value);
    }

    public function getDocumentAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return
            substr($value, 0, 3) . '.' .
            substr($value, 3, 3) . '.' .
            substr($value, 6, 3) . '-' .
            substr($value, 9, 2);
    }

    public function setDocumentSecondaryAttribute($value)
    {
        $this->attributes['document_secondary'] = $this->clearField($value);
    }

    public function setIncomeAttribute($value)
    {
        $this->attributes['income'] = floatval($this->convertStringToDouble($value));
    }

    public function getIncomeAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = $this->clearField($value);
    }

    public function setCellAttribute($value)
    {
        $this->attributes['cell'] = $this->clearField($value);
    }

    public function setPasswordAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        $this->attributes['password'] = bcrypt($value);
    }

    //SPOUSE
    public function setSpouseDocumentAttribute($value)
    {
        $this->attributes['spouse_document'] = $this->clearField($value);
    }

    public function setSpouseIncomeAttribute($value)
    {
        $this->attributes['spouse_income'] = floatval($this->convertStringToDouble($value));
    }

    public function setSpouseDocumentSecondaryAttribute($value)
    {
        $this->attributes['spouse_document_secondary'] = $this->clearField($value);
    }

    //PRIVADOS
    private function clearField($param)
    {
        if (empty($param)) {
            return '';
        }
        return str_replace(['.', ',', '-', '/', '(', ')', ' '], '', $param);
    }

    private function convertStringToDouble($param)
    {
        if (empty($param)) {
            return '';
        }
        return str_replace(',', '.', str_replace('.', '', $param));
    }

}
