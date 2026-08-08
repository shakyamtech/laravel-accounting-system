<?php

namespace App\Http\ViewComposers;

use App\Traits\Plans;
use Illuminate\View\View;

class PlanLimits
{
    use Plans;

    public function compose(View $view): void
    {
        // Disable API key and plan limit warnings for local self-hosted installation
        return;
    }
}
