<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\RouteCollection;

class Menu extends Model
{
    /**
     * @var array
     */
    protected $fillable = [ /*'id',*/ 'name', 'label', 'position', 'icon', 'separator', 'url',
                            'enabled', 'parent_id', 'route_id', 'permission_id'];

    public function children() {

        // Root is the parent of itself therefore also a child of itself.
        // This can create an infinite loop so we must forcibly remove
        // that entry here.
        $kids = $this->hasMany('App\Models\Menu','parent_id')
            ->where('name', '!=', 'root')
            ->orderBy('position', 'ASC')
            ->orderBy('label', 'ASC')
            ->orderBy('id', 'ASC');

//        foreach($kids as $child) {
//            $child->dad = $this;
//        }
        return  $kids;
    }

    public function parent() {
        $dad = $this->belongsTo('App\Models\Menu','parent_id');
//        if(isset($dad->kids)) {
//            $dad->kids->merge($dad);
//        }
        return $dad;
    }

    public function route() {
        return $this->belongsTo('App\Models\Route','route_id');
    }

    public function permission() {
        return $this->belongsTo('App\Models\Permission','permission_id');
    }

    /**
     * @return string
     */
    public function getTextAttribute()
    {
        return $this->Label;
    }


    /**
     * @return bool
     */
    public function isDeletable()
    {
        // Protect the root menu from deletion
        if ( ('root' == $this->name) ) {
            return false;
        }

        // Fix #32: Prevent deletion of nodes with children
        $children = $this->children();
        if ( $children && ($children->count() > 0) ) {
            return false;
        }

        return true;
    }


    /**
     * @return bool
     */
    public function isEditable()
    {
        // Protect the root menu from deletion
        if ( ('root' == $this->name) ) {
            return false;
        }

        return true;
    }


}
