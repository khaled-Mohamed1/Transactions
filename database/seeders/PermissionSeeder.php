<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'موظفين-بيانات',
            'موظفين-اضافة',
            'موظفين-تعديل',
            'موظفين-حذف',
            'وظائف-بيانات',
            'وظائف-اضافة',
            'وظائف-تعديل',
            'وظائف-حذف',
            'صلاحيات-بيانات',
            'صلاحيات-اضافة',
            'صلاحيات-تعديل',
            'صلاحيات-حذف',
            'عملاء-بيانات',
            'عملاء-الجميع',
            'عملاء-اضافة',
            'عملاء-تعديل',
            'عملاء-حذف',
            'عملاء-ملف-شخصي',
            'عملاء-المتعسرين',
            'عملاء-الملتزمين',
            'عملاء-المرفوضين',
            'عملاء-المهام',
            'عملاء-المتابعة',
            'عملاء-استراد',
            'عملاء-دفعات',
            'عملاء-دفعات-حذف',
            'مرفقات-اضافة',
            'مرفقات-اظهار',
            'مرفقات-حذف',
            'معاملات-بيانات',
            'معاملات-جميع',
            'معاملات-اضافة',
            'معاملات-تعديل',
            'معاملات-حذف',
            'معاملات-تصدير',
            'كمبيالات-بيانات',
            'كمبيالات-اضافة',
            'كمبيالات-تعديل',
            'كمبيالات-حذف',
            'كمبيالات-تصدير',
            'قضايا-بيانات',
            'قضايا-اضافة',
            'قضايا-تعديل',
            'قضايا-حذف',
            'قضايا-تصدير',
            'قضايا-جميع',
            'وكلاء-بيانات',
            'وكلاء-اضافة',
            'وكلاء-تعديل',
            'وكلاء-حذف',
            'مخازن-بيانات',
            'مخازن-اضافة',
            'مخازن-تعديل',
            'مخازن-حذف',
            'رفع-نماذج',
            'بنوك-بيانات',
            'بنوك-اضافة',
            'بنوك-تعديل',
            'بنوك-حذف',
            'وظيفة-العميل-بيانات',
            'وظيفة-العميل-اضافة',
            'وظيفة-العميل-تعديل',
            'وظيفة-العميل-حذف',
        ];

        foreach($permissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }

        // All Permissions
        $permission_saved = Permission::pluck('id')->toArray();

        // Give Role Admin All Access
        $role = Role::whereId(1)->first();
        $role->syncPermissions($permission_saved);

        // Admin Role Sync Permission
        $user = User::where('role_id', 1)->first();
        $user->assignRole($role->id);
    }
}
