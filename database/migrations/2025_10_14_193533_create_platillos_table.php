<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('platillos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->nullOnDelete();
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->text('ingredientes')->nullable();
            $table->string('imagen', 255)->nullable();
            $table->decimal('precio', 10, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }
    public function down(): void {
        Schema::dropIfExists('platillos');
    }
};
