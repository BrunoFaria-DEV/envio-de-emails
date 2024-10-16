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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->longText('html')->nullable();
            $table->char('status', 1)->default('C');
            $table->char('shipping_type', 1)->default('I');
            $table->dateTime('shipping_date');
            $table->string('shipping_code', 30)->unique()->charset('utf8')->collation('utf8_bin');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::table('shippings', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_account_id');
            $table->foreign('customer_account_id')->references('id')->on('customer_accounts')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('shippings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
