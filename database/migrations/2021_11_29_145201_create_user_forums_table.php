<?php

use App\Models\Forum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_forums', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Forum::class);
            $table->foreignIdFor(User::class);
            $table->boolean('canEditForumDetails')->default(false);
            $table->boolean('canRemovePost')->default(false);
            $table->boolean('canRemoveComment')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_forums');
    }
}
