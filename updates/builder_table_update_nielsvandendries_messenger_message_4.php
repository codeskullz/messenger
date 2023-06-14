<?php namespace NielsVanDenDries\Messenger\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNielsvandendriesMessengerMessage4 extends Migration
{
    public function up()
    {
        Schema::table('nielsvandendries_messenger_message', function($table)
        {
            $table->renameColumn('message', 'content');
        });
    }
    
    public function down()
    {
        Schema::table('nielsvandendries_messenger_message', function($table)
        {
            $table->renameColumn('content', 'message');
        });
    }
}
