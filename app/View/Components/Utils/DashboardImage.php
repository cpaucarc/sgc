<?php

namespace App\View\Components\Utils;

use App\Models\Facultad;
use App\Models\User;
use Illuminate\View\Component;

class DashboardImage extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $image_path = null;

    public function __construct($user)
    {
        $facultades_id = User::facultades_id($user);
        $escuelas_id = User::escuelas_id($user);
        $facu_abrev = null;

        if (count($escuelas_id) > 0) {
            $facultad = Facultad::query()->select('abrev')->whereIn('id', function ($query) use ($escuelas_id) {
                $query->select('facultad_id')->from('escuelas')
                    ->where('id', $escuelas_id[0]);
            })->first();
            $facu_abrev = $facultad->abrev;
        } elseif (count($facultades_id) > 0) {
            $facultad = Facultad::query()->select('abrev')->where('id', $facultades_id[0])->first();
            $facu_abrev = $facultad->abrev;
        }

        switch ($facu_abrev) {
            case('FCM'):
                $this->image_path = 'images/unasam/campus_fcm.png';
                break;
            case('FIC'):
                $this->image_path = 'images/unasam/campus_fcm.png';
                break;
            default:
                $this->image_path = 'images/unasam/campus1.webp';
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public
    function render()
    {
        return view('components.utils.dashboard-image');
    }
}
