<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('is_admin')->default('0');
            $table->string('sub_domain')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
          'name' => 'super-admin',
          'email' => 'admin@dev.com',
          'password' => \Illuminate\Support\Facades\Hash::make('password'),
          'is_admin' => 2,
          'sub_domain' => null
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
