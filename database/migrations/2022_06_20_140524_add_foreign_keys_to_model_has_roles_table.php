<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToModelHasRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->foreign(['model_id'], 'model_has_roles_ibfk_1')->references(['id'])->on('users')->onDelete('CASCADE');
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->dropForeign('model_has_roles_ibfk_1');
            $table->dropForeign('model_has_roles_role_id_foreign');
        });
    }
}
