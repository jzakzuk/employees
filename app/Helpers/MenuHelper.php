<?php 

namespace App\Helpers;

class MenuHelper
{
    public static function menu(){
        return [
            [
                'title' => 'Administrar',
                'items' => [
                    [
                        'title' => 'Personal',
                        'dashboard_title' => 'Personal',
                        'link' => route('users.index'),
                        'target' => 'main_content_target'
                    ]
                ]
            ],
            /*[
                'title' => 'Roles',
                'dashboard_title' => 'Roles',
                'link' => route('users.index'),
                'target' => 'main_content_target'
            ]*/
        ];
    }

}