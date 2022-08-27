<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoters', function (Blueprint $table) {
            $table->id();
            $table->string('scoter_number');
            $table->integer('floor')->nullable();
            $table->text('description')->nullable();
            $table->text('price')->nullable();
            $table->text('capacity')->nullable();
            $table->foreignIdFor(Category::class)->nullable()->constrained()->cascadeOnUpdate();
            
            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scoters');
    }
}
