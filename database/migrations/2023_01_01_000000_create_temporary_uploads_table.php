<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
<<<<<<< HEAD
use Modules\Media\Models\TemporaryUpload;
use Modules\Xot\Database\Migrations\XotBaseMigration;

return new class() extends XotBaseMigration
{
    protected ?string $model_class = TemporaryUpload::class;
<<<<<<< .merge_file_MzJkTU

=======
=======
// ---- models ---

use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Class CreateTemporaryUploadsTable.
 */
return new class extends XotBaseMigration
{
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_fjyJwn
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('session_id');
<<<<<<< .merge_file_MzJkTU
            $table->uuid('user_id')->nullable();
            $table->string('file_name');
            $table->integer('file_size')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('status')->default('uploading');
        });
        // -- UPDATE --
=======
<<<<<<< HEAD
        });

        // -- UPDATE: upload metadata columns (guarded so pre-existing installs get them too) --
        $this->tableUpdate(function (Blueprint $table): void {
            if (! $this->hasColumn('user_id')) {
                $table->uuid('user_id')->nullable();
            }
            if (! $this->hasColumn('file_name')) {
                $table->string('file_name')->nullable();
            }
            if (! $this->hasColumn('file_size')) {
                $table->integer('file_size')->nullable();
            }
            if (! $this->hasColumn('mime_type')) {
                $table->string('mime_type')->nullable();
            }
            if (! $this->hasColumn('status')) {
                $table->string('status')->default('uploading');
            }
        });

        // -- UPDATE: audit timestamps --
=======
            $table->uuid('user_id')->nullable();
            $table->string('file_name');
            $table->integer('file_size')->nullable();
            $table->string('mime_type')->nullable();
            $table->string('status')->default('uploading');
        });
        // -- UPDATE --
>>>>>>> f6dc2a0 (.)
>>>>>>> .merge_file_fjyJwn
        $this->tableUpdate(function (Blueprint $table): void {
            $this->updateTimestamps(
                table: $table,
                hasSoftDeletes: true,
            );
        });
    }
};
