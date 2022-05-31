<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'plan_create',
            ],
            [
                'id'    => 18,
                'title' => 'plan_edit',
            ],
            [
                'id'    => 19,
                'title' => 'plan_show',
            ],
            [
                'id'    => 20,
                'title' => 'plan_delete',
            ],
            [
                'id'    => 21,
                'title' => 'plan_access',
            ],
            [
                'id'    => 22,
                'title' => 'house_create',
            ],
            [
                'id'    => 23,
                'title' => 'house_edit',
            ],
            [
                'id'    => 24,
                'title' => 'house_show',
            ],
            [
                'id'    => 25,
                'title' => 'house_delete',
            ],
            [
                'id'    => 26,
                'title' => 'house_access',
            ],
            [
                'id'    => 27,
                'title' => 'loaction_create',
            ],
            [
                'id'    => 28,
                'title' => 'loaction_edit',
            ],
            [
                'id'    => 29,
                'title' => 'loaction_show',
            ],
            [
                'id'    => 30,
                'title' => 'loaction_delete',
            ],
            [
                'id'    => 31,
                'title' => 'loaction_access',
            ],
            [
                'id'    => 32,
                'title' => 'amenity_create',
            ],
            [
                'id'    => 33,
                'title' => 'amenity_edit',
            ],
            [
                'id'    => 34,
                'title' => 'amenity_show',
            ],
            [
                'id'    => 35,
                'title' => 'amenity_delete',
            ],
            [
                'id'    => 36,
                'title' => 'amenity_access',
            ],
            [
                'id'    => 37,
                'title' => 'house_management_access',
            ],
            [
                'id'    => 38,
                'title' => 'vehicle_listing_access',
            ],
            [
                'id'    => 39,
                'title' => 'car_create',
            ],
            [
                'id'    => 40,
                'title' => 'car_edit',
            ],
            [
                'id'    => 41,
                'title' => 'car_show',
            ],
            [
                'id'    => 42,
                'title' => 'car_delete',
            ],
            [
                'id'    => 43,
                'title' => 'car_access',
            ],
            [
                'id'    => 44,
                'title' => 'vehicle_info_create',
            ],
            [
                'id'    => 45,
                'title' => 'vehicle_info_edit',
            ],
            [
                'id'    => 46,
                'title' => 'vehicle_info_show',
            ],
            [
                'id'    => 47,
                'title' => 'vehicle_info_delete',
            ],
            [
                'id'    => 48,
                'title' => 'vehicle_info_access',
            ],
            [
                'id'    => 49,
                'title' => 'land_or_plot_listing_access',
            ],
            [
                'id'    => 50,
                'title' => 'land_or_plot_create',
            ],
            [
                'id'    => 51,
                'title' => 'land_or_plot_edit',
            ],
            [
                'id'    => 52,
                'title' => 'land_or_plot_show',
            ],
            [
                'id'    => 53,
                'title' => 'land_or_plot_delete',
            ],
            [
                'id'    => 54,
                'title' => 'land_or_plot_access',
            ],
            [
                'id'    => 55,
                'title' => 'electronic_create',
            ],
            [
                'id'    => 56,
                'title' => 'electronic_edit',
            ],
            [
                'id'    => 57,
                'title' => 'electronic_show',
            ],
            [
                'id'    => 58,
                'title' => 'electronic_delete',
            ],
            [
                'id'    => 59,
                'title' => 'electronic_access',
            ],
            [
                'id'    => 60,
                'title' => 'subscription_create',
            ],
            [
                'id'    => 61,
                'title' => 'subscription_edit',
            ],
            [
                'id'    => 62,
                'title' => 'subscription_show',
            ],
            [
                'id'    => 63,
                'title' => 'subscription_delete',
            ],
            [
                'id'    => 64,
                'title' => 'subscription_access',
            ],
            [
                'id'    => 65,
                'title' => 'advert_create',
            ],
            [
                'id'    => 66,
                'title' => 'advert_edit',
            ],
            [
                'id'    => 67,
                'title' => 'advert_show',
            ],
            [
                'id'    => 68,
                'title' => 'advert_delete',
            ],
            [
                'id'    => 69,
                'title' => 'advert_access',
            ],
            [
                'id'    => 70,
                'title' => 'team_create',
            ],
            [
                'id'    => 71,
                'title' => 'team_edit',
            ],
            [
                'id'    => 72,
                'title' => 'team_show',
            ],
            [
                'id'    => 73,
                'title' => 'team_delete',
            ],
            [
                'id'    => 74,
                'title' => 'team_access',
            ],
            [
                'id'    => 75,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
