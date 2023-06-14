<?php namespace NielsVanDenDries\Messenger\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNielsvandendriesMessengerMessage2 extends Migration
{
    public function up()
    {
        Schema::table('nielsvandendries_messenger_message', function($table)
        {
            $table->string('sender_id');
        });
    }
    
    public function down()
    {
        Schema::table('nielsvandendries_messenger_message', function($table)
        {
            $table->dropColumn('sender_id');
        });
    }
}
