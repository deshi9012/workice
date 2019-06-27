<?php

namespace Modules\Settings\Entities;

use App\Traits\Observable;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Events\SettingUpdated;
use Modules\Settings\Observers\SetupObserver;

class Options extends Model
{
    use Observable;

    protected static $observer = SetupObserver::class;
    protected static $scope    = null;

    protected $fillable = ['config_key', 'value'];
    public $timestamps  = false;
    protected $table    = 'config';

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updated' => SettingUpdated::class,
    ];

    // public function getValueAttribute()
    // {
    //     return strip_tags($this->attributes['value']);
    // }

    public static function translations()
    {
        $tran      = array();
        $companies = \Modules\Clients\Entities\Client::select('locale')->groupBy('locale')->orderBy('locale', 'asc')->get();
        $users     = \Modules\Users\Entities\User::select('locale')->groupBy('locale')->orderBy('locale', 'asc')->get();
        foreach ($companies as $lang) {
            if (!empty($lang->locale)) {
                $tran[$lang->locale] = $lang->locale;
            }
        }
        foreach ($users as $lan) {
            if (!empty($lan->locale)) {
                $tran[$lan->locale] = $lan->locale;
            }
        }
        if (isset($tran['en'])) {
            unset($tran['en']);
        }

        return $tran;
    }

    public function setValueAttribute($value)
    {
        if (in_array($this->config_key, $this->encryptedValues())) {
            $this->attributes['value'] = encrypt($value);
        } else {
            $this->attributes['value'] = $value;
        }
    }
    public function getValueAttribute($value)
    {
        if (in_array($this->config_key, $this->encryptedValues())) {
            return !empty($value) ? decrypt($value) : $value;
        } else {
            return $value;
        }
    }

    private function encryptedValues()
    {
        return [
            'purchase_code',
            'smtp_pass',
        ];
    }
}
