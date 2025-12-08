<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('content_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_utilisateur')->constrained()->onDelete('cascade');
            $table->foreignId('id_contenu')->constrained('contenues')->onDelete('cascade');
            $table->string('transaction_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('XOF');
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['id_utilisateur', 'id_contenu']);
            $table->index(['status', 'paid_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('content_payments');
    }
}