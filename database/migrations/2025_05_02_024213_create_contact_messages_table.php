<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->string('department');
            $table->text('message');
            $table->boolean('privacy')->default(true);
            $table->timestamps(); // Adds `created_at` and `updated_at`
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_messages'); // Rollback option
    }
};
