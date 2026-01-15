<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah Rate Card ke Talents (Cek dulu biar gak error Duplicate Column)
        Schema::table('talents', function (Blueprint $table) {
            if (!Schema::hasColumn('talents', 'rate_min')) {
                $table->decimal('rate_min', 12, 2)->default(0)->after('role');
            }
            if (!Schema::hasColumn('talents', 'rate_max')) {
                $table->decimal('rate_max', 12, 2)->default(0)->after('rate_min');
            }
        });

        // 2. Tabel Campaigns (Cek dulu biar gak error Table Exists)
        if (!Schema::hasTable('campaigns')) {
            Schema::create('campaigns', function (Blueprint $table) {
                $table->id();
                $table->string('brand_name');
                $table->string('brand_email');
                $table->string('brand_whatsapp');
                
                $table->string('campaign_name');
                $table->decimal('budget', 15, 2);
                $table->string('platform'); 
                $table->string('niche');
                $table->date('deadline')->nullable();
                $table->text('brief')->nullable();
                
                $table->boolean('agreement_replacement')->default(false);
                $table->string('status')->default('pending_payment'); 
                $table->timestamps();
            });
        }

        // 3. Tabel Pivot (Termasuk Fix Foreign Key 'talents')
        if (!Schema::hasTable('campaign_talent')) {
            Schema::create('campaign_talent', function (Blueprint $table) {
                $table->id();
                $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
                
                // FIX: Menggunakan 'talents' secara eksplisit
                $table->foreignId('talent_id')->constrained('talents')->onDelete('cascade');
                
                $table->string('status')->default('pending'); 
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('campaign_talent');
        Schema::dropIfExists('campaigns');
        
        if (Schema::hasColumn('talents', 'rate_min')) {
            Schema::table('talents', function (Blueprint $table) {
                $table->dropColumn(['rate_min', 'rate_max']);
            });
        }
    }
};