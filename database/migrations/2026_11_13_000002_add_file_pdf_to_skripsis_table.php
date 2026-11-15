<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table('skripsis', function (Blueprint $t) {
            $t->string('file_pdf')->nullable()->after('progress');
        });
    }
    public function down(): void {
        Schema::table('skripsis', fn (Blueprint $t) => $t->dropColumn('file_pdf'));
    }
};
