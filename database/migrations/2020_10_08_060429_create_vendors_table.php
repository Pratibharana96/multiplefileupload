<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_cin')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('ownername')->nullable();
            $table->string('gstno')->nullable();
            $table->string('vendorpicture')->nullable();
            $table->string('vendorgst')->nullable();
            $table->string('ownerpersonaldoc')->nullable();
            $table->string('cinphoto')->nullable();
            $table->string('panimage')->nullable();
            $table->string('gstupload')->nullable();
            $table->string('companydoc')->nullable();
            $table->string('otherdoc')->nullable();
            $table->string('doc_uploaded')->nullable();
            $table->string('logfile')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
