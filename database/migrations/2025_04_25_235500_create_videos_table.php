<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('file_path')->nullable(); // Path to the stored video file
            $table->string('thumbnail_path')->nullable(); // Optional thumbnail image
            $table->text('description')->nullable(); // Video description
            $table->integer('duration')->nullable(); // Video duration in seconds
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
