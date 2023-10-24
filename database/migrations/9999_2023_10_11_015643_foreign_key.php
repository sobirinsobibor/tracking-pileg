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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_role')->nullable(false);

            $table->foreign('id_role')->references('id')->on('roles');
        });

        Schema::table('total_votes', function (Blueprint $table) {
            $table->char('id_voting_place', 16)->nullable(false);
            $table->char('id_party', 16)->nullable(false);

            $table->foreign('id_voting_place')->references('voting_place_encrypted_id')->on('voting_places');
            $table->foreign('id_party')->references('party_encrypted_id')->on('parties');
        });

        Schema::table('candidate_votes', function (Blueprint $table) {
            $table->char('id_voting_place', 16)->nullable(false);
            $table->char('id_candidate', 16)->nullable(false);


            $table->foreign('id_voting_place')->references('voting_place_encrypted_id')->on('voting_places');
            $table->foreign('id_candidate')->references('candidate_encrypted_id')->on('candidates');
        });


        Schema::table('voting_places', function (Blueprint $table) {
            $table->char('id_electoral_district', 16)->nullable(false);
            $table->char('id_sub_district', 16)->nullable(false);

            $table->foreign('id_electoral_district')->references('electoral_district_encrypted_id')->on('electoral_districts');
            $table->foreign('id_sub_district')->references('sub_district_encrypted_id')->on('sub_districts');
        });

        Schema::table('detail_location_of_voting_places', function(Blueprint $table){
            $table->unsignedBigInteger('id_user')->nullable(false);
            $table->char('id_voting_place', 16)->nullable(false);

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_voting_place')->references('voting_place_encrypted_id')->on('voting_places');

        });

        Schema::table('identity_votes', function(Blueprint $table){
            $table->unsignedBigInteger('id_user')->nullable(false);
            $table->char('id_voting_place', 16)->nullable(false);

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_voting_place')->references('voting_place_encrypted_id')->on('voting_places');
        });

        Schema::table('sub_districts', function(Blueprint $table){
            $table->char('id_district', 16)->nullable(false);

            $table->foreign('id_district')->references('district_encrypted_id')->on('districts');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('total_votes', function (Blueprint $table) {
            $table->dropForeign(['id_voting_place']); 
            $table->dropColumn('id_voting_place'); 

            $table->dropForeign(['id_party']); 
            $table->dropColumn('id_party'); 

        });

        Schema::table('candidate_votes', function (Blueprint $table) {
            $table->dropForeign(['id_voting_place']); 
            $table->dropColumn('id_voting_place'); 

            $table->dropForeign(['id_candidate']); 
            $table->dropColumn('id_candidate'); 

        });

        Schema::table('voting_places', function (Blueprint $table) {
            $table->dropForeign(['id_electoral_district']); 
            $table->dropColumn('id_electoral_district');

            $table->dropForeign(['id_sub_district']); 
            $table->dropColumn('id_sub_district'); 

        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_role']); 
            $table->dropColumn('id_role'); 
        });

        Schema::table('detail_location_of_voting_places', function (Blueprint $table) {
            $table->dropForeign(['id_user']); 
            $table->dropColumn('id_user'); 

            $table->dropForeign(['id_voting_place']); 
            $table->dropColumn('id_voting_place'); 
        });

        Schema::table('identity_votes', function(Blueprint $table){
            $table->dropForeign(['id_user']); 
            $table->dropColumn('id_user'); 

            $table->dropForeign(['id_voting_place']); 
            $table->dropColumn('id_voting_place'); 

        });

        Schema::table('sub_districts', function(Blueprint $table){

            $table->dropForeign(['id_district']); 
            $table->dropColumn('id_district'); 
        });

    }
};
