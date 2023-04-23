<?php

use App\Models\Answer;
use App\Models\Collection;
use App\Models\Question;
use App\Models\User;
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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Collection::class)->constrained('collections');
            $table->foreignIdFor(Question::class)->constrained('questions');
            $table->foreignIdFor(User::class)->constrained('users');
            $table->foreignIdFor(Answer::class)->constrained('answers');
            $table->boolean('is_correct');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
