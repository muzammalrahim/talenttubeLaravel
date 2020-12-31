<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrossreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crossreferences', function (Blueprint $table) {
            $table->id();
            $table->integer('jobseekerId');
            // $table->integer('jobseekerId');
            $table->string('refType');
            $table->string('userName');
            $table->string('jsIP');
            $table->string('refereeIP');
            $table->string('refereeBrowser');
            $table->string('jsBrowser');
            $table->string('jsSysyem');
            $table->string('refSystem');
            $table->string('refName');
            $table->string('refEmail');
            $table->string('refPhone');
            $table->string('refStatus');
            $table->string('refURL');
            $table->string('uniqueDigits');
            $table->string('refereeName')->nullable();
            $table->string('refereeEmail')->nullable();
            $table->string('refereePhone')->nullable();
            $table->string('refereeOrganization')->nullable();
            $table->string('refereeDates')->nullable();
            $table->string('refereeOrganizationTitle')->nullable();
            $table->string('refereeReport')->nullable();
            $table->string('refereePerformance')->nullable();
            $table->string('refereeRequirements')->nullable();
            $table->string('refereeBehaviours')->nullable();
            $table->string('refereeTeamplayer')->nullable();
            $table->string('refereeManagementr')->nullable();
            $table->string('refereeProspective')->nullable();
            $table->string('refereePotentially')->nullable();
            $table->string('refereeComments')->nullable();

            $table->string('candidateTitle')->nullable();
            $table->string('refereeLeaving')->nullable();

            $table->string('ddText1')->nullable();
            $table->string('ddText2')->nullable();
            $table->string('ddText3')->nullable();
            $table->string('ddText4')->nullable();
            $table->string('ddText5')->nullable();
            $table->string('ddText6')->nullable();

            // Personal Reference 

            $table->string('refereeKnowing')->nullable();
            $table->string('refereeMeet')->nullable();
            $table->string('refereeParticularIns')->nullable();
            $table->string('refereeInteractions')->nullable();
            $table->string('refereePunctual')->nullable();
            $table->string('refereeCommunication')->nullable();
            $table->string('refereeRelatively')->nullable();
            
            $table->string('refereeMotivation')->nullable();

            // Personal Reference 

            // Educational Reference 

            $table->string('refereeEducational')->nullable();
            $table->string('refereeParticularClass')->nullable();
            $table->string('refereeInitiative')->nullable();
            $table->string('refereeDemonstrate')->nullable();
            $table->string('refereeLearning')->nullable();
            $table->string('refereeCurricular')->nullable();
            $table->string('refereeRelatedProject')->nullable();
            $table->string('refereeCandidateBest')->nullable();


            // Educational Reference

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrationUs.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crossreferences');
    }
}
