<?php

namespace Webkul\Quote\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Attribute\Traits\CustomAttribute;
use Webkul\User\Models\UserProxy;
use Webkul\Contact\Models\PersonProxy;
use Webkul\Lead\Models\LeadProxy;
use Webkul\Quote\Contracts\Quote as QuoteContract;

class Quote extends Model implements QuoteContract
{
    use CustomAttribute;

    protected $table = 'quotes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'tax',
        'tip',
        'user_id',
        'person_id',
    ];

    /**
     * Get the quote items record associated with the quote.
     */
    public function items()
    {
        return $this->hasMany(QuoteItemProxy::modelClass());
    }

    /**
     * Get the user that owns the quote.
     */
    public function user()
    {
        return $this->belongsTo(UserProxy::modelClass());
    }

    /**
     * Get the person that owns the quote.
     */
    public function person()
    {
        return $this->belongsTo(PersonProxy::modelClass());
    }

    /**
     * The leads that belong to the quote.
     */
    public function leads()
    {
        return $this->belongsToMany(LeadProxy::modelClass(), 'lead_quotes');
    }
}
