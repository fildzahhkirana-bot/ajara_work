<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::table('competitions',function(Blueprint $table){
  $table->string('competition_category')->default('Lainnya')->after('category');
  $table->string('competition_level')->default('Kampus')->after('competition_category');
  $table->string('delivery_mode')->default('Online')->after('mode');
  $table->unsignedBigInteger('fee_amount')->default(0)->after('mode');
  $table->decimal('rating',2,1)->default(0)->after('fee_amount');
  $table->unsignedInteger('review_count')->default(0)->after('rating');
  $table->unsignedInteger('views')->default(0)->after('review_count');
  $table->boolean('is_recommended')->default(false)->after('views');
  $table->longText('requirements')->nullable()->after('description');
 }); }
 public function down(): void { Schema::table('competitions',function(Blueprint $table){$table->dropColumn(['competition_category','competition_level','delivery_mode','fee_amount','rating','review_count','views','is_recommended','requirements']);}); }
};
