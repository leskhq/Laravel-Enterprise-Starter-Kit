<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;
use App\Models\Audit;

class AuditRepository extends Repository {

    public function model()
    {
        return 'App\Models\Audit';
    }

    /**
     *
     **/
    public static function log($user_id, $category, $message, $action = null, Array $attributes = null){

        $attJson = json_encode($attributes);

        $audit = Audit::create([
            "user_id"   => $user_id,
            "category"  => $category,
            "message"   => $message,
            "action"    => $action,
            "data"      => $attJson,
        ]);

        return $audit;
    }


}
