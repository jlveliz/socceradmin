<?php

namespace HappyFeet\Listeners;

use HappyFeet\Events\DeleteEnrollmentGroup;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use HappyFeet\Models\EnrollmentGroup;
use HappyFeet\Exceptions\EnrollmentGroupException;

class DeleteAssistances
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  DeleteEnrollmentGroup  $event
     * @return void
     */
    public function handle(DeleteEnrollmentGroup $event)
    {
      
       $idEnrollment = $event->idEnrollment;
       $oldGroups = $event->oldGroups;
       $newGroups = $event->newGroups;
       
       // dd($idEnrollment,$oldGroups,$newGroups);
       
       if (is_array($oldGroups) && is_array($newGroups)) {
            if($oldGroups  == $newGroups) return true;

            $grToDelete = [];
            $grToInsert = [];
            $grToUpdate = [];

            foreach ($newGroups as $key => $newGr) {
                if (!in_array($newGr, $oldGroups)) {
                    if (!in_array($newGr, $grToInsert)) {
                        $grToInsert[] = $newGr;
                    }
                }
            }

            foreach ($oldGroups as $key => $olgGr) {
                if (!in_array($olgGr, $newGroups)) {
                    if (!in_array($olgGr, $grToDelete)) {
                        $grToDelete[] = $olgGr;
                    }
                }else {
                    $grToUpdate[] = $olgGr;
                }
            }
            

            if (count($grToDelete) > 0){
                foreach ($grToDelete as $key => $grDel) {
                    $enrGr = EnrollmentGroup::where('enrollment_id',$idEnrollment)->where('group_id',$grDel)->first();
                    if ($enrGr) {
                        $enrGr->assistances()->delete();
                        $enrGr->delete();
                    }else {
                    throw new EnrollmentGroupException("No se pudo eliminar las asistencias", 500);
                    }
                }
            }

            if (count($grToInsert) > 0) {
                foreach ($grToInsert as $key => $grinsert) {
                    $enrGroup = new EnrollmentGroup(['group_id' => $grinsert,'enrollment_id'=> $idEnrollment]);
                    if(!$enrGroup->save()){
                        throw new EnrollmentGroupException("No se pudo crear el grupo de la matricula", 500);
                    }
                }
            }


            if (count($grToUpdate) > 0) {
                foreach ($grToUpdate as $key => $grUpdate) {
                    $enrGr = EnrollmentGroup::where('enrollment_id',$idEnrollment)->where('group_id',$grUpdate)->first();
                    if(!$enrGr->update()) {
                        throw new EnrollmentGroupException("No se pudo actualizar el grupo de la matricula", 500);
                    }
                }
            }
            
           
       }

        // $grEnr = EnrollmentGroup::find($idEnrGroup->enrollmentsGroupsId);
        // if ($grEnr) {
        //     $grEnr->assistances()->delete();
        // } else {
        //     throw new EnrollmentGroupException("No se pudo eliminar las asistencias", 500);
            
        // }
    }
}
