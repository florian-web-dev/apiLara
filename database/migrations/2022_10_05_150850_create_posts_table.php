<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('content')->nullable();
            $table->string('url');

            $table->foreignIdFor(User::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Category::class)->constrained()->onUpdate('cascade')->onDelete('cascade');

            // add pivot categori post ?

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    //  */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
