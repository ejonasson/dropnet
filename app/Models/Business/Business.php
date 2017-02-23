<?php

namespace App\Models\Business;

use App\Models\Business\BusinessSettings;
use App\Models\Emails\Sequence;
use App\Models\Invoice;
use App\Models\Transaction\Transaction;
use App\Models\User\User;
use App\ValueObjects\StripeCredentials;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'businesses';

    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * Gets the current Business based on the Slug/Request
     * @return self
     */
    public static function current(): Business
    {
        $slug = request()->segment(1);

        // If this is an API route, get the second segment instead
        if ($slug === 'api') {
            $slug = request()->segment(2);
        }

        return self::fromSlug($slug);
    }

    public static function fromSlug(string $slug)
    {
        return self::where('slug', $slug)->get()->first();
    }

    /**
     * Get Our Stripe Credentials
     * @return StripeCredentials
     */
    public function getStripeCredentials()
    {
        $publishable_key = $this->settings()->where('name', 'publishable_key')->get()->first();
        $secret_key      = $this->settings()->where('name', 'secret_key')->get()->first();

        if ($publishable_key && $secret_key) {
            return new StripeCredentials($secret_key->value, $publishable_key->value);
        }

        return null;
    }

    public function updateSettings(array $data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'publishable_key':
                    $setting = $this->createOrUpdateSetting('publishable_key', $value);
                    break;
                case 'secret_key':
                    $setting = $this->createOrUpdateSetting('secret_key', $value);
                    break;
            }
        }
    }

    public function createOrUpdateSetting($name, $value)
    {
        $setting = $this->settings()->where('name', $name)->get()->first();
        if (!$setting) {
            return BusinessSettings::createSetting($this, $name, $value);
        }

        $setting->value = $value;
        $setting->save();

        return $setting;
    }

    public function settings()
    {
        return $this->hasMany(BusinessSettings::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function sequences()
    {
        return $this->hasMany(Sequence::class);
    }
}
