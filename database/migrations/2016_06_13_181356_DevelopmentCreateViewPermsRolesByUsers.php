<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DevelopmentCreateViewPermsRolesByUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (App::environment('development')) {

            // Build view for the report, for the development environment,
            // as a demo.
            $sql = "";
            $sql = $sql . 'CREATE VIEW "v_permissions_and_roles_by_users" ';
            $sql = $sql . 'AS ';
            $sql = $sql . 'select "u"."id"            AS "user_id" ';
            $sql = $sql . '      ,"u"."username"      AS "username" ';
            $sql = $sql . '      ,\'\'                  AS "user_permission" ';
            $sql = $sql . '      ,"r"."display_name"  AS "role" ';
            $sql = $sql . '      ,"p1"."display_name" AS "role_permission" ';
            $sql = $sql . 'from "users" "u" ';
            $sql = $sql . '         left join "role_user" "ru" ';
            $sql = $sql . '             on  "ru"."user_id" = "u"."id" ';
            $sql = $sql . '         left join "roles" "r" ';
            $sql = $sql . '             on "ru"."role_id" = "r"."id" ';
            $sql = $sql . '         left join "permission_role" "pr" ';
            $sql = $sql . '             on "pr"."role_id" = "r"."id" ';
            $sql = $sql . '         left join "permissions" "p1" ';
            $sql = $sql . '             on "pr"."permission_id" = "p1"."id" ';
            $sql = $sql . 'union ';
            $sql = $sql . 'select "u2"."id" AS "user_id" ';
            $sql = $sql . '      ,"u2"."username" AS "username" ';
            $sql = $sql . '      ,"p2"."display_name" AS "user_permission" ';
            $sql = $sql . '      ,\'\' AS "role" ';
            $sql = $sql . '      ,\'\' AS "role_permission" ';
            $sql = $sql . 'from "users" "u2" ';
            $sql = $sql . '         join "permission_user" "pu2" ';
            $sql = $sql . '             on "pu2"."user_id" = "u2"."id" ';
            $sql = $sql . '         join "permissions" "p2" ';
            $sql = $sql . '             on "pu2"."permission_id" = "p2"."id" ';
            $sql = $sql . 'order by "username" ';
            $sql = $sql . '        ,"user_permission" ';
            $sql = $sql . '        ,"role" ';
            $sql = $sql . '        ,"role_permission" ;';

            DB::statement($sql);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (App::environment('development')) {

            DB::statement("DROP VIEW IF EXISTS v_permissions_and_roles_by_users");
        }
    }
}
