<?php
namespace Futbol\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
/**
 * 
 */
class CoachScope implements Scope
{
	
	/**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereRaw(" user.id in ( SELECT user_role.user_id from user_role WHERE user_role.role_id IN ( SELECT role.id FROM role WHERE role.`code` = 'profesores' or role.`code` = 'coach' )) ");
    }

}