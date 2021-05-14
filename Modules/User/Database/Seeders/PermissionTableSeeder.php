<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'User' => [
                'Role' => [
                    'role-list',
                    'role-create',
                    'role-edit',
                    'role-delete',
                ],
                'User'=>[
                    'user-list',
                    'user-create',
                    'user-edit',
                    'user-delete',
                ],
                'Permissions' => [
                    'permission-list',
                    'permission-create',
                    'permission-edit',
                    'permission-delete',
                ]
            ],
            'System' => [
                'Configuration Fields' => [
                    'configuration-fields-list',
                    'configuration-fields-create',
                    'configuration-fields-edit',
                    'configuration-fields-delete',
                ],
                'Pages' => [
                    'pages-list',
                    'pages-create',
                    'pages-edit',
                    'pages-delete',
                ],
                'Configuration Update'=>[
                    'configuration-update-list',
                    'configuration-update-update',
                ],
                'Activity' => [
                    'activity-list',
                    'activity-show',
                    'activity-delete'
                ],
                'General' => [
                    'error-logs'
                ],
                'Dashboard' => [
                    'analytics-widgets'
                ],
                'Newsletter' => [
                    'newsletter-list',
                    'newsletter-delete',
                    'newsletter-show',
                ],
                'Messages' => [
                    'messages-list',
                    'messages-delete',
                    'messages-show',
                ]
            ],
            'Post' => [
                'Category' => [
                    'categories-list',
                    'categories-create',
                    'categories-edit',
                    'categories-show',
                    'categories-delete',
                    'categories-slug-editing',
                    'categories-order'
                ],
                'Post'=>[
                    'posts-list',
                    'posts-create',
                    'posts-edit',
                    'posts-delete',
                    'posts-show',
                    'posts-slug-editing',
                    'posts-publish',
                    'posts-list-all',
                    'posts-view-task-logs'
                ],
                'Published Post'=>[
                    'posts-status',
                    'posts-featured',
                    'published-posts-list',
                ],
                'Tags' => [
                    'tags-list',
                    'tags-create',
                    'tags-edit',
                    'tags-delete',
                ],
            ],
         ];
         $all_permissions = Permission::all()->pluck('name')->toArray();
         foreach ($permissions as $module => $val) {
             foreach($val as $group => $group_rows){
                 foreach($group_rows as $role_list => $role){
                     if(!in_array($role,$all_permissions)){
                        Permission::updateOrCreate(['name' => $role,'group' => $group,'module'=>$module]);
                     }
                 }
             }
         }
    }
}
