<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCandidateFollowup extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['customer_candidate_id', 'content', 'created_at'];

    public function customerCandidate() {
        return $this->belongsTo('App\Models\CustomerCandidate');
    }
}
