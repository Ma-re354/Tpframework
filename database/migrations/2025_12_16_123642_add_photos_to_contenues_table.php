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
    Schema::table('contenues', function (Blueprint $table) {
        if (!Schema::hasColumn('contenues', 'photos')) {
            $table->string('photos')->nullable()->after('texte');
        }
    });
}

public function down(): void
{
    Schema::table('contenues', function (Blueprint $table) {
        $table->dropColumn('photos');
    });
}
};
