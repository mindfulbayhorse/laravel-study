<?php

namespace App\Observers;

use App\Models\Deliverable;
use App\Events\DeliverableDatesChanged;

class DeliverableObserver
{
    /**
     * Handle the Deliverable "created" event.
     *
     * @param  \App\Models\Deliverable  $deliverable
     * @return void
     */
    public function created(Deliverable $deliverable)
    {
       
    }
    
    /**
     * Handle the Deliverable "creating" event.
     *
     * @param  \App\Models\Deliverable  $deliverable
     * @return void
     */
    public function creating(Deliverable $deliverable)
    {
        if (!empty($deliverable->order)) return;
        
        $order = Deliverable::where([
            ['parent_id', '=', $deliverable->parent_id],
            ['wbs_id', '=', $deliverable->wbs_id],
        ])->max('order');
        
        if ($order) {
            $deliverable->order = $order+1;
        } else {
            $deliverable->order = 1;
        }
        
    }

    /**
     * Handle the Deliverable "updated" event.
     *
     * @param  \App\Models\Deliverable  $deliverable
     * @return void
     */
    public function updated(Deliverable $deliverable)
    {
        
    }
    
    /**
     * Handle the Deliverable "updating" event.
     *
     * @param  \App\Models\Deliverable  $deliverable
     * @return void
     */
    public function updating(Deliverable $deliverable)
    {
        
        if ($deliverable->hasChanged('start_date')){
     
            DeliverableDatesChanged::dispatch($deliverable, 'start_date');
        }
        
        if ($deliverable->hasChanged('end_date')){
            
            DeliverableDatesChanged::dispatch($deliverable, 'end_date');
        }
        
    }
    

    /**
     * Handle the Deliverable "deleted" event.
     *
     * @param  \App\Models\Deliverable  $deliverable
     * @return void
     */
    public function deleted(Deliverable $deliverable)
    {

    }

    /**
     * Handle the Deliverable "restored" event.
     *
     * @param  \App\Models\Deliverable  $deliverable
     * @return void
     */
    public function restored(Deliverable $deliverable)
    {
        //
    }

    /**
     * Handle the Deliverable "force deleted" event.
     *
     * @param  \App\Models\Deliverable  $deliverable
     * @return void
     */
    public function forceDeleted(Deliverable $deliverable)
    {
        //
    }
}
