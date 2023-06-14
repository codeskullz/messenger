<?php namespace NielsVanDenDries\Messenger\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateNielsvandendriesMessenger extends Migration
{
    public function up()
    {
        Schema::create('nielsvandendries_messenger_message', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('sender_id');
            $table->string('recipient_id');
            $table->text('content');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('nielsvandendries_messenger_');
    }
}
