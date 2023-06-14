<?php namespace NielsVanDenDries\Messenger\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNielsvandendriesMessengerMessage extends Migration
{
    public function up()
    {
        Schema::table('nielsvandendries_messenger_message', function($table)
        {
            $table->renameColumn('message', 'message_content');
            $table->renameColumn('subject', 'recipient_id');
        });
    }
    
    public function down()
    {
        Schema::table('nielsvandendries_messenger_message', function($table)
        {
            $table->renameColumn('message_content', 'message');
            $table->renameColumn('recipient_id', 'subject');
        });
    }
}
