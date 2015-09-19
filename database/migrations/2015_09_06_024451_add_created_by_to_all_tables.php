<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCreatedByToAllTables extends Migration
{
    public function up()
    {
        $user = app(config('auth.model'));
        $userIdFieldName = $user->getKeyName();
        $userTableName = $user->getTable();

        if (Schema::hasTable('sqlite_master')) {
            $tables = DB::table('sqlite_master')
                ->where('type', 'table')
                ->select(['name AS table_name'])
                ->get();
        } else {
            $tables = DB::table('information_schema.tables')
                ->where('table_schema', env('DB_DATABASE'))
                ->where('table_type', 'BASE TABLE')
                ->select(['table_name'])
                ->get();
        }

        foreach ($tables as $tableInfo) {
            if (Schema::hasColumn($tableInfo->table_name, 'created_by')) {
                throw new Exception('The `created_by` column already exists in one of your tables. Please fix the conflict and try again. This migration has not been run.');
            }
        }

        foreach ($tables as $tableInfo) {
            if ($tableInfo->table_name !== 'sqlite_sequence') {
                Schema::table($tableInfo->table_name, function (Blueprint $table) use ($userIdFieldName, $userTableName) {
                    $table->integer('created_by')->unsigned()->nullable();
                    $table->foreign('created_by')->references($userIdFieldName)->on($userTableName)->onDelete('cascade');
                });
            }
        }
    }

    public function down()
    {
        if (Schema::hasTable('sqlite_master')) {
            $tables = DB::table('sqlite_master')
                ->where('type', 'table')
                ->select(['name AS table_name'])
                ->get();
        } else {
            $tables = DB::table('information_schema.tables')
                ->where('table_schema', env('DB_DATABASE'))
                ->where('table_type', 'BASE TABLE')
                ->select(['table_name'])
                ->get();
        }

        foreach ($tables as $tableInfo) {
            if (Schema::hasColumn($tableInfo->table_name, 'created_by')) {
                Schema::table($tableInfo->table_name, function (Blueprint $table) use ($tableInfo) {
                    $table->dropForeign($tableInfo->table_name . '_created_by_foreign');
                    $table->dropColumn('created_by');
                });
            }
        }
    }
}
