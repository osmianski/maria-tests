<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(<<<EOT
CREATE TABLE files (
    id BINARY(16) PRIMARY KEY,
    related_model VARCHAR(255) NOT NULL,
    related_model_id INT UNSIGNED NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    mime_type VARCHAR(80) NOT NULL,
    size BIGINT UNSIGNED NOT NULL,
    disk VARCHAR(255) NOT NULL,
    collection VARCHAR(255) NOT NULL,
    uploaded_by VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT files_related_model_related_model_id_unique UNIQUE (related_model, related_model_id, file_name)
) ENGINE=InnoDB;
EOT);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
