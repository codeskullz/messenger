<?php namespace NielsVanDenDries\Messenger\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNielsvandendriesMessengerMessage3 extends Migration
{
    public function up()
    {
        Schema::table('nielsvandendries_messenger_message', function($table)
        {
            $table->string('recipient_id');
        });
    }
    
    public function down()
    {
        Schema::table('nielsvandendries_messenger_message', function($table)
        {
            $table->dropColumn('recipient_id');
        });
    }
}
