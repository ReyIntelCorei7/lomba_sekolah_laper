<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('students')) {
            return;
        }
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('birth_place');
            $table->text('address');
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('parent_job');
            $table->string('school_origin');
            $table->decimal('average_grade', 4, 2)->nullable();
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->enum('registration_type', ['online', 'offline'])->default('online');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'waiting'])->default('pending');
            $table->string('photo')->nullable();
            $table->string('certificate')->nullable();
            $table->string('transcript')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('registered_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
