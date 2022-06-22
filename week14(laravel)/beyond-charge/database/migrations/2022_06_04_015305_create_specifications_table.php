<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->string("body");//red , ....
            $table->string("model_type")->nullable(); //(App/Model/Ev) or (App/Model/Pv)
            $table->string("model_id")->nullable();  //(1 or 2 or .....) or (1 or 2 or 3 .......)
            $table->foreignId("specification_type_id")->constrained("specification_types");
            $table->foreignId("updated_by")->constrained("users");
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
        Schema::dropIfExists('specifications');
    }
};
