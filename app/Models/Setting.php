<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
    ];

    protected $casts = [
        'value' => 'string',
    ];

    public static function get($key, $default = null)
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = self::where('key', $key)->first();
            return $setting ? self::castValue($setting->value, $setting->type) : $default;
        });
    }

    public static function set($key, $value, $type = 'text')
    {
        $setting = self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );

        Cache::forget("setting.{$key}");

        return $setting;
    }

    public static function getAll()
    {
        return Cache::rememberForever('settings.all', function () {
            return self::pluck('value', 'key')->toArray();
        });
    }

    public static function clearCache($key = null)
    {
        if ($key) {
            Cache::forget("setting.{$key}");
        } else {
            Cache::forget('settings.all');
        }
    }

    protected static function castValue($value, $type)
    {
        switch ($type) {
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'integer':
                return (int) $value;
            case 'float':
                return (float) $value;
            case 'json':
                return json_decode($value, true);
            default:
                return $value;
        }
    }

    protected static function booted()
    {
        static::saved(function ($setting) {
            Cache::forget("setting.{$setting->key}");
            Cache::forget('settings.all');
        });

        static::deleted(function ($setting) {
            Cache::forget("setting.{$setting->key}");
            Cache::forget('settings.all');
        });
    }
}
