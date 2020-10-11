<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Scripts model
  * @property $script_id
 * @property $script_name
 * @property $script_display_name
 * @property $script_isin_number
 * @property $script_sector
 * @property $script_description
 * @property $script_website
 * @property $script_peer_1
 * @property $script_peer_2
 * @property $script_peer_3
 * @property $script_availability
 * @property $script_min_lot
 * @property $script_status
 * @property $script_face_val
 * @property $script_ltp
 * @property $created_at
 * @property $created_by
 * @property $updated_at
 * @property $last_updated_by
 */

class Scripts extends Model
{
    protected $guarded = ['script_id'];

    protected $appends = ['lower','upper', 'slot_url'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_scripts';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['script_name', 'script_display_name', 'script_isin_number', 'script_sector', 'script_description', 'script_website', 'script_peer_1', 'script_peer_2', 'script_peer_3', 'script_availability', 'script_min_lot', 'script_status', 'script_face_val', 'script_ltp', 'created_by', 'last_update_date', 'last_updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    public static function findByField($field, $value)
    {
        return self::where($field, (string)$value)->first();
    }

    public function getUpperAttribute(){
        return $this->script_ltp + ((30 / 100) * $this->script_ltp);
    }

    public function getLowerAttribute(){
        return $this->script_ltp - ((30 / 100) * $this->script_ltp);
    }

    public function getSlotUrlAttribute(){
        return strtolower(str_replace(' ','-',$this->script_display_name));
    }

    public function scriptNewsLinks(){
        return $this->hasMany(ScriptNewslinks::class,'script_id','script_id');
    }

    public function lastYearScriptFinancial(){
        return $this->hasOne(ScriptFinancials::class, 'script_id','script_id')->orderByDesc('fin_year');
    }

    public function scriptReports(){
        return $this->hasMany(ScriptReports::class,'script_id','script_id');
    }

    public function scriptFinancials(){
        return $this->hasMany(ScriptFinancials::class,'script_id','script_id');
    }
}
